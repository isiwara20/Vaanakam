<?php
/**
 * Chat Controller - Vaanakam E-Commerce
 * Handles chatbot AJAX requests with Full English & Tamil (தமிழ்) Support
 */
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../dal/ChatDAL.php';
require_once __DIR__ . '/../dal/ProductDAL.php';
require_once __DIR__ . '/../dal/CategoryDAL.php';
require_once __DIR__ . '/../services/AsyncMailQueue.php';
require_once __DIR__ . '/../helpers/chat.php';
require_once __DIR__ . '/../helpers/language.php';

// Sync current language from request or session
if (!empty($_REQUEST['lang'])) {
    set_current_language($_REQUEST['lang']);
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// Handle close_chat before setting JSON header (it redirects)
if ($action === 'close_chat' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    closeChat();
}

header('Content-Type: application/json; charset=utf-8');

switch ($action) {
    case 'start':
        startConversation();
        break;
    case 'send':
        sendMessage();
        break;
    case 'request_human':
        requestHuman();
        break;
    case 'get_messages':
        getMessages();
        break;
    case 'admin_reply':
        adminReply();
        break;
    case 'admin_get_chats':
        adminGetChats();
        break;
    case 'admin_get_messages':
        adminGetMessages();
        break;
    case 'close_chat':
        closeChat();
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        exit;
}

function startConversation() {
    $userId = $_SESSION['user_id'] ?? null;
    $isTamil = (get_current_language() === 'ta');
    
    try {
        $chatDAL = new ChatDAL();
        
        // Check for existing active conversation
        if ($userId) {
            $existing = $chatDAL->getActiveConversation($userId);
            if ($existing) {
                $messages = $chatDAL->getMessages($existing['id']);
                echo json_encode(['success' => true, 'conversation_id' => $existing['id'], 'messages' => $messages, 'status' => $existing['status']]);
                return;
            }
        }
        
        // Create new conversation
        $convId = $chatDAL->createConversation($userId);
        
        if ($isTamil) {
            $welcomeMsg = "வணக்கம்! நான் உங்கள் வானகம் (VAANAKAM) உதவி உதவியாளர். தூய மரச்செக்கு எண்ணெய்கள், இயற்கை மளிகைப் பொருட்கள், முந்திரி, பாரம்பரிய தானியங்கள் மற்றும் உங்கள் ஆர்டர் விவரங்களை அறிய நான் உதவ முடியும். இன்று உங்களுக்கு எவ்வாறு உதவலாம்?";
            $quickReplies = ['பொருட்களைப் பார்க்க', 'ஆர்டரைக் கண்காணிக்க', 'விநியோக விபரம்', 'உதவியாளரைத் தொடர்பு கொள்ள'];
        } else {
            $welcomeMsg = "Hi! I'm your VAANAKAM assistant. I can help you find natural organic groceries, pure cold-pressed oils, cashews, traditional grains, track orders, or answer questions. How can I help you today?";
            $quickReplies = ['Browse Products', 'Track Order', 'Delivery Info', 'Contact Human'];
        }

        $chatDAL->addMessage($convId, 'bot', $welcomeMsg, 'quick_replies', ['quick_replies' => $quickReplies]);
        
        $messages = $chatDAL->getMessages($convId);
        echo json_encode(['success' => true, 'conversation_id' => $convId, 'messages' => $messages, 'status' => 'bot']);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to start chat: ' . $e->getMessage()]);
    }
}

function sendMessage() {
    $conversationId = (int)($_POST['conversation_id'] ?? 0);
    $message = trim($_POST['message'] ?? '');
    $isTamil = (get_current_language() === 'ta');
    
    if (!$conversationId || empty($message)) {
        echo json_encode(['error' => 'Missing data']);
        return;
    }
    
    try {
        $chatDAL = new ChatDAL();
        $conversation = $chatDAL->getConversation($conversationId);
        
        if (!$conversation) {
            echo json_encode(['error' => 'Conversation not found']);
            return;
        }
        
        // Save user message
        $userMsgId = $chatDAL->addMessage($conversationId, 'user', $message);
        
        // If awaiting email from guest
        if ($conversation['status'] === 'awaiting_email') {
            $email = filter_var(trim($message), FILTER_VALIDATE_EMAIL);
            if ($email) {
                // Save email to conversation and connect to human
                $chatDAL->updateGuestEmail($conversationId, $email);
                requestHumanFromBot($chatDAL, $conversationId, null, $email);
                $response = [
                    'type' => 'human_requested',
                    'message' => $isTamil
                        ? "நன்றி! உங்கள் மின்னஞ்சல் முகவரி ({$email}) பெறப்பட்டது. எங்கள் வாடிக்கையாளர் சேவை குழுவுடன் உங்களை இணைக்கிறோம். மின்னஞ்சல் மூலமாகவும் உங்களுக்கு பதிலளிக்கப்படும்."
                        : "Thanks! We've received your email ({$email}). Connecting you with our support team now. You'll also receive responses via email.",
                    'products' => [], 'categories' => [], 'quick_replies' => [], 'last_id' => 0
                ];
                $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message']);
                $response['last_id'] = $msgId;
                echo json_encode(['success' => true, 'bot_response' => $response]);
            } else {
                $response = [
                    'type' => 'text',
                    'message' => $isTamil
                        ? "மன்னிக்கவும், இது சரியான மின்னஞ்சல் முகவரியாகத் தெரியவில்லை. தயவுசெய்து சரியான மின்னஞ்சலை (எ.கா: name@example.com) உள்ளிடவும்."
                        : "That doesn't look like a valid email address. Please enter a valid email (e.g. name@example.com) so our team can reach you.",
                    'products' => [], 'categories' => [], 'quick_replies' => [], 'last_id' => 0
                ];
                $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message']);
                $response['last_id'] = $msgId;
                echo json_encode(['success' => true, 'bot_response' => $response]);
            }
            return;
        }
        
        // If in human mode, notify admin and wait for a reply.
        if ($conversation['status'] === 'human_active' || $conversation['status'] === 'human_requested') {
            lumak_queue_admin_chat_notification($conversationId, $userMsgId);
            lumak_chat_finish_json_response(
                ['success' => true, 'bot_response' => null, 'last_id' => $userMsgId],
                [
                    'handler' => 'chat_admin_notify',
                    'conversation_id' => $conversationId,
                    'message_id' => $userMsgId,
                ]
            );
        }
        
        // Generate bot response
        $response = generateBotResponse($message, $chatDAL, $conversationId);
        echo json_encode(['success' => true, 'bot_response' => $response]);
        
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to send message']);
    }
}

function generateBotResponse($message, $chatDAL, $conversationId) {
    $isTamil = (get_current_language() === 'ta');
    $msgLower = mb_strtolower(trim($message), 'UTF-8');
    $response = ['type' => 'text', 'message' => '', 'products' => [], 'categories' => [], 'quick_replies' => [], 'last_id' => 0];

    // Quick replies localized
    $qrBrowse = $isTamil ? 'பொருட்களைப் பார்க்க' : 'Browse Products';
    $qrTrack = $isTamil ? 'ஆர்டரைக் கண்காணிக்க' : 'Track Order';
    $qrDelivery = $isTamil ? 'விநியோக விபரம்' : 'Delivery Info';
    $qrHuman = $isTamil ? 'உதவியாளரைத் தொடர்பு கொள்ள' : 'Contact Human';
    
    // 1. Handle category selection
    if (strpos($msgLower, 'show category: ') === 0) {
        $slug = trim(str_replace('show category: ', '', $msgLower));
        try {
            $categoryDAL = new CategoryDAL();
            $categories = $categoryDAL->getActive();
            $targetCat = null;
            foreach ($categories as $c) {
                if ($c['slug'] === $slug) { $targetCat = $c; break; }
            }
            
            if ($targetCat) {
                $productDAL = new ProductDAL();
                $products = $productDAL->getByCategory($targetCat['id']);
                $targetCatDisplay = $isTamil ? translate_text($targetCat['name']) : $targetCat['name'];

                if (!empty($products)) {
                    $response['message'] = $isTamil
                        ? "{$targetCatDisplay} பிரிவில் உள்ள தயாரிப்புகள் இதோ:"
                        : "Here are the products in " . $targetCat['name'] . ":";
                    $response['type'] = 'products';
                    $response['products'] = array_map(function($p) use ($isTamil) {
                        return [
                            'id' => $p['id'],
                            'name' => $p['name'],
                            'name_translated' => $isTamil ? translate_product_name($p['name']) : $p['name'],
                            'slug' => $p['slug'],
                            'price' => $p['price'],
                            'original_price' => $p['original_price'],
                            'image' => $p['image'],
                            'category' => $isTamil ? translate_text($p['category_name'] ?? '') : ($p['category_name'] ?? '')
                        ];
                    }, $products);
                    $response['quick_replies'] = [$qrBrowse, $qrHuman];
                    $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'products', ['products' => $response['products'], 'quick_replies' => $response['quick_replies']]);
                    $response['last_id'] = $msgId;
                } else {
                    $response['message'] = $isTamil
                        ? "இப்பிரிவில் பொருட்கள் எதுவும் தற்போது கிடைக்கவில்லை. வேறு பிரிவைத் தேர்ந்தெடுக்கவும்!"
                        : "No products found in this category yet. Try another one!";
                    $response['quick_replies'] = [$qrBrowse, $qrHuman];
                    $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
                    $response['last_id'] = $msgId;
                }
            }
        } catch (Exception $e) {
            $response['message'] = $isTamil
                ? "மன்னிக்கவும், அந்தப் பிரிவை ஏற்றுவதில் சிக்கல் ஏற்பட்டது. மீண்டும் முயற்சிக்கவும்."
                : "Sorry, I couldn't load that category. Please try again.";
            $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message']);
            $response['last_id'] = $msgId;
        }
        return $response;
    }
    
    // 2. Browse Products - show categories
    if (containsAny($msgLower, ['browse products', 'browse', 'categories', 'show categories', 'all products', 'show all products', 'பொருட்கள்', 'பிரிவுகள்', 'பொருட்களைப் பார்க்க', 'அனைத்துப் பொருட்கள்'])) {
        try {
            $categoryDAL = new CategoryDAL();
            $categories = $categoryDAL->getActive();
            if (!empty($categories)) {
                $response['message'] = $isTamil
                    ? "பார்வையிட ஒரு பிரிவைத் தேர்ந்தெடுக்கவும்:"
                    : "Choose a category to explore:";
                $response['type'] = 'categories';
                $response['categories'] = array_map(function($c) use ($isTamil) {
                    return [
                        'id' => $c['id'],
                        'name' => $c['name'],
                        'name_translated' => $isTamil ? translate_text($c['name']) : $c['name'],
                        'slug' => $c['slug'],
                        'image' => $c['image'] ?? ''
                    ];
                }, $categories);
                $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'categories', ['categories' => $response['categories']]);
                $response['last_id'] = $msgId;
            } else {
                $response['message'] = $isTamil
                    ? "பிரிவுகள் எதுவும் தற்போது கிடைக்கவில்லை. குறிப்பிட்ட பொருளைத் தேட முயற்சி செய்யவும்!"
                    : "No categories available right now. Try searching for a specific product!";
                $response['quick_replies'] = [$qrHuman];
                $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
                $response['last_id'] = $msgId;
            }
        } catch (Exception $e) {
            $response['message'] = $isTamil
                ? "மன்னிக்கவும், பிரிவுகளை ஏற்ற முடியவில்லை. மீண்டும் முயற்சிக்கவும்."
                : "Sorry, I couldn't load categories. Please try again.";
            $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message']);
            $response['last_id'] = $msgId;
        }
        return $response;
    }

    // 3. Track order intent
    if (containsAny($msgLower, ['track', 'order status', 'where is my order', 'my order', 'track order', 'ஆர்டர்', 'ஆர்டரைக் கண்காணிக்க', 'நிலை', 'எங்கே'])) {
        $response['message'] = $isTamil
            ? "நிச்சயமாக! உங்கள் ஆர்டர் எண்ணை (எ.கா: ORD-12345) உள்ளிடவும், அதன் நிலையை உடனே சரிபார்த்து கூறுகிறேன்."
            : "Sure! Please enter your order number (e.g. ORD-12345) and I'll check the status for you.";
        $response['quick_replies'] = [$qrBrowse, $qrHuman];
        $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
        $response['last_id'] = $msgId;
        return $response;
        
    } elseif (preg_match('/^[A-Za-z0-9_-]{5,}$/', trim($message)) && !containsAny($msgLower, ['hello', 'hi', 'hey', 'browse', 'help', 'thank', 'human', 'delivery', 'payment', 'return', 'வணக்கம்', 'நன்றி', 'உதவி'])) {
        // User entered an order number - look it up
        $orderNumber = strtoupper(trim($message));
        try {
            require_once __DIR__ . '/../dal/OrderDAL.php';
            $orderDAL = new OrderDAL();
            $order = $orderDAL->getByOrderNumber($orderNumber);
            
            if ($order) {
                $statusLabelsTa = [
                    'pending' => 'நிலுவையில் உள்ளது (Pending)',
                    'processing' => 'தயாரிக்கப்படுகிறது (Processing)',
                    'shipped' => 'அனுப்பப்பட்டது (Shipped)',
                    'delivered' => 'விநியோகிக்கப்பட்டது (Delivered)',
                    'cancelled' => 'ரத்து செய்யப்பட்டது (Cancelled)',
                ];
                $statusLabelsEn = [
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'cancelled' => 'Cancelled',
                ];
                $payLabelsTa = [
                    'pending' => 'நிலுவையில் (Pending)',
                    'paid' => 'செலுத்தப்பட்டது (Paid)',
                    'failed' => 'தோல்வி (Failed)',
                ];

                if ($isTamil) {
                    $response['message'] = "📦 ஆர்டர் விவரம்: {$order['order_number']}\n\n";
                    $response['message'] .= "நிலை: " . ($statusLabelsTa[$order['order_status']] ?? ucfirst($order['order_status'])) . "\n";
                    $response['message'] .= "கட்டணம்: " . ($payLabelsTa[$order['payment_status']] ?? ucfirst($order['payment_status'])) . "\n";
                    $response['message'] .= "மொத்தம்: LKR " . number_format($order['total'], 2) . "\n";
                    $response['message'] .= "ஆர்டர் நாள்: " . date('d M Y', strtotime($order['created_at']));
                    
                    if ($order['order_status'] === 'shipped') {
                        $response['message'] .= "\n\n🚀 உங்கள் ஆர்டர் அனுப்பப்பட்டுவிட்டது! விரைவில் வந்து சேரும்.";
                    } elseif ($order['order_status'] === 'delivered') {
                        $response['message'] .= "\n\n🎉 உங்கள் ஆர்டர் வெற்றிகரமாக விநியோகிக்கப்பட்டுள்ளது. வானகத்தின் தூய தயாரிப்புகளை மகிழ்வோடு அனுபவிக்கவும்!";
                    }
                } else {
                    $response['message'] = "📦 Order: {$order['order_number']}\n\n";
                    $response['message'] .= "Status: " . ($statusLabelsEn[$order['order_status']] ?? ucfirst($order['order_status'])) . "\n";
                    $response['message'] .= "Payment: " . ucfirst($order['payment_status']) . "\n";
                    $response['message'] .= "Total: LKR " . number_format($order['total'], 2) . "\n";
                    $response['message'] .= "Placed: " . date('M j, Y', strtotime($order['created_at']));
                    
                    if ($order['order_status'] === 'shipped') {
                        $response['message'] .= "\n\n🚀 Your order is on the way! It will reach you soon.";
                    } elseif ($order['order_status'] === 'delivered') {
                        $response['message'] .= "\n\n🎉 Your order has been delivered! We hope you enjoy it.";
                    }
                }
                
                $response['quick_replies'] = [$qrBrowse, $qrHuman];
                $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
                $response['last_id'] = $msgId;
                return $response;
            }
        } catch (Exception $e) {}
        
        $response['message'] = $isTamil
            ? "\"{$message}\" என்ற எண்ணில் ஆர்டர் எதுவும் காணப்படவில்லை. தயவுசெய்து எண்ணை சரிபார்த்து மீண்டும் உள்ளிடவும்."
            : "I couldn't find an order with number \"" . htmlspecialchars(trim($message)) . "\". Please double-check and try again.";
        $response['quick_replies'] = [$qrTrack, $qrBrowse, $qrHuman];
        $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
        $response['last_id'] = $msgId;
        return $response;
        
    } elseif (containsAny($msgLower, ['delivery', 'shipping', 'deliver', 'ship', 'விநியோகம்', 'டெலிவரி', 'கட்டணம்'])) {
        $response['message'] = $isTamil
            ? "இலங்கை முழுவதும் துரிதமான விநியோகம் செய்கிறோம். பொதுவாக 2-4 வேலை நாட்களில் உங்கள் இல்லத்திற்கு வந்து சேரும். LKR 2,500-க்கு மேற்பட்ட ஆர்டர்களுக்கு இலவச விநியோகம் உண்டு!"
            : "We offer island-wide delivery across Sri Lanka. Standard delivery takes 2-4 business days. Free delivery is available on orders above LKR 2,500!";
        $response['quick_replies'] = [$qrBrowse, $qrHuman];
        $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
        $response['last_id'] = $msgId;
        return $response;
        
    } elseif (containsAny($msgLower, ['return', 'refund', 'exchange', 'warranty', 'guarantee', 'quality', 'திருப்பியளிப்பு', 'ரீபண்ட்', 'தரம்', 'உத்தரவாதம்'])) {
        $response['message'] = $isTamil
            ? "வானகம் 100% தூய மற்றும் இயற்கையான தரத்திற்கு உத்தரவாதம் அளிக்கிறது. ஏதேனும் சேதம் அல்லது குறைபாடு இருப்பின் 7 நாட்களுக்குள் மாற்றிக்கொள்ளலாம். உதவி பெற எங்கள் குழுவை தொடர்பு கொள்ள விரும்புகிறீர்களா?"
            : "We guarantee 100% pure and natural quality foods. If you receive damaged or defective items, we provide replacements within 7 days. Would you like to speak with our support team?";
        $response['quick_replies'] = [$qrHuman, $qrBrowse];
        $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
        $response['last_id'] = $msgId;
        return $response;
        
    } elseif (containsAny($msgLower, ['payment', 'pay', 'card', 'cash on delivery', 'cod', 'bank', 'பணம்', 'கட்டணம்', 'கார்டு', 'வங்கி'])) {
        $response['message'] = $isTamil
            ? "நேரடி பண விநியோகம் (Cash on Delivery), கார்டு கட்டணங்கள் (Visa/Mastercard) மற்றும் நேரடி வங்கி வைப்பு ஆகியவற்றை நாங்கள் ஏற்கிறோம். அனைத்து கட்டண முறைகளும் 100% பாதுகாப்பானவை."
            : "We accept Cash on Delivery (COD), Card payments (Visa/Mastercard), and Direct Bank Transfer. All payment transactions are 100% secure.";
        $response['quick_replies'] = [$qrBrowse, $qrHuman];
        $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
        $response['last_id'] = $msgId;
        return $response;
        
    } elseif (containsAny($msgLower, ['hello', 'hi', 'hey', 'good morning', 'good evening', 'வணக்கம்', 'ஹலோ', 'ஹாய்', 'காலை வணக்கம்', 'மாலை வணக்கம்'])) {
        $response['message'] = $isTamil
            ? "வணக்கம்! வானகத்திற்கு (VAANAKAM) நல்வரவு. தூய மரச்செக்கு எண்ணெய்கள், இயற்கை மளிகைப் பொருட்கள், முந்திரி, பாரம்பரிய தானியங்கள், மற்றும் உங்கள் ஆர்டர் விவரங்களை அறிய நான் உதவ முடியும். உங்களுக்கு என்ன வேண்டும்?"
            : "Hello! Welcome to VAANAKAM. I can help you find pure organic groceries, cold-pressed oils, cashews, traditional grains, track orders, or answer any questions. What are you looking for?";
        $response['quick_replies'] = [$qrBrowse, $qrTrack, $qrHuman];
        $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
        $response['last_id'] = $msgId;
        return $response;
        
    } elseif (containsAny($msgLower, ['human', 'agent', 'real person', 'speak to someone', 'contact human', 'contact', 'உதவியாளர்', 'மனிதர்', 'நிர்வாகி', 'உதவி', 'பேச வேண்டும்'])) {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $response['message'] = $isTamil
                ? "எங்கள் வாடிக்கையாளர் சேவை நிர்வாகியிடம் உங்களை இணைக்க, தயவுசெய்து உங்கள் மின்னஞ்சல் முகவரியை உள்ளிடவும்:"
                : "To connect you with our support team, please share your email address so we can follow up with you:";
            $response['quick_replies'] = [$qrBrowse];
            $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
            $response['last_id'] = $msgId;
            $chatDAL->updateStatus($conversationId, 'awaiting_email');
        } else {
            requestHumanFromBot($chatDAL, $conversationId);
            $response['message'] = $isTamil
                ? "எங்கள் வாடிக்கையாளர் சேவை குழுவுடன் உங்களை இணைக்கிறோம். நிர்வாகி விரைவில் பதிலளிப்பார். அவசர உதவிக்கு எங்கள் தொலைபேசி: +94 77 030 5367"
                : "Connecting you with our support team now. An agent will respond shortly. You can also call us directly at +94 77 030 5367.";
            $response['type'] = 'human_requested';
            $response['last_id'] = 0;
        }
        return $response;
        
    } elseif (containsAny($msgLower, ['thank', 'thanks', 'bye', 'goodbye', 'நன்றி', 'மிக்க நன்றி'])) {
        $response['message'] = $isTamil
            ? "மிக்க மகிழ்ச்சி! எப்போது வேண்டுமானாலும் தொடர்பு கொள்ளுங்கள். சிறந்த உணவுடன் ஆரோக்கியமான வாழ்வு அமைய வாழ்த்துக்கள்! 🌱"
            : "You're welcome! Feel free to reach out anytime. Good Food - Healthy Life! 🌱";
        $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message']);
        $response['last_id'] = $msgId;
        return $response;
        
    } else {
        // Try product search with English translation of Tamil grocery keywords
        $searchQuery = mapTamilSearchQuery($msgLower);
        $foundProducts = false;
        
        try {
            $productDAL = new ProductDAL();
            $products = $productDAL->search($searchQuery);
            
            if (!empty($products)) {
                $products = array_slice($products, 0, 6);
                $response['message'] = $isTamil
                    ? "நீங்கள் தேடியதற்கான சில சிறந்த தயாரிப்புகள் இதோ:"
                    : "Here are some options I found:";
                $response['type'] = 'products';
                $response['products'] = array_map(function($p) use ($isTamil) {
                    return [
                        'id' => $p['id'],
                        'name' => $p['name'],
                        'name_translated' => $isTamil ? translate_product_name($p['name']) : $p['name'],
                        'slug' => $p['slug'],
                        'price' => $p['price'],
                        'original_price' => $p['original_price'],
                        'image' => $p['image'],
                        'category' => $isTamil ? translate_text($p['category_name'] ?? '') : ($p['category_name'] ?? '')
                    ];
                }, $products);
                $response['quick_replies'] = [$qrBrowse, $qrHuman];
                $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'products', ['products' => $response['products'], 'quick_replies' => $response['quick_replies']]);
                $response['last_id'] = $msgId;
                $foundProducts = true;
            }
        } catch (Exception $e) {}
        
        if (!$foundProducts) {
            $response['message'] = $isTamil
                ? "உங்களுக்கு உதவ மகிழ்ச்சி! நான் உதவக்கூடியவை:\n• தூய மரச்செக்கு எண்ணெய்கள் & நெய்\n• இயற்கை மளிகைப் பொருட்கள் & பாரம்பரிய அரிசி\n• முந்திரி & உலர் பருப்புகள்\n• ஆர்டர் கண்காணிப்பு & விநியோக விபரம்\n\nஉங்களுக்கு என்ன தகவல் வேண்டும்?"
                : "I'd be happy to help! I can assist you with:\n• Pure cold-pressed oils & ghee\n• Natural organic groceries & traditional grains\n• Premium cashews & dry fruits\n• Order tracking & delivery info\n\nWhat would you like to know?";
            $response['quick_replies'] = [$qrBrowse, $qrTrack, $qrDelivery, $qrHuman];
            $msgId = $chatDAL->addMessage($conversationId, 'bot', $response['message'], 'quick_replies', ['quick_replies' => $response['quick_replies']]);
            $response['last_id'] = $msgId;
        }
    }
    
    return $response;
}

function requestHuman() {
    $conversationId = (int)($_POST['conversation_id'] ?? 0);
    $isTamil = (get_current_language() === 'ta');

    if (!$conversationId) {
        echo json_encode(['error' => 'Missing conversation']);
        return;
    }
    
    try {
        $chatDAL = new ChatDAL();
        requestHumanFromBot($chatDAL, $conversationId);
        $msg = $isTamil
            ? 'எங்கள் வாடிக்கையாளர் சேவை குழுவுடன் உங்களை இணைக்கிறோம்...'
            : 'Connecting you with our support team...';
        lumak_chat_finish_json_response(
            ['success' => true, 'message' => $msg],
            [
                'handler' => 'chat_admin_notify',
                'conversation_id' => $conversationId,
            ]
        );
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to request human assistance']);
    }
}

function requestHumanFromBot($chatDAL, $conversationId, $guestName = null, $guestEmail = null) {
    $isTamil = (get_current_language() === 'ta');
    $chatDAL->updateStatus($conversationId, 'human_requested');
    $msg = $isTamil
        ? "வாடிக்கையாளர் சேவை நிர்வாகியிடம் உங்களை இணைக்கிறோம். எங்கள் குழுவிற்கு அறிவிக்கப்பட்டுள்ளது, விரைவில் பதிலளிப்பார்கள்..."
        : "I'm connecting you with a human assistant. Our team has been notified and will respond shortly. Please wait...";
    $chatDAL->addMessage($conversationId, 'bot', $msg);

    try {
        lumak_queue_admin_chat_notification($conversationId);
    } catch (Exception $e) {
        // Don't fail the chat flow if email queueing fails
    }
}

function getMessages() {
    $conversationId = (int)($_GET['conversation_id'] ?? $_POST['conversation_id'] ?? 0);
    $afterId = (int)($_GET['after_id'] ?? $_POST['after_id'] ?? 0);
    
    if (!$conversationId) {
        echo json_encode(['error' => 'Missing conversation']);
        return;
    }
    
    try {
        $chatDAL = new ChatDAL();
        $conversation = $chatDAL->getConversation($conversationId);
        $messages = $chatDAL->getMessages($conversationId, $afterId);
        echo json_encode(['success' => true, 'messages' => $messages, 'status' => $conversation['status'] ?? 'bot']);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to get messages']);
    }
}

function adminReply() {
    // Verify admin
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        echo json_encode(['error' => 'Unauthorized']);
        return;
    }
    
    $conversationId = (int)($_POST['conversation_id'] ?? 0);
    $message = trim($_POST['message'] ?? '');
    
    if (!$conversationId || empty($message)) {
        echo json_encode(['error' => 'Missing data']);
        return;
    }
    
    try {
        $chatDAL = new ChatDAL();
        $chatDAL->addMessage($conversationId, 'admin', $message);
        $chatDAL->updateStatus($conversationId, 'human_active');
        $chatDAL->markAsRead($conversationId, 'user');
        
        // Queue email to user about admin response
        $conversation = $chatDAL->getConversation($conversationId);
        if ($conversation['user_id']) {
            $userIdCopy = $conversation['user_id'];
            $messageCopy = $message;
            AsyncMailQueue::add(function() use ($userIdCopy, $messageCopy) {
                try {
                    sendAdminReplyEmail($userIdCopy, $messageCopy);
                } catch (Exception $e) {}
            });
        }
        
        AsyncMailQueue::sendResponse(['success' => true]);
        AsyncMailQueue::flush();
        exit;
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to send reply']);
    }
}

function sendAdminReplyEmail($userId, $replyMessage) {
    require_once __DIR__ . '/../config/database.php';
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = :id");
    $stmt->execute([':id' => $userId]);
    $user = $stmt->fetch();
    
    if (!$user || empty($user['email'])) return;

    lumak_send_html_mail(
        $user['email'],
        $user['name'],
        'Reply from ' . lumak_email_brand_name() . ' Support',
        lumak_email_chat_reply_template($user['name'], $replyMessage),
        "Hi {$user['name']}, our support team replied: {$replyMessage}"
    );
}

function adminGetChats() {
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        echo json_encode(['error' => 'Unauthorized']);
        return;
    }
    
    try {
        $chatDAL = new ChatDAL();
        $chats = $chatDAL->getHumanChats();
        echo json_encode(['success' => true, 'chats' => $chats]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to get chats']);
    }
}

function adminGetMessages() {
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        echo json_encode(['error' => 'Unauthorized']);
        return;
    }
    
    $conversationId = (int)($_GET['conversation_id'] ?? 0);
    $afterId = (int)($_GET['after_id'] ?? 0);
    
    try {
        $chatDAL = new ChatDAL();
        $chatDAL->markAsRead($conversationId, 'user');
        $messages = $chatDAL->getMessages($conversationId, $afterId);
        $conversation = $chatDAL->getConversation($conversationId);
        echo json_encode(['success' => true, 'messages' => $messages, 'conversation' => $conversation]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to get messages']);
    }
}

function closeChat() {
    $conversationId = (int)($_POST['conversation_id'] ?? 0);
    if (!$conversationId) {
        header('Location: ' . BASE_URL . 'admin/chats.php');
        exit;
    }
    
    try {
        $chatDAL = new ChatDAL();
        $chatDAL->updateStatus($conversationId, 'closed');
        $chatDAL->addMessage($conversationId, 'bot', 'This conversation has been closed. Start a new chat if you need further help.');
    } catch (Exception $e) {}
    
    header('Location: ' . BASE_URL . 'admin/chats.php');
    exit;
}

// --- Helper Functions ---

function containsAny($haystack, $needles) {
    foreach ($needles as $needle) {
        if (mb_stripos($haystack, $needle, 0, 'UTF-8') !== false) return true;
    }
    return false;
}

function mapTamilSearchQuery($message) {
    $map = [
        'எண்ணெய்'     => 'oil',
        'தேங்காய்'    => 'coconut',
        'நல்லெண்ணெய்' => 'sesame',
        'கடலை'       => 'groundnut',
        'நெய்'        => 'ghee',
        'முந்திரி'    => 'cashew',
        'அரிசி'       => 'rice',
        'சிவப்பு'     => 'red',
        'தானியம்'     => 'grain',
        'கேழ்வரகு'    => 'millet',
        'ராகி'        => 'ragi',
        'மிளகு'       => 'pepper',
        'மஞ்சள்'      => 'turmeric',
        'மிளகாய்'     => 'chili',
        'மசாலா'       => 'curry',
        'சீரகம்'      => 'cumin',
        'ஏலக்காய்'    => 'cardamom',
        'பட்டை'       => 'cinnamon',
        'கிராம்பு'    => 'clove',
        'தேன்'        => 'honey',
        'வெல்லம்'     => 'jaggery',
        'முருங்கை'    => 'moringa',
        'பருப்பு'     => 'dal',
        'பாதாம்'      => 'almond',
        'உலர் பழம்'   => 'dry fruits',
        'திராட்சை'    => 'raisin',
    ];
    
    foreach ($map as $ta => $en) {
        if (mb_stripos($message, $ta, 0, 'UTF-8') !== false) {
            return $en;
        }
    }
    
    // Remove common English fillers
    $fillers = ['i', 'am', 'looking', 'for', 'a', 'an', 'the', 'want', 'need', 'find', 'show', 'me', 'some', 'any', 'please', 'can', 'you', 'do', 'have', 'is', 'there'];
    $words = explode(' ', $message);
    $meaningful = array_filter($words, function($w) use ($fillers) {
        return strlen($w) > 2 && !in_array($w, $fillers);
    });
    return implode(' ', $meaningful) ?: $message;
}
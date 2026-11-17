<?php
require_once __DIR__ . '/../config/app.php';
$isTamil = (get_current_language() === 'ta');
$pageTitle = __t('faq') . " - " . SITE_NAME;
require_once __DIR__ . '/partials/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="page-content">
            <h1 class="page-title"><?php echo $isTamil ? 'அடிக்கடி கேட்கப்படும் கேள்விகள் (FAQ)' : 'Frequently Asked Questions'; ?></h1>
            <p class="page-updated"><?php echo $isTamil ? 'கடைசியாக புதுப்பிக்கப்பட்டது: ஜூலை 2026 &bull; ' . SITE_NAME : 'Last updated: July 2026 &bull; ' . SITE_NAME; ?></p>

            <div class="page-body">
                <?php if ($isTamil): ?>
                <p><?php echo SITE_NAME; ?> இல் இயற்கை உணவுகள், மரச்செக்கு எண்ணெய்கள், முந்திரி மற்றும் மளிகைப் பொருட்களை வாங்குவது தொடர்பான விரைவான பதில்கள். இங்கு விவரிக்கப்படாத பிற கேள்விகளுக்கு, <a href="<?php echo BASE_URL; ?>contact.php">எங்கள் குழுவைத் தொடர்பு கொள்ளவும்</a> - உங்களுக்கு உதவ நாங்கள் மகிழ்ச்சியடைகிறோம்.</p>

                <h2>வானகம் பற்றி</h2>
                <div class="faq-list">
                    <details class="faq-item" open>
                        <summary>வானகம் என்றால் என்ன?</summary>
                        <p><?php echo SITE_NAME; ?> என்பது இலங்கை முல்லைத்தீவு, முள்ளியவளை, கணுக்கேணி மேற்கில் அமைந்துள்ள ஒரு தூய இயற்கை உணவு அங்காடியாகும். தூய மரச்செக்கு எண்ணெய்கள், உயர்தர முந்திரி, பாரம்பரிய அரிசி தானியங்கள், இயற்கை மசாலாப் பொருட்கள் மற்றும் பாரம்பரிய மளிகைப் பொருட்களை இலங்கை தழுவிய விநியோகத்துடன் நாங்கள் வழங்குகிறோம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>நீங்கள் என்னென்ன பொருட்களை விற்பனை செய்கிறீர்கள்?</summary>
                        <p>100% தூய இயற்கை மற்றும் இரசாயனமற்ற மளிகைப் பொருட்களை நாங்கள் வழங்குகிறோம். இதில் மரச்செக்கு தேங்காய் மற்றும் நல்லெண்ணெய், தூய பசு நெய், உயர்தர முந்திரி மற்றும் உலர் பழங்கள், பாரம்பரிய அரிசி, சிறுதானியங்கள், மசாலாப் பொருட்கள், தூய தேன் மற்றும் மூலிகை உணவுகள் அடங்கும். எங்கள் முழுமையான தயாரிப்புகளை <a href="<?php echo BASE_URL; ?>shop.php">அங்காடிப் பக்கத்தில்</a> பார்வையிடலாம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>உங்கள் தயாரிப்புகள் 100% அசல் மற்றும் தூய்மையானவையா?</summary>
                        <p>ஆம். 100% உண்மையான, தூய, இரசாயனம் மற்றும் கலப்படமற்ற இயற்கை உணவுகளை வழங்குவதில் நாங்கள் உறுதியாக உள்ளோம். ஒவ்வொரு பொருளின் பக்கத்திலும் அதன் முழு விபரங்கள் குறிப்பிடப்பட்டுள்ளன. ஆர்டர் செய்வதற்கு முன் ஏதேனும் கேள்விகள் இருந்தால், <a href="<?php echo BASE_URL; ?>contact.php">எங்களைத் தொடர்பு கொள்ளவும்</a>.</p>
                    </details>
                </div>

                <h2>கணக்கு &amp; ஆர்டர்கள் பதிவு செய்தல்</h2>
                <div class="faq-list">
                    <details class="faq-item" open>
                        <summary>ஆர்டர் செய்வதற்கு எனக்கு கணக்கு தேவையா?</summary>
                        <p><strong>ஆம்.</strong> கூடையைப் பயன்படுத்தவும் ஆர்டரை இறுதி செய்யவும் பதிவு செய்யப்பட்ட கணக்கு அவசியமாகும். <a href="<?php echo BASE_URL; ?>register.php">இலவச கணக்கை உருவாக்கவும்</a> அல்லது <a href="<?php echo BASE_URL; ?>login.php">உள்நுழையவும்</a>.</p>
                    </details>
                    <details class="faq-item">
                        <summary>நான் எவ்வாறு ஆர்டர் செய்வது?</summary>
                        <ol class="page-ordered-list">
                            <li>கணக்கில் <a href="<?php echo BASE_URL; ?>login.php">உள்நுழைக</a> அல்லது <a href="<?php echo BASE_URL; ?>register.php">பதிவுசெய்க</a>.</li>
                            <li>பொருட்களைப் பார்வையிட்டு கூடைக்குச் (Cart) சேர்க்கவும்.</li>
                            <li>செக்அவுட் பக்கத்திற்குச் சென்று விநியோக முகவரியை வழங்கி கட்டணம் செலுத்தவும்.</li>
                            <li>உங்கள் ஆர்டர் பதிவு செய்யப்பட்டதும் உறுதிப்படுத்தல் மின்னஞ்சல் உங்களுக்கு உடனடியாக அனுப்பப்படும்.</li>
                        </ol>
                    </details>
                    <details class="faq-item">
                        <summary>கணக்கை எவ்வாறு உருவாக்குவது?</summary>
                        <p>எங்கள் <a href="<?php echo BASE_URL; ?>register.php">பதிவு பக்கத்திற்குச் சென்று</a> பெயர், மின்னஞ்சல், தொலைபேசி எண் மற்றும் கடவுச்சொல்லை உள்ளிட்டு சமர்ப்பிக்கவும். உடனடியாக உள்நுழைந்து ஆர்டர் செய்யலாம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>கடவுச்சொல்லை மறந்துவிட்டால் என்ன செய்வது?</summary>
                        <p><a href="<?php echo BASE_URL; ?>forgot-password.php">கடவுச்சொல் மறந்துவிட்டது</a> பக்கத்திற்குச் சென்று உங்கள் மின்னஞ்சலை உள்ளிட்டு மீட்டமைப்பு இணைப்பைப் பெறலாம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>ஆர்டரை மாற்றவோ அல்லது ரத்து செய்யவோ முடியுமா?</summary>
                        <p>ஆர்டர் அனுப்பப்படுவதற்கு முன் எங்களை மின்னஞ்சல் அல்லது <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener">வாட்ஸ்அப்</a> மூலம் தொடர்பு கொண்டால் மாற்றங்களைச் செய்ய உதவ முடியும்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>என் முந்தைய ஆர்டர்களை எப்படிப் பார்ப்பது?</summary>
                        <p>உங்கள் கணக்கில் உள்நுழைந்து <a href="<?php echo BASE_URL; ?>my-orders.php">என் ஆர்டர்கள்</a> பக்கத்திற்குச் சென்று ஆர்டர் நிலையைப் பார்க்கலாம்.</p>
                    </details>
                </div>

                <h2>விநியோகம் (Shipping &amp; Delivery)</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>நீங்கள் எங்கு விநியோகம் செய்கிறீர்கள்?</summary>
                        <p>இலங்கை முழுவதும் உள்ள அனைத்து மாவட்டங்களுக்கும் நாங்கள் <strong>நாடு தழுவிய விநியோகம்</strong> செய்கிறோம். எங்கள் அங்காடி <?php echo STORE_LOCATION; ?> இல் அமைந்துள்ளது.</p>
                    </details>
                    <details class="faq-item">
                        <summary>விநியோகத்திற்கு எத்தனை நாட்கள் ஆகும்?</summary>
                        <p>இலங்கைக்குள் பொதுவாக <strong>2–5 வேலை நாட்களுக்குள்</strong> பொருட்கள் உங்கள் இல்லத்திற்கு வந்து சேரும். தொலைதூர பகுதிகளுக்கு சற்று கூடுதல் நேரம் எடுக்கலாம். முழு விபரங்களுக்கு <a href="<?php echo BASE_URL; ?>shipping-policy.php">விநியோகக் கொள்கையைப்</a> பார்க்கவும்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>ஆர்டரை எவ்வாறு பின்தொடர்வது?</summary>
                        <p>ஆர்டர் அனுப்பப்பட்டதும் கண்காணிப்பு இலக்கம் உங்களுக்கு மின்னஞ்சல் செய்யப்படும். எங்கள் <a href="<?php echo BASE_URL; ?>track-order.php">ஆர்டர் கண்காணிப்பு</a> பக்கத்திலும் நிலையை அறியலாம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>எண்ணெய்கள் மற்றும் திரவப் பொருட்கள் எவ்வாறு பாதுகாப்பாக பேக் செய்யப்படுகின்றன?</summary>
                        <p>அனைத்து மரச்செக்கு எண்ணெய்களும் நெய்யும் கசிவு ஏற்படாத பாதுகாப்பு பாட்டில்களில் அடைக்கப்பட்டு, உணவுப் பாதுகாப்பு தரத்துடன் கூடிய பெட்டிகளில் வைத்து சுகாதாரமாக விநியோகிக்கப்படுகின்றன.</p>
                    </details>
                </div>

                <h2>கட்டண முறைகள் (Payments)</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>நீங்கள் ஏற்கும் கட்டண முறைகள் எவை?</summary>
                        <p>கிரெடிட் / டெபிட் கார்டுகள் (Visa, Mastercard, Amex), மற்றும் இலங்கை அஞ்சல் COD (பொருளைப் பெற்று பணம் செலுத்துதல்) ஆகிய முறைகளை நாங்கள் ஏற்கிறோம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>என் கட்டண விபரங்கள் பாதுகாப்பானவையா?</summary>
                        <p>ஆம். நாங்கள் SSL பாதுகாக்கப்பட்ட குறியாக்கத்தைப் பயன்படுத்துகிறோம். உங்கள் அட்டை விபரங்கள் எதுவும் எங்கள் சேவையகத்தில் சேமிக்கப்படுவதில்லை.</p>
                    </details>
                    <details class="faq-item">
                        <summary>விலைகள் எந்த நாணயத்தில் காட்டப்படுகின்றன?</summary>
                        <p>எங்கள் அங்காடியின் விலைகள் இலங்கை ரூபாயில் (LKR) காட்டப்படுகின்றன.</p>
                    </details>
                </div>

                <h2>பொருட்கள் திருப்பியளிப்பு &amp; பணம் திரும்பப் பெறல்</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>பொருட்களை திருப்பியளிக்க முடியுமா?</summary>
                        <p>சேதமடைந்த அல்லது தவறாக அனுப்பப்பட்ட பொருட்களை எங்கள் <a href="<?php echo BASE_URL; ?>refund-policy.php">திருப்பியளிப்பு கொள்கை</a>க்கு உட்பட்டு மாற்றிக்கொள்ளலாம் அல்லது பணத்தை திரும்பப் பெறலாம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>ஆர்டர் சேதமடைந்து வந்தால் என்ன செய்வது?</summary>
                        <p>விநியோகம் கிடைத்த 48 மணி நேரத்திற்குள் புகைப்படங்களுடன் எங்களை வாட்ஸ்அப் அல்லது மின்னஞ்சலில் (<a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a>) தொடர்பு கொள்ளுங்கள்.</p>
                    </details>
                </div>

                <h2>வாடிக்கையாளர் ஆதரவு</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>வாடிக்கையாளர் சேவையை எவ்வாறு தொடர்பு கொள்வது?</summary>
                        <p>எங்கள் <a href="<?php echo BASE_URL; ?>contact.php">தொடர்பு பக்கம்</a>, மின்னஞ்சல் (<a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a>), தொலைபேசி (<?php echo STORE_PHONE_1; ?> / <?php echo STORE_PHONE_2; ?>) அல்லது <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener">வாட்ஸ்அப்</a> மூலம் தொடர்பு கொள்ளலாம்.</p>
                    </details>
                    <details class="faq-item">
                        <summary>உங்கள் உதவி நேரம் என்ன?</summary>
                        <p>திங்கள் முதல் சனி வரை காலை 8:00 மணி முதல் மாலை 6:00 மணி வரை எங்களை தொடர்புகொள்ளலாம். அவசர கேள்விகளுக்கு வாட்ஸ்அப் மிகவும் விரைவான வழியாகும்.</p>
                    </details>
                </div>

                <?php else: ?>
                <p>Quick answers about shopping natural foods, cold-pressed oils, cashews, and groceries at <?php echo SITE_NAME; ?>, operated by <?php echo STORE_OWNER; ?>. For anything not covered here, <a href="<?php echo BASE_URL; ?>contact.php">contact our team</a> - we're happy to help.</p>

                <h2>About <?php echo SITE_NAME; ?></h2>
                <div class="faq-list">
                    <details class="faq-item" open>
                        <summary>What is <?php echo SITE_NAME; ?>?</summary>
                        <p><?php echo SITE_NAME; ?> is a natural foods and grocery store based in Kanukkerny West, Mulliyawalai, Mullaitivu, Sri Lanka. We offer pure cold-pressed oils, premium cashews, traditional grains, organic spices, and authentic natural groceries with island wide delivery across Sri Lanka.</p>
                    </details>
                    <details class="faq-item">
                        <summary>What products do you sell?</summary>
                        <p>We offer 100% natural and chemical-free groceries, including cold-pressed coconut and sesame oils, pure ghee, premium cashews and dry fruits, traditional rice, millets, spices, pure honey, and wellness foods. Browse our full range on the <a href="<?php echo BASE_URL; ?>shop.php">shop page</a>.</p>
                    </details>
                    <details class="faq-item">
                        <summary>Are your products 100% original?</summary>
                        <p>Yes. We are strictly committed to selling 100% genuine, pure, chemical-free and unadulterated natural foods. Product descriptions on each item page include full details. If you have questions about a specific product before ordering, <a href="<?php echo BASE_URL; ?>contact.php">contact us</a>.</p>
                    </details>
                </div>

                <h2>Account &amp; Placing Orders</h2>
                <div class="faq-list">
                    <details class="faq-item" open>
                        <summary>Do I need an account to place an order?</summary>
                        <p><strong>Yes.</strong> You must have a registered account to add items to your cart and complete checkout at <?php echo SITE_NAME; ?>. <a href="<?php echo BASE_URL; ?>register.php">Create a free account</a> or <a href="<?php echo BASE_URL; ?>login.php">log in</a> to start shopping.</p>
                    </details>
                    <details class="faq-item">
                        <summary>How do I place an order?</summary>
                        <ol class="page-ordered-list">
                            <li><a href="<?php echo BASE_URL; ?>register.php">Register</a> for an account or <a href="<?php echo BASE_URL; ?>login.php">log in</a> if you already have one.</li>
                            <li>Browse products and add items to your cart.</li>
                            <li>Go to checkout, enter your delivery details, and complete payment.</li>
                            <li>You will receive an order confirmation by email when your order is placed.</li>
                        </ol>
                    </details>
                    <details class="faq-item">
                        <summary>How do I create an account?</summary>
                        <p>Visit our <a href="<?php echo BASE_URL; ?>register.php">Register page</a>, enter your name, email, phone number, and password, then submit the form. Once registered, you can log in and place orders immediately.</p>
                    </details>
                    <details class="faq-item">
                        <summary>I forgot my password. What should I do?</summary>
                        <p>Use the <a href="<?php echo BASE_URL; ?>forgot-password.php">Forgot Password</a> page to receive a reset link by email. Follow the instructions in the email to set a new password.</p>
                    </details>
                    <details class="faq-item">
                        <summary>Can I change or cancel my order?</summary>
                        <p>If your order has not yet been packed or shipped, contact us as soon as possible at <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a> or <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener">WhatsApp</a>. Once an order is dispatched, changes may not be possible.</p>
                    </details>
                    <details class="faq-item">
                        <summary>How do I view my past orders?</summary>
                        <p>Log in to your account and go to <a href="<?php echo BASE_URL; ?>my-orders.php">My Orders</a> to see order history, status, and details.</p>
                    </details>
                </div>

                <h2>Shipping &amp; Delivery</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>Where do you deliver?</summary>
                        <p>We offer <strong>island wide delivery</strong> across Sri Lanka. We do not currently ship internationally. Our store is located at <?php echo STORE_LOCATION; ?>.</p>
                    </details>
                    <details class="faq-item">
                        <summary>How long does delivery take?</summary>
                        <p>Orders within Sri Lanka typically arrive in <strong>2–5 business days</strong>, depending on your location and courier availability. Remote areas may take slightly longer. See our <a href="<?php echo BASE_URL; ?>shipping-policy.php">Shipping Policy</a> for full details.</p>
                    </details>
                    <details class="faq-item">
                        <summary>How can I track my order?</summary>
                        <p>Once your order ships, you may receive tracking information by email when available. You can also use our <a href="<?php echo BASE_URL; ?>track-order.php">Track Order</a> page with your order number, or check status in <a href="<?php echo BASE_URL; ?>my-orders.php">My Orders</a> when logged in.</p>
                    </details>
                    <details class="faq-item">
                        <summary>Do you offer free shipping?</summary>
                        <p>Free or discounted shipping may be available during promotions or on minimum order values. Any active offers are shown at checkout and on promotional banners on our homepage.</p>
                    </details>
                    <details class="faq-item">
                        <summary>How are grocery products packaged for delivery?</summary>
                        <p>All liquid oils and ghee are packed in heavy-duty leak-proof bottles, and dry food items are hygienically sealed in food-grade packaging with protective cushioning to ensure freshness and safety during transit.</p>
                    </details>
                </div>

                <h2>Payments</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>What payment methods do you accept?</summary>
                        <p>We accept major credit and debit cards (Visa, Mastercard, American Express), and other payment options shown at checkout. All payments are processed through secure payment gateways.</p>
                    </details>
                    <details class="faq-item">
                        <summary>Is my payment information secure?</summary>
                        <p>Yes. We use encrypted connections (SSL) and do not store full card details on our servers. Payments are handled by trusted payment processors.</p>
                    </details>
                    <details class="faq-item">
                        <summary>What currency are prices shown in?</summary>
                        <p>Prices in our store are based on Sri Lankan Rupees (LKR). You may switch the display currency using the currency selector in the top bar; converted amounts are shown for your convenience.</p>
                    </details>
                </div>

                <h2>Returns &amp; Refunds</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>What is your return policy?</summary>
                        <p>We accept returns on eligible unused items in original packaging within the timeframe stated in our <a href="<?php echo BASE_URL; ?>refund-policy.php">Refund Policy</a>. Items that are opened, used, physically damaged, or altered may not be returnable unless faulty or incorrectly supplied.</p>
                    </details>
                    <details class="faq-item">
                        <summary>How do I request a refund or return?</summary>
                        <p>Email us at <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a> with your order number, reason for return, and photos if the item arrived damaged. Our team will guide you through the next steps.</p>
                    </details>
                    <details class="faq-item">
                        <summary>What if my order arrives damaged?</summary>
                        <p>Please contact us within 48 hours of delivery with photos of the packaging and product. We will arrange a replacement or refund where applicable.</p>
                    </details>
                </div>

                <h2>Customer Support</h2>
                <div class="faq-list">
                    <details class="faq-item">
                        <summary>How do I contact customer support?</summary>
                        <p>Reach us via the <a href="<?php echo BASE_URL; ?>contact.php">Contact page</a>, email at <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a>, phone at <?php echo STORE_PHONE_1; ?> / <?php echo STORE_PHONE_2; ?>, or <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener">WhatsApp</a>. You can also use the chat widget on our website.</p>
                    </details>
                    <details class="faq-item">
                        <summary>What are your support hours?</summary>
                        <p>Our team aims to respond as quickly as possible. For urgent order questions, WhatsApp is often the fastest way to reach us.</p>
                    </details>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

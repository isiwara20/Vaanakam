<?php
require_once __DIR__ . '/../config/app.php';
$isTamil = (get_current_language() === 'ta');
$pageTitle = __t('refund_policy') . " - " . SITE_NAME;
require_once __DIR__ . '/partials/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="page-content">
            <h1 class="page-title"><?php echo $isTamil ? 'பொருட்கள் திருப்பியளிப்பு &amp; பணத்தைத் திரும்பப் பெறுதல் கொள்கை' : 'Refund &amp; Return Policy'; ?></h1>
            <p class="page-updated"><?php echo $isTamil ? 'கடைசியாக புதுப்பிக்கப்பட்டது: ஜூலை 2026 &bull; ' . SITE_NAME : 'Last updated: July 2026 &bull; ' . SITE_NAME; ?></p>

            <div class="page-body">
                <?php if ($isTamil): ?>
                <p><?php echo SITE_NAME; ?> இல் நீங்கள் செய்யும் ஒவ்வொரு வாங்குதலிலும் திருப்தியடைய வேண்டும் என்பதே எங்கள் விருப்பம். ஏதேனும் சிக்கல் ஏற்பட்டால், பொருட்கள் திருப்பியளிப்பு மற்றும் பணம் திரும்பப் பெறுதல் எவ்வாறு செயல்படுகிறது என்பதை இக்கொள்கை விளக்குகிறது.</p>

                <h2>1. திருப்பியளிப்பதற்கான தகுதிகள்</h2>
                <p>பின்வரும் நிபந்தனைகள் பூர்த்தியாகும் பட்சத்தில் நீங்கள் பொருட்களை திருப்பியளிக்கக் கோரலாம்:</p>
                <ul>
                    <li>பொருட்களைப் பெற்ற <strong>7 நாட்களுக்குள்</strong> எங்களைத் தொடர்பு கொள்ள வேண்டும்.</li>
                    <li>பொருள் <strong>பயன்படுத்தப்படாமல்</strong>, அதன் <strong>அசல் பேக்கிங் மற்றும் சீல்</strong> உடன் அப்படியே இருக்க வேண்டும்.</li>
                    <li>உங்கள் ஆர்டர் எண் மற்றும் திருப்பியளிப்பதற்கான காரணத்தை வழங்க வேண்டும்.</li>
                </ul>

                <h2>2. திருப்பியளிக்க முடியாத பொருட்கள்</h2>
                <p>சேதமடைந்து அல்லது குறைபாட்டுடன் வந்தாலன்றி, பின்வரும் பொருட்களை திருப்பியளிக்கவோ அல்லது பணத்தைத் திரும்பப் பெறவோ முடியாது:</p>
                <ul>
                    <li>சீல் பிரிக்கப்பட்ட அல்லது திறக்கப்பட்ட உணவுப் பொருட்கள், தேன், நெய் மற்றும் எண்ணெய் பாட்டில்கள் (உணவு பாதுகாப்பு கருதி).</li>
                    <li>தனிப்பயனாக்கப்பட்ட அல்லது சிறப்பு சலுகையில் (Clearance / Final Sale) வாங்கப்பட்ட பொருட்கள்.</li>
                    <li>விநியோகத்திற்குப் பின் தவறான பயன்பாட்டினால் சேதமடைந்த பொருட்கள்.</li>
                </ul>

                <h2>3. சேதமடைந்த அல்லது தவறான பொருட்கள்</h2>
                <p>உங்களுக்கு சேதமடைந்த, கசிவு ஏற்பட்ட அல்லது தவறான பொருள் கிடைத்திருந்தால்:</p>
                <ul>
                    <li>விநியோகம் கிடைத்த <strong>48 மணி நேரத்திற்குள்</strong> எங்களைத் தொடர்பு கொள்ளவும்.</li>
                    <li>பொருள் மற்றும் அதன் பார்சல் பேக்கிங்கின் புகைப்படங்களை அனுப்பவும்.</li>
                    <li>உடனடியாக மாற்றுப் பொருள் அனுப்பி வைக்கப்படும் அல்லது விநியோகக் கட்டணம் உட்பட முழுத் தொகையும் திருப்பித் தரப்படும்.</li>
                </ul>

                <h2>4. திருப்பியளிக்கும் வழிமுறை</h2>
                <ol class="page-ordered-list">
                    <li>உங்கள் ஆர்டர் எண், திருப்பியளிக்க விரும்பும் பொருள் மற்றும் காரணத்தைக் குறிப்பிட்டு <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a> அல்லது வாட்ஸ்அப் மூலம் செய்தி அனுப்பவும்.</li>
                    <li>எங்கள் குழுவின் ஒப்புதல் மற்றும் வழிகாட்டுதலுக்காக காத்திருக்கவும்.</li>
                    <li>பொருளை பாதுகாப்பான முறையில் பேக் செய்து திருப்பி அனுப்பவும். எங்கள் தவறு காரணமாக அன்றி பிற காரணங்களுக்காக திருப்பியளிக்கும் விநியோகக் கட்டணம் வாடிக்கையாளருடையதாகும்.</li>
                    <li>பொருள் பெறப்பட்டு சரிபார்க்கப்பட்டதும், உங்கள் பணம் திரும்ப வழங்கப்படும் அல்லது மாற்றுப்பொருள் அனுப்பப்படும்.</li>
                </ol>

                <h2>5. பணத்தைத் திரும்பப் பெறுதல் (Refund Processing)</h2>
                <ul>
                    <li>ஒப்புதல் அளிக்கப்பட்ட தொகையானது திருப்பி அனுப்பப்பட்ட பொருள் பெறப்பட்டதிலிருந்து <strong>7–10 வேலை நாட்களுக்குள்</strong> செயலாக்கப்படும்.</li>
                    <li>நீங்கள் ஆர்டர் செய்ய பயன்படுத்திய <strong>அசல் கட்டண முறைக்கே</strong> பணம் திருப்பித் தரப்படும் (Online Card Payment அல்லது Bank Transfer).</li>
                    <li>வங்கி நடைமுறைகளைப் பொறுத்து உங்கள் கணக்கில் தொகை சேர மேலும் 3–7 நாட்கள் ஆகலாம்.</li>
                </ul>

                <h2>6. ஆர்டரை ரத்து செய்தல் (Cancellations)</h2>
                <ul>
                    <li>ஆர்டர் பேக் செய்யப்பட்டு அல்லது கொரியரில் அனுப்பப்படுவதற்கு முன் இலவசமாக ரத்து செய்யலாம். உடனே <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a> அல்லது வாட்ஸ்அப்பில் தொடர்பு கொள்ளவும்.</li>
                    <li>ரத்து செய்யப்பட்ட ஆர்டர்களுக்கான தொகை 5–7 வேலை நாட்களுக்குள் திருப்பிச் செலுத்தப்படும்.</li>
                </ul>

                <h2>7. எங்களைத் தொடர்பு கொள்ள</h2>
                <p>திருப்பியளிப்பு அல்லது பணம் திரும்பப் பெறுதல் தொடர்பாக உதவி தேவையா?</p>
                <ul>
                    <li><strong>மின்னஞ்சல்:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>தொலைபேசி:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>வாட்ஸ்அப்:</strong> <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener"><?php echo STORE_WHATSAPP; ?></a></li>
                    <li><strong>தொடர்புப் படிவம்:</strong> <a href="<?php echo BASE_URL; ?>contact.php">எங்களைத் தொடர்பு கொள்ளவும்</a></li>
                </ul>

                <?php else: ?>
                <p>We want you to be happy with every <?php echo SITE_NAME; ?> purchase. If something isn't right, this policy explains how returns, exchanges, and refunds work.</p>

                <h2>1. Return Eligibility</h2>
                <p>You may request a return if all of the following apply:</p>
                <ul>
                    <li>You contact us within <strong>7 days</strong> of receiving your order.</li>
                    <li>The item is <strong>unused</strong>, in its <strong>original condition</strong>, and in <strong>original packaging</strong> with seals intact.</li>
                    <li>You provide your order number and a brief reason for the return.</li>
                </ul>

                <h2>2. Non-Returnable Items</h2>
                <p>The following items cannot be returned or refunded unless they arrive damaged or defective:</p>
                <ul>
                    <li>Opened, unsealed grocery food items, oils, ghee, honey, and edible products (due to hygiene and food safety).</li>
                    <li>Customized or personalized products.</li>
                    <li>Items marked as final sale or clearance.</li>
                    <li>Items damaged due to misuse or improper storage after delivery.</li>
                </ul>

                <h2>3. Damaged or Wrong Items</h2>
                <p>If you receive a damaged, defective, or incorrect item:</p>
                <ul>
                    <li>Contact us within <strong>48 hours</strong> of delivery.</li>
                    <li>Send photos of the product and packaging.</li>
                    <li>We will arrange a replacement, exchange, or full refund — including shipping costs where we are at fault.</li>
                </ul>

                <h2>4. How to Request a Return</h2>
                <ol class="page-ordered-list">
                    <li>Email <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a> or message WhatsApp with your order number, item(s) to return, and reason.</li>
                    <li>Wait for return approval and instructions from our team.</li>
                    <li>Ship the item back in secure packaging. Return shipping costs are the customer's responsibility unless the return is due to our error.</li>
                    <li>Once we receive and inspect the item, we will process your refund or replacement.</li>
                </ol>

                <h2>5. Refund Processing</h2>
                <ul>
                    <li>Approved refunds are processed within <strong>7–10 business days</strong> after we receive the returned item.</li>
                    <li>Refunds are issued to the <strong>original payment method</strong> used at checkout.</li>
                    <li>Depending on your bank or card provider, it may take an additional 3–7 business days for the refund to appear in your account.</li>
                    <li>Original shipping fees are non-refundable unless the return is due to a <?php echo SITE_NAME; ?> error (wrong item, defective product, etc.).</li>
                </ul>

                <h2>6. Cancellations</h2>
                <ul>
                    <li>Orders may be cancelled before they are packed or shipped. Contact us immediately at <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a> or WhatsApp.</li>
                    <li>If your order has already been dispatched, you may need to follow the standard return process once it arrives.</li>
                    <li>Cancelled orders are refunded within 5–7 business days.</li>
                </ul>

                <h2>7. Contact Us</h2>
                <p>Need help with a return or refund?</p>
                <ul>
                    <li><strong>Email:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>Phone:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>WhatsApp:</strong> <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener"><?php echo STORE_WHATSAPP; ?></a></li>
                    <li><strong>Contact form:</strong> <a href="<?php echo BASE_URL; ?>contact.php">Contact Us</a></li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

<?php
require_once __DIR__ . '/../config/app.php';
$isTamil = (get_current_language() === 'ta');
$pageTitle = __t('shipping_policy') . " - " . SITE_NAME;
require_once __DIR__ . '/partials/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="page-content">
            <h1 class="page-title"><?php echo $isTamil ? 'விநியோகக் கொள்கை (Shipping &amp; Delivery Policy)' : 'Shipping &amp; Delivery Policy'; ?></h1>
            <p class="page-updated"><?php echo $isTamil ? 'செயல்முறை தேதி: 01 ஜனவரி 2026 &bull; கடைசியாக புதுப்பிக்கப்பட்டது: ஜூலை 2026' : 'Effective Date: 01 January 2026 &bull; Last updated: July 2026'; ?></p>

            <div class="page-body">
                <?php if ($isTamil): ?>
                <p>இந்த விநியோகக் கொள்கை <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a> (நிர்வாகம்: <?php echo STORE_OWNER; ?>, வணிகப் பதிவு: <?php echo STORE_BUSINESS_REG; ?>) மூலம் செய்யப்படும் அனைத்து ஆர்டர்களுக்கும் பொருந்தும்.</p>
                <p><strong>இலங்கை அஞ்சல் துறை (Sri Lanka Post COD Service)</strong> மற்றும் அதிகாரப்பூர்வ அஞ்சல் விநியோக அமைப்புகளின் மூலம் <strong>இலங்கை முழுவதும் நாடு தழுவிய விநியோகத்தை</strong> நாங்கள் பெருமையுடன் வழங்குகிறோம்.</p>
                <p><?php echo SITE_NAME; ?> இல் ஆர்டர் செய்வதன் மூலம், கீழே குறிப்பிடப்பட்டுள்ள விதிமுறைகளை நீங்கள் ஏற்கிறீர்கள். எங்கள் <a href="<?php echo BASE_URL; ?>terms.php">விதிமுறைகள் &amp; நிபந்தனைகள்</a> மற்றும் <a href="<?php echo BASE_URL; ?>refund-policy.php">திருப்பியளிப்பு கொள்கை</a>யையும் பார்க்கவும்.</p>

                <h2>1. நிறுவனத்தின் விபரங்கள்</h2>
                <ul>
                    <li><strong>சட்டப்பூர்வ பெயர்:</strong> <?php echo STORE_OWNER; ?></li>
                    <li><strong>வணிகப் பதிவு எண்:</strong> <?php echo STORE_BUSINESS_REG; ?></li>
                    <li><strong>வணிகப் பெயர்:</strong> <?php echo SITE_NAME; ?></li>
                    <li><strong>முகவரி:</strong> <?php echo STORE_LOCATION; ?></li>
                    <li><strong>தொலைபேசி:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>மின்னஞ்சல்:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>இணையதளம்:</strong> <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a></li>
                </ul>

                <h2>2. விநியோகக் கூட்டு (Primary Partner)</h2>
                <p>நாங்கள் முக்கியமாகப் பயன்படுத்துவது:</p>
                <h3>இலங்கை அஞ்சல் துறை (Sri Lanka Post COD Service)</h3>
                <p>அனைத்து Cash on Delivery (COD) ஆர்டர்களும் அதிகாரப்பூர்வ <strong>இலங்கை அஞ்சல் சேவை</strong> மூலம் கையாளப்படுகின்றன.</p>
                <ul>
                    <li>இலங்கை முழுவதும் உள்ள கிராமங்கள் உட்பட நாடு தழுவிய விநியோகப் பரப்பளவு</li>
                    <li>அரசு அஞ்சல் துறை பாதுகாப்பு மற்றும் தரநிலைகள்</li>
                    <li>நம்பகமான பார்சல் கண்காணிப்பு முறை</li>
                    <li>பொருளைப் பெற்றுக் கொண்டு பணம் செலுத்தும் வசதி (COD)</li>
                </ul>
                <p><strong>கண்காணிப்பு:</strong> பார்சல் அனுப்பப்பட்டதும் அதற்கான <strong>SL Post பார்சல் கண்காணிப்பு எண் (Barcode / Reference ID)</strong> உங்களுக்கு வழங்கப்படும்.</p>

                <h2>3. விநியோகப் பகுதிகள்</h2>
                <p>நாங்கள் விநியோகம் செய்யும் பகுதிகள்:</p>
                <ul>
                    <li>கொழும்பு மற்றும் புறநகர்ப் பகுதிகள்</li>
                    <li>இலங்கையின் அனைத்து 25 மாவட்டங்களும்</li>
                    <li>அஞ்சல் அலுவலக எல்லைக்குட்பட்ட அனைத்து கிராமப் பகுதிகளும்</li>
                </ul>
                <p>தற்போது நாங்கள் இலங்கைக்குள் மட்டுமே விநியோகம் செய்கிறோம். சர்வதேச விநியோகம் இல்லை.</p>

                <h2>4. ஆர்டர் செயலாக்க நேரம்</h2>
                <p>ஆர்டர் உறுதிப்படுத்தப்பட்டதிலிருந்து <strong>24–48 மணி நேரத்திற்குள்</strong> பார்சல் பேக் செய்யப்பட்டு அஞ்சல் துறைக்கு ஒப்படைக்கப்படும்.</p>
                <ul>
                    <li>வார இறுதி நாட்கள் மற்றும் பொது விடுமுறை நாட்களில் பெறப்படும் ஆர்டர்கள் அடுத்த வேலை நாளில் அனுப்பப்படும்.</li>
                    <li>ஒவ்வொரு உணவுப் பொருளும் சுகாதாரமான முறையில் பரிசோதிக்கப்பட்டு, கசிவு ஏற்படாத பாதுகாப்பு பாட்டில்களில் அடைக்கப்படும்.</li>
                </ul>

                <h2>5. விநியோக கால அளவு</h2>
                <p><strong>பார்சல் அனுப்பப்பட்டதிலிருந்து மதிப்பிடப்பட்ட விநியோக நாட்கள்:</strong></p>
                <ul>
                    <li><strong>கொழும்பு &amp; மேல் மாகாணம்:</strong> 1–3 வேலை நாட்கள்</li>
                    <li><strong>பிற பிரதான நகரங்கள்:</strong> 2–5 வேலை நாட்கள்</li>
                    <li><strong>தொலைதூர / கிராமப் பகுதிகள்:</strong> 3–7 வேலை நாட்கள்</li>
                </ul>
                <p><strong>குறிப்பு:</strong> சீரற்ற வானிலை, அஞ்சல் தாமதங்கள் அல்லது பொது விடுமுறை நாட்களில் விநியோகத்தில் சிறிது தாமதம் ஏற்படலாம்.</p>

                <h2>6. பொருளைப் பெற்று பணம் செலுத்துதல் (Cash on Delivery - COD)</h2>
                <ul>
                    <li>பார்சலைப் பெற்றுக் கொள்ளும்போது பணத்தை அஞ்சல் ஊழியரிடம் செலுத்தலாம்.</li>
                    <li>சரியான தொலைபேசி எண் மற்றும் முழுமையான விநியோக முகவரியை வழங்குவது அவசியமாகும்.</li>
                    <li>வாடிக்கையாளர் அல்லது பொறுப்பான நபர் இல்லத்தில் இருக்க வேண்டும்.</li>
                </ul>

                <h2>7. விநியோகக் கட்டணம்</h2>
                <p>விநியோகக் கட்டணம் பொருளின் எடை, பார்சல் அளவு மற்றும் அஞ்சல் கட்டண விதிகளின் அடிப்படையில் கணக்கிடப்படும். ஆர்டரை இறுதி செய்யும் (Checkout) பக்கத்தில் துல்லியமான விநியோகக் கட்டணம் காட்டப்படும்.</p>

                <h2>8. ஆர்டர் கண்காணிப்பு</h2>
                <p>ஆர்டர் அனுப்பப்பட்டதும் கண்காணிப்பு எண்ணுடன் கூடிய மின்னஞ்சல் அல்லது எஸ்.எம்.எஸ் உங்களுக்கு அனுப்பப்படும். எங்கள் <a href="<?php echo BASE_URL; ?>track-order.php">ஆர்டர் கண்காணிப்பு பக்கத்தில்</a> உங்கள் ஆர்டர் எண்ணை உள்ளிட்டும் நிலையை அறியலாம்.</p>

                <h2>9. இயற்கை உணவுகள் &amp; எண்ணெய்களுக்கான பேக்கிங் பாதுகாப்பு</h2>
                <p>அனைத்து மரச்செக்கு எண்ணெய்களும் உணவுப் பாதுகாப்புத் தரம் வாய்ந்த கசிவு-எதிர்ப்பு பாட்டில்களில் அடைக்கப்படுகின்றன. தானியங்கள், முந்திரி மற்றும் மளிகைப் பொருட்கள் ஈரப்பதத்திலிருந்து பாதுகாக்கப்பட்டு சுகாதாரமான முறையில் சீல் செய்யப்படுகின்றன.</p>

                <h2>10. வாடிக்கையாளர் ஆதரவு</h2>
                <p>விநியோகம் தொடர்பான சந்தேகங்களுக்கு எங்களைத் தொடர்பு கொள்ளவும்:</p>
                <ul>
                    <li><strong>தொலைபேசி:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>மின்னஞ்சல்:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>வாட்ஸ்அப்:</strong> <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener"><?php echo STORE_WHATSAPP; ?></a></li>
                    <li><strong>தொடர்புப் படிவம்:</strong> <a href="<?php echo BASE_URL; ?>contact.php">தொடர்புகொள்ள</a></li>
                </ul>

                <?php else: ?>
                <p>This Shipping &amp; Delivery Policy applies to all orders placed on <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a>, operated by <?php echo STORE_OWNER; ?> (Business Registration: <?php echo STORE_BUSINESS_REG; ?>).</p>
                <p>We proudly deliver <strong>island wide across Sri Lanka</strong> using <strong>Sri Lanka Post (SL Post COD Service)</strong> and other official postal logistics systems where applicable.</p>
                <p>By placing an order on <?php echo SITE_NAME; ?>, you agree to the terms outlined below. Please also review our <a href="<?php echo BASE_URL; ?>terms.php">Terms &amp; Conditions</a> and <a href="<?php echo BASE_URL; ?>refund-policy.php">Refund Policy</a>.</p>

                <h2>1. Company Information</h2>
                <ul>
                    <li><strong>Legal Name:</strong> <?php echo STORE_OWNER; ?></li>
                    <li><strong>Business Registration:</strong> <?php echo STORE_BUSINESS_REG; ?></li>
                    <li><strong>Trading Name:</strong> <?php echo SITE_NAME; ?></li>
                    <li><strong>Address:</strong> <?php echo STORE_LOCATION; ?></li>
                    <li><strong>Phone:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>Email:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>Website:</strong> <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a></li>
                </ul>

                <h2>2. Delivery Partner (Primary Service)</h2>
                <p>We primarily use:</p>
                <h3>Sri Lanka Post (SL Post COD Service)</h3>
                <p>All Cash on Delivery (COD) shipments are handled through the official <strong>Sri Lanka Post Cash on Delivery system</strong>.</p>
                <p>Features include:</p>
                <ul>
                    <li>Island wide delivery coverage across Sri Lanka</li>
                    <li>Government postal security and handling standards</li>
                    <li>Reliable tracking through the SL Post network</li>
                    <li>Cash collection at the delivery point for COD orders</li>
                    <li>Nationwide postal network including rural and remote areas</li>
                </ul>
                <p><strong>Tracking:</strong> Each parcel is assigned an <strong>SL Post tracking number (barcode / reference ID)</strong> for status updates once dispatched.</p>

                <h2>3. Delivery Coverage</h2>
                <p>We deliver to:</p>
                <ul>
                    <li>Colombo and suburbs</li>
                    <li>All districts across Sri Lanka</li>
                    <li>Rural and remote locations served by the island wide postal network</li>
                </ul>
                <p>No location within Sri Lanka is excluded unless restricted by SL Post regulations or circumstances beyond our control. We do not currently offer international shipping through <?php echo SITE_NAME; ?>.</p>

                <h2>4. Order Processing Time</h2>
                <p>All orders are typically processed within <strong>24–48 hours</strong> after order confirmation and payment verification (where applicable).</p>
                <ul>
                    <li>Orders placed on weekends or public holidays are processed on the next working day.</li>
                    <li>During peak seasons or high-volume periods, processing may take slightly longer — we will notify you if there is a significant delay.</li>
                </ul>
                <p>Processing includes order verification, hygienic food-grade packaging, leak-proof sealing of oils, grains, and groceries, and handover to Sri Lanka Post.</p>

                <h2>5. Delivery Time Frame</h2>
                <p>Delivery time depends on SL Post service standards, your location, and operational conditions.</p>
                <p><strong>Estimated delivery times after dispatch:</strong></p>
                <ul>
                    <li><strong>Colombo &amp; Western Province:</strong> 1–3 business days</li>
                    <li><strong>Other main cities:</strong> 2–5 business days</li>
                    <li><strong>Remote / rural areas:</strong> 3–7 business days</li>
                </ul>
                <p><strong>Please note:</strong> Delivery times are estimates only and may vary due to weather conditions, postal delays, public holidays, strikes, high seasonal order volume, or events outside our control.</p>

                <h2>6. Cash on Delivery (SL Post COD)</h2>
                <p>We offer <strong>Cash on Delivery (COD)</strong> through Sri Lanka Post where available.</p>
                <ul>
                    <li>Customer pays the order amount when receiving the parcel</li>
                    <li>A valid phone number and complete delivery address are required</li>
                    <li>Customer or an authorised recipient must be available at the delivery location</li>
                </ul>

                <h2>7. Delivery Charges</h2>
                <p>Delivery charges are calculated based on product weight, package size, and SL Post rates. Charges are clearly displayed at checkout before order confirmation.</p>

                <h2>8. Order Tracking</h2>
                <p>Once your order is dispatched, you will receive an SL Post tracking number and status update by email or SMS. You can also track your order on our <a href="<?php echo BASE_URL; ?>track-order.php">Track Order</a> page.</p>

                <h2>9. Packaging of Natural Foods &amp; Grocery Products</h2>
                <p>All orders are packed with care in food-grade, leak-proof, and moisture-resistant packaging to preserve maximum freshness and protect during transit. All liquid oils and ghee are packed in heavy-duty leak-proof bottles.</p>

                <h2>10. Customer Support</h2>
                <p>For delivery-related inquiries, tracking assistance, or delivery issues, please contact:</p>
                <ul>
                    <li><strong>Company:</strong> <?php echo STORE_OWNER; ?></li>
                    <li><strong>Phone:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>Email:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>WhatsApp:</strong> <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener"><?php echo STORE_WHATSAPP; ?></a></li>
                    <li><strong>Track order:</strong> <a href="<?php echo BASE_URL; ?>track-order.php">Track Order</a></li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

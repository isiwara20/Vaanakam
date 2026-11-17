<?php
require_once __DIR__ . '/../config/app.php';
$isTamil = (get_current_language() === 'ta');
$pageTitle = ($isTamil ? 'தனியுரிமைக் கொள்கை' : __t('privacy_policy')) . " - " . SITE_NAME;
require_once __DIR__ . '/partials/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="page-content">
            <?php if ($isTamil): ?>
            <h1 class="page-title">தனியுரிமைக் கொள்கை</h1>
            <p class="page-updated">நடைமுறைக்கு வரும் திகதி: 01 ஜனவரி 2026 &bull; கடைசியாக புதுப்பிக்கப்பட்டது: ஜூலை 2026</p>

            <div class="page-body">
                <p><a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a> வலைத்தளத்திற்கு உங்களை வரவேற்கிறோம். இது <strong><?php echo STORE_OWNER; ?></strong> ("நிறுவனம்", "நாங்கள்" அல்லது "எமது") மூலம் நிர்வகிக்கப்படுகிறது.</p>
                <p><?php echo SITE_NAME; ?> இணையவழிக் கடை மற்றும் வாடிக்கையாளர் சேவைகளைப் பயன்படுத்தும்போது உங்கள் தனிப்பட்ட தகவல்களை நாங்கள் எவ்வாறு சேகரிக்கிறோம், பயன்படுத்துகிறோம், வெளிப்படுத்துகிறோம் மற்றும் பாதுகாக்கிறோம் என்பதை இந்தத் தனியுரிமைக் கொள்கை விளக்குகிறது.</p>
                <p><?php echo SITE_NAME; ?> தளத்தைப் பயன்படுத்துவதன் மூலமோ, கணக்கை உருவாக்குவதன் மூலமோ அல்லது ஒரு ஆர்டரைப் பதிவு செய்வதன் மூலமோ, இந்தத் தனியுரிமைக் கொள்கை மற்றும் எமது <a href="<?php echo BASE_URL; ?>terms.php">விதிமுறைகளையும் நிபந்தனைகளையும்</a> நீங்கள் முழுமையாக ஏற்றுக்கொள்கிறீர்கள்.</p>

                <h2>1. நிறுவன தகவல்</h2>
                <ul>
                    <li><strong>சட்டப்பூர்வ வணிகப் பெயர்:</strong> <?php echo STORE_OWNER; ?></li>
                    <li><strong>வணிகப் பதிவு இலக்கம் (BR):</strong> <?php echo STORE_BUSINESS_REG; ?></li>
                    <li><strong>வர்த்தகப் பெயர்:</strong> <?php echo SITE_NAME; ?></li>
                    <li><strong>முகவரி:</strong> <?php echo STORE_LOCATION; ?></li>
                    <li><strong>தொலைபேசி எண்கள்:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>மின்னஞ்சல்:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>வலைத்தளம்:</strong> <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a></li>
                </ul>

                <h2>2. இந்தக் கொள்கையின் நோக்கம்</h2>
                <p>இந்தத் தனியுரிமைக் கொள்கை பின்வரும் வழிகளில் பெறப்படும் தனிப்பட்ட தகவல்களுக்குப் பொருந்தும்:</p>
                <ul>
                    <li><?php echo SITE_NAME; ?> வலைத்தளம் மற்றும் இணையவழி மளிகைக் கடை</li>
                    <li>வாடிக்கையாளர் கணக்குப் பதிவு மற்றும் பயனர் விபரக் குறிப்பு (Profile) மேலாண்மை</li>
                    <li>இலங்கைக்குள்ளான மளிகைப் பொருட்கள் ஆர்டர் மற்றும் விநியோகம்</li>
                    <li>வாடிக்கையாளர் சேவைத் தொடர்புகள் (மின்னஞ்சல், தொலைபேசி, WhatsApp மற்றும் நேரலை அரட்டை)</li>
                    <li>தயாரிப்பு மதிப்புரைகள், விருப்பப்பட்டியல் (Wishlist) மற்றும் செய்திமடல் சந்தாக்கள்</li>
                </ul>

                <h2>3. நாங்கள் சேகரிக்கும் தகவல்கள்</h2>
                <p>எமது சேவைகளை சீராக வழங்க பின்வரும் தகவல்களை நாங்கள் சேகரிக்கலாம்:</p>

                <h3>3.1 தனிப்பட்ட தகவல்கள்</h3>
                <ul>
                    <li>முழுப் பெயர்</li>
                    <li>மின்னஞ்சல் முகவரி</li>
                    <li>மொபைல் / தொலைபேசி இலக்கம்</li>
                    <li>பில் முகவரி மற்றும் விநியோக முகவரி (மாவட்டத்துடன்)</li>
                    <li>விநியோகக் குறிப்புகள் அல்லது அடையாளக் குறிகள்</li>
                </ul>

                <h3>3.2 கணக்கு விபரங்கள்</h3>
                <p><?php echo SITE_NAME; ?> இல் கொள்வனவு செய்ய பதிவு செய்யப்பட்ட கணக்கு அவசியமாகும். கணக்குத் தொடர்பான தரவுகளில் அடங்குபவை:</p>
                <ul>
                    <li>பயனர்பெயர் மற்றும் பதிவு செய்யப்பட்ட மின்னஞ்சல்</li>
                    <li>கடவுச்சொல் (பாதுகாப்பான குறியாக்கப்பட்ட / Hashed வடிவில் மட்டுமே சேமிக்கப்படும்; நேரடி கடவுச்சொல் ஒருபோதும் சேமிக்கப்படாது)</li>
                    <li>சேமிக்கப்பட்ட விநியோக முகவரிகள் மற்றும் விருப்பத்தேர்வுகள்</li>
                    <li>விருப்பப்பட்டியல் (Wishlist) மற்றும் முந்தைய ஆர்டர் வரலாறு</li>
                </ul>

                <h3>3.3 கட்டண விபரங்கள்</h3>
                <ul>
                    <li>தெரிவு செய்யப்பட்ட கட்டண முறை (பொருட்களைப் பெற்று பணமாக செலுத்துதல் - COD, நேரடி வங்கிப் பரிமாற்றம், அல்லது ஆன்லைன் அட்டை கட்டணம்)</li>
                    <li>பரிவர்த்தனை குறிப்பு எண்கள் மற்றும் கட்டண நிலை</li>
                </ul>
                <p><strong>முக்கிய குறிப்பு:</strong> உங்கள் கடனட்டை / பற்று அட்டை (Debit/Credit Card) முழு எண்கள் அல்லது CVV விபரங்கள் எங்கள் சர்வர்களில் சேமிக்கப்படுவதில்லை. அவை உரிமம் பெற்ற கட்டண வாயில் (Payment Gateway) கூட்டாளர்களால் உயர் பாதுகாப்புடன் செயலாக்கப்படுகின்றன.</p>

                <h3>3.4 தொடர்பு மற்றும் உதவி வரலாறு</h3>
                <ul>
                    <li>WhatsApp, தொலைபேசி அல்லது தொடர்புப் படிவம் மூலம் நீங்கள் அனுப்பும் செய்திகள்</li>
                    <li>வாடிக்கையாளர் சேவை விசாரணைகள் மற்றும் வழங்கப்பட்ட தீர்வுகள்</li>
                    <li>நீங்கள் பதிவு செய்யும் தயாரிப்பு மதிப்புரைகள் (Reviews) மற்றும் மதிப்பீடுகள் (Ratings)</li>
                </ul>

                <h2>4. தானாகச் சேகரிக்கப்படும் தொழில்நுட்ப தகவல்கள்</h2>
                <p>நீங்கள் வலைத்தளத்தைப் பார்வையிடும்போது பின்வரும் தொழில்நுட்பத் தகவல்கள் தானாகப் பதிவு செய்யப்படலாம்:</p>
                <ul>
                    <li>IP முகவரி மற்றும் தோராயமான புவியியல் இருப்பிடம் (நாடு/பிராந்தியம்)</li>
                    <li>உலாவி வகை (Browser type) மற்றும் பதிப்பு</li>
                    <li>பயன்படுத்தப்படும் சாதனம் (மொபைல், டெஸ்க்டாப் அல்லது டேப்லெட்)</li>
                    <li>வலைத்தளத்தில் பார்வையிடப்பட்ட பக்கங்கள், தேடப்பட்ட பொருட்கள் மற்றும் செலவழித்த நேரம்</li>
                    <li>பிழைப் பதிவுகள் (Error logs) மற்றும் தளத்தின் செயல்திறன் தரவுகள்</li>
                </ul>

                <h2>5. குக்கீகள் (Cookies)</h2>
                <p>தளத்தின் சிறப்பான பயன்பாட்டிற்காக நாங்கள் குக்கீகளைப் பயன்படுத்துகிறோம்:</p>
                <ul>
                    <li>உங்களை உங்கள் கணக்கில் தொடர்ச்சியாக உள்நுழைந்திருக்கச் செய்ய</li>
                    <li>ஷாப்பிங் வண்டியில் (Cart) நீங்கள் சேர்த்த பொருட்களை நினைவில் வைத்திருக்க</li>
                    <li>நீங்கள் விரும்பும் மொழி (தமிழ் / ஆங்கிலம்) மற்றும் தளத்தின் அமைப்புகளைச் சேமிக்க</li>
                    <li>தளத்தின் பாதுகாப்பு மற்றும் வேகத்தை உறுதிப்படுத்த</li>
                </ul>
                <p>உங்கள் உலாவி அமைப்புகள் மூலம் குக்கீகளை முடக்கலாம். ஆனால், குக்கீகளை முடக்கினால் வண்டியில் பொருட்களைச் சேர்ப்பது அல்லது கணக்கில் உள்நுழைவது போன்ற வசதிகள் தடைபடலாம்.</p>

                <h2>6. உங்கள் தகவல்களை எவ்வாறு பயன்படுத்துகிறோம்?</h2>
                <p>சேகரிக்கப்பட்ட தகவல்கள் பின்வரும் நோக்கங்களுக்காக மட்டுமே பயன்படுத்தப்படுகின்றன:</p>
                <ul>
                    <li>வாடிக்கையாளர் கணக்கை உருவாக்கி நிர்வகிக்க</li>
                    <li>ஆர்டர்களை உறுதிப்படுத்தி, பேக் செய்து, இலங்கை முழுவதும் பாதுகாப்பாக விநியோகிக்க (SL Post COD &amp; Courier)</li>
                    <li>கட்டணங்களைச் சரிபார்க்கவும் நிதி மோசடிகளைத் தடுக்கவும்</li>
                    <li>ஆர்டர் உறுதிப்படுத்தல், கண்காணிப்பு இலக்கம் (Tracking Number) மற்றும் விநியோக நிலைகளை அனுப்ப</li>
                    <li>தொலைபேசி, மின்னஞ்சல் மற்றும் WhatsApp மூலம் வாடிக்கையாளர் ஆதரவு வழங்க</li>
                    <li>உங்களின் விருப்பத்திற்கு ஏற்ப விசேட தள்ளுபடிகள் மற்றும் புதிய தயாரிப்புகள் பற்றிய தகவல்களை அனுப்ப</li>
                    <li>வலைத்தளத்தின் தரம், தயாரிப்புகளின் தரம் மற்றும் வாடிக்கையாளர் அனுபவத்தை மேம்படுத்த</li>
                    <li>இலங்கை வரி மற்றும் சட்ட விதிகளுக்கு இணங்க செயலாற்ற</li>
                </ul>

                <h2>7. மின்னஞ்சல் மற்றும் WhatsApp தொடர்பாடல்கள்</h2>
                <p>ஆர்டர் தொடர்பான பின்வரும் முக்கிய தகவல்களைப் பெற உங்கள் மின்னஞ்சல் மற்றும் தொலைபேசி எண் பயன்படுத்தப்படும்:</p>
                <ul>
                    <li>ஆர்டர் உறுதிப்படுத்தல் ரசீது மற்றும் விநியோக நிலைத் தகவல்கள்</li>
                    <li>விநியோகக் கூரியர் கண்காணிப்பு இலக்கங்கள்</li>
                    <li>கடவுச்சொல் மீட்டமைப்பு மற்றும் கணக்குப் பாதுகாப்பு அறிவிப்புகள்</li>
                    <li>வாடிக்கையாளர் சேவை விசாரணைகளுக்கான பதில்கள்</li>
                </ul>
                <p>விளம்பர செய்திமடல்களில் இருந்து எப்போது வேண்டுமானாலும் நீங்கள் விலகிக்கொள்ளலாம் (Unsubscribe).</p>

                <h2>8. தகவல்களைப் பகிர்தல் (Information Sharing)</h2>
                <p><strong>நாங்கள் உங்கள் தனிப்பட்ட தகவல்களை ஒருபோதும் மூன்றாம் தரப்பினருக்கு விற்பனை செய்வதோ வாடகைக்கு விடுவதோ இல்லை.</strong></p>
                <p>எமது சேவைகளை உங்களுக்கு வழங்குவதற்காக மட்டுமே நம்பகமான கூட்டாளர்களுடன் அவசியமான விபரங்கள் பகிரப்படுகின்றன:</p>
                <ul>
                    <li><strong>விநியோகக் கூட்டாளர்கள்:</strong> இலங்கை தபால் திணைக்களம் (SL Post) மற்றும் முன்னணி கூரியர் நிறுவனங்கள் (பொருட்களை உங்கள் முகவரிக்கு கொண்டு சேர்க்க பெயர், முகவரி, தொலைபேசி எண் மட்டுமே பகிரப்படும்)</li>
                    <li><strong>பாதுகாப்பான கட்டண வாயில்கள்:</strong> ஆன்லைன் கார்டு கட்டணங்களை பாதுகாப்பாக செயல்படுத்தும் உரிமம் பெற்ற வங்கிகள்</li>
                    <li><strong>தொழில்நுட்ப மற்றும் சர்வர் பராமரிப்பு நிறுவனங்கள்:</strong> வலைத்தளப் பாதுகாப்பு மற்றும் தரவுத்தளப் பராமரிப்புக்காக</li>
                    <li><strong>சட்ட அமலாக்கத் துறையினர்:</strong> இலங்கை நீதிமன்ற உத்தரவு அல்லது சட்ட ரீதியான கடப்பாடுகளுக்கு உட்பட்டு அவசியப்படும் போது மட்டும்</li>
                </ul>

                <h2>9. தரவுப் பாதுகாப்பு (Data Security)</h2>
                <p>உங்கள் தனிப்பட்ட விபரங்களின் பாதுகாப்பிற்கு நாங்கள் அதியுயர் முன்னுரிமை அளிக்கிறோம்:</p>
                <ul>
                    <li>வலைத்தளத்திற்கும் உங்கள் உலாவிக்கும் இடையிலான அனைத்துத் தரவுகளும் <strong>SSL/TLS என்க்ரிப்ஷன்</strong> மூலம் பாதுகாக்கப்படுகின்றன.</li>
                    <li>அனைத்து பயனர் கடவுச்சொற்களும் அதிநவீன முறைப்படி குறியாக்கம் (Hashed) செய்யப்பட்டு சேமிக்கப்படுகின்றன.</li>
                    <li>அங்கீகரிக்கப்படாத அணுகலைத் தடுக்க ஃபயர்வால்கள் மற்றும் பாதுகாப்பு அமைப்புகள் நிறுவப்பட்டுள்ளன.</li>
                    <li>அங்கீகரிக்கப்பட்ட பணியாளர்கள் மட்டுமே உங்கள் ஆர்டர் தகவல்களை அணுக முடியும்.</li>
                </ul>

                <h2>10. தரவு தக்கவைப்பு (Data Retention)</h2>
                <p>உங்கள் கணக்கு பயன்பாட்டில் இருக்கும் வரை அல்லது வரி மற்றும் சட்ட ரீதியான ஆவணத் தேவைகளுக்கு அவசியமான காலம் வரை உங்கள் ஆர்டர் வரலாறு மற்றும் கணக்குத் தகவல்கள் பாதுகாப்பாகப் பேணப்படும். அதன் பின்னர் அவை பாதுகாப்பாக அழிக்கப்படும்.</p>

                <h2>11. உங்கள் உரிமைகள்</h2>
                <p>இலங்கைச் சட்ட விதிகளுக்கு உட்பட்டு, பின்வரும் உரிமைகள் உங்களுக்கு உண்டு:</p>
                <ul>
                    <li><strong>அணுகல்:</strong> உங்களிடம் உள்ள உங்கள் தனிப்பட்ட தரவுகளின் நகலைக் கோருதல்</li>
                    <li><strong>திருத்தம்:</strong> பிழையான அல்லது முழுமையற்ற தகவல்களைத் திருத்துதல்</li>
                    <li><strong>நீக்குதல்:</strong> உங்கள் கணக்கையோ அல்லது சேமிக்கப்பட்ட விபரங்களையோ நீக்குமாறு கோருதல்</li>
                    <li><strong>சந்தைப்படுத்தல் விலகல்:</strong> விளம்பர மின்னஞ்சல்கள் மற்றும் செய்திகளைப் பெறுவதை நிறுத்துதல்</li>
                </ul>
                <p>இந்த உரிமைகளைப் பயன்படுத்த <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a> என்ற மின்னஞ்சல் முகவரிக்கு எங்களைத் தொடர்பு கொள்ளவும்.</p>

                <h2>12. சிறுவர் தனியுரிமை</h2>
                <p><?php echo SITE_NAME; ?> 18 வயதிற்குட்பட்டவர்களுக்கான தளம் அல்ல. பெற்றோர் அல்லது பாதுகாவலரின் ஒப்புதல் மற்றும் மேற்பார்வையின்றி சிறார்களின் தகவல்களை நாங்கள் வேண்டுமென்றே சேகரிப்பதில்லை.</p>

                <h2>13. மூன்றாம் தரப்பு இணைப்புகள்</h2>
                <p>எங்கள் தளத்தில் மூன்றாம் தரப்பு வலைத்தளங்கள் அல்லது சமூக ஊடகங்களின் இணைப்புகள் இருக்கலாம். அந்த வலைத்தளங்களின் தனியுரிமை நடைமுறைகளுக்கு நாங்கள் பொறுப்பல்ல. அவற்றின் கொள்கைகளைத் தனியாக வாசிக்குமாறு கேட்டுக்கொள்கிறோம்.</p>

                <h2>14. கொள்கை மாற்றங்கள்</h2>
                <p>இந்தத் தனியுரிமைக் கொள்கையை காலத்திற்கு ஏற்றவாறு புதுப்பிக்கும் உரிமை எங்களுக்கு உண்டு. திருத்தங்கள் இந்த பக்கத்தில் வெளியிடப்பட்ட உடனேயே நடைமுறைக்கு வரும். மாற்றங்கள் ஏதேனும் இருப்பின் இந்த பக்கத்தைப் பார்வையிடுமாறு கேட்டுக்கொள்கிறோம்.</p>

                <h2>15. எங்களைத் தொடர்பு கொள்ள</h2>
                <p>தனியுரிமைக் கொள்கை அல்லது உங்கள் தரவுகளின் பாதுகாப்பு தொடர்பாக ஏதேனும் வினாக்கள் இருப்பின், எங்களை நேரடியாகத் தொடர்பு கொள்ளலாம்:</p>
                <ul>
                    <li><strong>நிறுவனம்:</strong> <?php echo STORE_OWNER; ?></li>
                    <li><strong>வணிகப் பதிவு இலக்கம்:</strong> <?php echo STORE_BUSINESS_REG; ?></li>
                    <li><strong>முகவரி:</strong> <?php echo STORE_LOCATION; ?></li>
                    <li><strong>தொலைபேசி:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>மின்னஞ்சல்:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>வலைத்தளம்:</strong> <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a></li>
                    <li><strong>WhatsApp உதவி:</strong> <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener"><?php echo STORE_PHONE_1; ?></a></li>
                    <li><strong>தொடர்புப் படிவம்:</strong> <a href="<?php echo BASE_URL; ?>contact.php">எங்களைத் தொடர்பு கொள்ளுங்கள்</a></li>
                </ul>
            </div>
            <?php else: ?>
            <h1 class="page-title">Privacy Policy</h1>
            <p class="page-updated">Effective Date: 01 January 2026 &bull; Last updated: July 2026</p>

            <div class="page-body">
                <p>Welcome to <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a>, operated by <?php echo STORE_OWNER; ?> ("Company", "we", "our", or "us").</p>
                <p>This Privacy Policy explains how we collect, use, disclose, store, and protect your personal information when you access our website, online grocery store, customer account portal, and related services at <?php echo SITE_NAME; ?>.</p>
                <p>By using <?php echo SITE_NAME; ?>, creating an account, or placing an order, you agree to the practices described in this Privacy Policy and our <a href="<?php echo BASE_URL; ?>terms.php">Terms &amp; Conditions</a>.</p>

                <h2>1. Company Information</h2>
                <ul>
                    <li><strong>Legal Name:</strong> <?php echo STORE_OWNER; ?></li>
                    <li><strong>Business Registration Number:</strong> <?php echo STORE_BUSINESS_REG; ?></li>
                    <li><strong>Trading Name:</strong> <?php echo SITE_NAME; ?></li>
                    <li><strong>Address:</strong> <?php echo STORE_LOCATION; ?></li>
                    <li><strong>Phone:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>Email:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>Website:</strong> <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a></li>
                </ul>

                <h2>2. Scope of This Policy</h2>
                <p>This policy applies to personal information collected through:</p>
                <ul>
                    <li>The <?php echo SITE_NAME; ?> website and online store</li>
                    <li>Customer account registration, login, and profile management</li>
                    <li>Order placement, payment, and delivery within Sri Lanka</li>
                    <li>Customer support channels (email, phone, WhatsApp, and website contact form)</li>
                    <li>Product reviews, wishlists, and newsletter subscriptions</li>
                </ul>

                <h2>3. Information We Collect</h2>
                <p>We collect information necessary to provide you with seamless service:</p>

                <h3>3.1 Personal Information</h3>
                <ul>
                    <li>Full name</li>
                    <li>Email address</li>
                    <li>Mobile / telephone number</li>
                    <li>Billing and delivery address (including district)</li>
                    <li>Delivery instructions and landmarks</li>
                </ul>

                <h3>3.2 Account Information</h3>
                <p>A registered customer account is required to place orders at <?php echo SITE_NAME; ?>. Account data includes:</p>
                <ul>
                    <li>Username and registered email address</li>
                    <li>Password (stored in encrypted / hashed format; never stored in plain text)</li>
                    <li>Saved delivery addresses and preferences</li>
                    <li>Wishlist items and complete order history</li>
                </ul>

                <h3>3.3 Payment Information</h3>
                <ul>
                    <li>Payment method chosen (Cash on Delivery, Direct Bank Transfer, LANKAQR, or Online Card Payment)</li>
                    <li>Transaction reference codes and payment status</li>
                </ul>
                <p><strong>Note:</strong> We do not store complete credit card or debit card numbers on our servers. Online payments are processed through secure, bank-grade payment gateway partners.</p>

                <h3>3.4 Communications and Support</h3>
                <ul>
                    <li>Inquiries sent via contact form, email, or WhatsApp</li>
                    <li>Customer service communication history</li>
                    <li>Product ratings and reviews you submit</li>
                </ul>

                <h2>4. Information Automatically Collected</h2>
                <p>When you browse <?php echo SITE_NAME; ?>, technical information may be collected automatically, including:</p>
                <ul>
                    <li>IP address and approximate geographic location</li>
                    <li>Browser type and operating system</li>
                    <li>Device type (mobile, tablet, desktop)</li>
                    <li>Pages visited, products viewed, and browsing activity</li>
                    <li>Error logs and site performance metrics</li>
                </ul>

                <h2>5. Cookies and Tracking Technologies</h2>
                <p>We use cookies to enhance your browsing experience, including:</p>
                <ul>
                    <li>Keeping you securely logged in to your account</li>
                    <li>Remembering items in your shopping cart across sessions</li>
                    <li>Saving your preferred language and display preferences</li>
                    <li>Ensuring site security and optimal performance</li>
                </ul>
                <p>You may adjust your browser settings to decline cookies; however, certain site features (such as shopping cart persistence and login) may not function properly without them.</p>

                <h2>6. How We Use Your Information</h2>
                <p>We use your information exclusively for legitimate business purposes:</p>
                <ul>
                    <li>Processing, packing, and delivering orders across Sri Lanka via SL Post and courier partners</li>
                    <li>Managing your customer account and order history</li>
                    <li>Verifying payments and preventing fraudulent transactions</li>
                    <li>Sending order receipts, dispatch confirmations, and tracking numbers</li>
                    <li>Providing responsive customer support via phone, email, and WhatsApp</li>
                    <li>Sending optional updates regarding seasonal offers and new arrivals (with opt-out)</li>
                    <li>Complying with applicable legal and statutory requirements in Sri Lanka</li>
                </ul>

                <h2>7. Information Sharing and Disclosure</h2>
                <p><strong>We do not sell, rent, or trade your personal information to third parties.</strong></p>
                <p>We disclose information only to trusted service partners strictly necessary to fulfil orders:</p>
                <ul>
                    <li><strong>Logistics partners:</strong> Sri Lanka Post (SL Post COD) and courier services for order delivery</li>
                    <li><strong>Payment processors:</strong> Authorized payment gateways for secure online payment processing</li>
                    <li><strong>Hosting &amp; infrastructure providers:</strong> To maintain secure, high-availability website operations</li>
                    <li><strong>Law enforcement:</strong> When required by court order or applicable Sri Lankan law</li>
                </ul>

                <h2>8. Data Security</h2>
                <p>We implement robust technical and organizational safeguards to protect your personal data:</p>
                <ul>
                    <li>All data transmitted between your browser and our website is protected using <strong>SSL/TLS encryption</strong></li>
                    <li>Passwords are stored using strong irreversible hashing algorithms</li>
                    <li>Access to personal customer information is strictly restricted to authorized personnel</li>
                    <li>Regular security assessments and server monitoring to prevent unauthorized access</li>
                </ul>

                <h2>9. Data Retention</h2>
                <p>We retain your personal data for as long as your customer account remains active or as required by law for accounting, taxation, and regulatory reporting purposes.</p>

                <h2>10. Your Rights</h2>
                <p>Under applicable Sri Lankan privacy standards, you have the right to:</p>
                <ul>
                    <li>Request access to the personal data we hold about you</li>
                    <li>Request corrections to any inaccurate or incomplete details</li>
                    <li>Request the deletion or deactivation of your customer account</li>
                    <li>Opt out of promotional communications at any time</li>
                </ul>
                <p>To exercise any of these rights, please contact us at <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a>.</p>

                <h2>11. Children's Privacy</h2>
                <p><?php echo SITE_NAME; ?> is intended for users who are at least 18 years of age. We do not knowingly collect personal data from individuals under 18 without parental consent.</p>

                <h2>12. Modifications to This Policy</h2>
                <p>We reserve the right to amend or update this Privacy Policy at any time. Any changes will become effective immediately upon publication on this page.</p>

                <h2>13. Contact Us</h2>
                <p>For questions or concerns regarding this Privacy Policy or how your personal information is handled, please contact:</p>
                <ul>
                    <li><strong>Company:</strong> <?php echo STORE_OWNER; ?></li>
                    <li><strong>Business Registration:</strong> <?php echo STORE_BUSINESS_REG; ?></li>
                    <li><strong>Address:</strong> <?php echo STORE_LOCATION; ?></li>
                    <li><strong>Phone:</strong> <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a> / <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a></li>
                    <li><strong>Email:</strong> <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a></li>
                    <li><strong>Website:</strong> <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a></li>
                    <li><strong>WhatsApp:</strong> <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener"><?php echo STORE_PHONE_1; ?></a></li>
                    <li><strong>Contact Form:</strong> <a href="<?php echo BASE_URL; ?>contact.php">Contact Us</a></li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

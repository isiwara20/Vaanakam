<?php
require_once __DIR__ . '/../config/app.php';
$isTamil = (get_current_language() === 'ta');
$pageTitle = ($isTamil ? 'விதிமுறைகளும் நிபந்தனைகளும்' : __t('terms_conditions')) . " - " . SITE_NAME;
require_once __DIR__ . '/partials/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="page-content">
            <?php if ($isTamil): ?>
            <h1 class="page-title">விதிமுறைகளும் நிபந்தனைகளும்</h1>
            <p class="page-updated">நடைமுறைக்கு வரும் திகதி: 01 ஜனவரி 2026 &bull; கடைசியாக புதுப்பிக்கப்பட்டது: ஜூலை 2026</p>

            <div class="page-body">
                <p><a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a> வலைத்தளத்திற்கு உங்களை அன்புடன் வரவேற்கிறோம். இது <strong><?php echo STORE_OWNER; ?></strong> (வணிகப் பதிவு இலக்கம்: <?php echo STORE_BUSINESS_REG; ?>) மூலம் நிர்வகிக்கப்படுகிறது.</p>
                <p>இந்த வலைத்தளத்தைப் பயன்படுத்துவதன் மூலமோ அணுகுவதன் மூலமோ, நீங்கள் இந்த விதிமுறைகளையும் நிபந்தனைகளையும் முழுமையாக ஏற்றுக்கொண்டு இணங்க ஒப்புக்கொள்கிறீர்கள். இந்த விதிமுறைகளின் எந்தவொரு பகுதியுடனும் நீங்கள் உடன்படவில்லை என்றால், எமது வலைத்தளத்தையோ அல்லது சேவைகளையோ பயன்படுத்த வேண்டாம் என கேட்டுக்கொள்கிறோம்.</p>

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

                <h2>2. விதிமுறைகளை ஏற்றுக்கொள்ளுதல்</h2>
                <p><?php echo SITE_NAME; ?> மற்றும் அதன் சேவைகளைப் பயன்படுத்துவதன் மூலம், நீங்கள் இந்த விதிமுறைகள், எமது <a href="<?php echo BASE_URL; ?>privacy.php">தனியுரிமைக் கொள்கை</a>, <a href="<?php echo BASE_URL; ?>refund-policy.php">மீளளிப்புக் கொள்கை</a>, <a href="<?php echo BASE_URL; ?>shipping-policy.php">விநியோகக் கொள்கை</a> மற்றும் வலைத்தளத்தில் வெளியிடப்பட்டுள்ள ஏனைய கொள்கைகளையும் வாசித்து, புரிந்து ஏற்றுக்கொண்டுள்ளீர்கள் என உறுதிப்படுத்துகிறீர்கள்.</p>
                <p>இந்த விதிமுறைகளில் மாற்றங்கள் செய்யப்பட்ட பின்னரும் வலைத்தளத்தைத் தொடர்ந்து பயன்படுத்துவது, திருத்தப்பட்ட புதிய விதிமுறைகளை நீங்கள் ஏற்றுக்கொண்டதாகக் கருதப்படும்.</p>

                <h2>3. தகுதி வரம்பு</h2>
                <ul>
                    <li>இந்த வலைத்தளத்தைப் பயன்படுத்தவும் ஆர்டர்களை பதிவு செய்யவும் நீங்கள் குறைந்தது <strong>18 வயது</strong> நிரம்பியவராக இருக்க வேண்டும் அல்லது பெற்றோர் / சட்டப்பூர்வ பாதுகாவலரின் மேற்பார்வையில் இருக்க வேண்டும்.</li>
                    <li>ஒரு ஆர்டரை வைப்பதன் மூலம், நீங்கள் இலங்கைச் சட்டத்தின் கீழ் சட்டப்பூர்வமாக செல்லுபடியாகும் ஒப்பந்தத்தில் ஈடுபட தகுதியுடையவர் என்பதை உறுதிப்படுத்துகிறீர்கள்.</li>
                    <li>தகுதி வரம்புகளைப் பூர்த்தி செய்யாத எவருக்கும் சேவை வழங்க மறுக்கும் உரிமை எங்களுக்கு உண்டு.</li>
                </ul>

                <h2>4. வாடிக்கையாளர் கணக்கு</h2>
                <p><?php echo SITE_NAME; ?> தளத்தில் பொருட்களை வண்டியில் (Cart) சேர்க்கவும், கொள்வனவை பூர்த்தி செய்யவும் (Checkout) நீங்கள் <strong>ஒரு வாடிக்கையாளர் கணக்கைப் பதிவு செய்து வைத்திருக்க வேண்டும்</strong>. விருந்தினர் கொள்முதல் (Guest checkout) வசதி வழங்கப்படவில்லை.</p>
                <p>பயனர்கள் பின்வரும் முறைகள் மூலம் கணக்கை உருவாக்கலாம்:</p>
                <ul>
                    <li>மின்னஞ்சல் பதிவு (Email Registration)</li>
                    <li>Google மூலம் உட்செல்லுதல் (Google Login)</li>
                    <li>Facebook மூலம் உட்செல்லுதல் (Facebook Login)</li>
                </ul>
                <p>உங்கள் கணக்கின் பாதுகாப்பு தொடர்பான பின்வரும் விடயங்களுக்கு நீங்களே பொறுப்பாவீர்கள்:</p>
                <ul>
                    <li>உங்கள் கணக்கு கடவுச்சொல் மற்றும் விவரங்களை இரகசியமாகவும் பாதுகாப்பாகவும் வைத்திருத்தல்</li>
                    <li>உங்கள் கணக்கின் கீழ் நடைபெறும் அனைத்து செயற்பாடுகள் மற்றும் பரிவர்த்தனைகள்</li>
                    <li>துல்லியமான, தற்போதைய மற்றும் முழுமையான தகவல்களை வழங்குதல்</li>
                </ul>
                <p>மோசடியான, சந்தேகத்திற்கிடமான அல்லது இந்த விதிமுறைகளை மீறும் எந்தவொரு கணக்கையும் இடைநிறுத்தவோ அல்லது ரத்து செய்யவோ எங்களுக்கு முழு உரிமை உண்டு.</p>

                <h2>5. தயாரிப்புகளும் சேவைகளும்</h2>
                <p><?php echo SITE_NAME; ?> என்பது <strong>100% தூய இயற்கை மளிகைப் பொருட்கள், மரச்செக்கு எண்ணெய்கள், நட்ஸ் வகைகள், பாரம்பரிய அரிசி &amp; தானியங்கள், இயற்கை மசாலாப் பொருட்கள்</strong> ஆகியவற்றை வழங்கும் ஒரு இணையவழி வணிகத் தளமாகும். எங்கள் பட்டியலில் அடங்குபவை:</p>
                <ul>
                    <li>மரச்செக்கு தேங்காய் எண்ணெய், நல்லெண்ணெய் மற்றும் மூலிகை எண்ணெய்கள்</li>
                    <li>முல்லைத்தீவு முந்திரி பருப்புகள் (Cashews) மற்றும் உலர் பழங்கள்</li>
                    <li>பாரம்பரிய அரிசி ரகங்கள், சிறுதானியங்கள் மற்றும் பருப்பு வகைகள்</li>
                    <li>இயற்கை முறையில் தயாரிக்கப்பட்ட தூய மசாலாப் பொடிகள் மற்றும் நாட்டுச் சர்க்கரை / பனை உற்பத்திப் பொருட்கள்</li>
                </ul>
                <p>உயர்தரமான, இரசாயனங்கள் கலக்கப்படாத தூய இயற்கை உணவுகளை வழங்குவதில் நாங்கள் உறுதியாக உள்ளோம். தயாரிப்புகளின் கையிருப்பு மற்றும் பட்டியல் முன்னறிவிப்பின்றி மாறக்கூடும். புகைப்படங்கள் மற்றும் விளக்கங்கள் விழிப்புணர்வுக்கானவை; இயற்கையான தயாரிப்புகள் என்பதால் பேக்கேஜிங் மற்றும் நிறத்தில் சிறிய மாற்றங்கள் இருக்கலாம்.</p>

                <h2>6. தயாரிப்பு தகவலும் நம்பகத்தன்மையும்</h2>
                <ul>
                    <li>தயாரிப்புப் படங்கள், மூலப்பொருட்கள், விபரங்கள் மற்றும் விலைகளை துல்லியமாகக் காண்பிக்க நாங்கள் முழு முயற்சி எடுக்கிறோம். திரையின் அமைப்புகள் மற்றும் வெளிச்சம் காரணமாக நிறங்கள் சிறிதளவு மாறுபடலாம்.</li>
                    <li>எங்கள் தயாரிப்புகள் அனைத்தும் தரப் பரிசோதனைக்கு உட்படுத்தப்பட்டு விநியோகிக்கப்படும் தூய இயற்கை உணவுகளாகும்.</li>
                    <li>தயாரிப்புகளின் விநியோகம் கையிருப்பைப் பொறுத்தது. ஒரு வாடிக்கையாளருக்கு அல்லது ஒரு ஆர்டருக்கான அளவைக் கட்டுப்படுத்தும் உரிமை எங்களுக்கு உண்டு.</li>
                    <li>நீங்கள் ஆர்டர் செய்த பின்னர் ஏதேனும் ஒரு பொருள் கையிருப்பில் இல்லை எனில், நாங்கள் உங்களுக்கு அறிவித்து அந்த பொருளை அல்லது முழு ஆர்டரையும் ரத்து செய்து, செலுத்தப்பட்ட தொகையை முழுமையாக மீளளிப்போம்.</li>
                </ul>

                <h2>7. விலை விபரங்கள்</h2>
                <ul>
                    <li>வலைத்தளத்தில் உள்ள அனைத்து விலைகளும் <strong>இலங்கை ரூபாயில் (LKR)</strong> குறிப்பிடப்பட்டுள்ளன.</li>
                    <li>தொழில்நுட்ப பிழை காரணமாக ஏதேனும் தவறான விலை பதிவாகியிருந்தால், அந்த விலையைத் திருத்தவும், தவறான விலையில் பெறப்பட்ட ஆர்டர்களை ரத்து செய்யவும் எங்களுக்கு உரிமை உண்டு.</li>
                    <li>விசேட தள்ளுபடி விலைகள் குறிப்பிட்ட காலப்பகுதிக்கு மட்டுமே செல்லுபடியாகும்.</li>
                </ul>

                <h2>8. ஆர்டர்கள் மற்றும் உறுதிப்படுத்தல்</h2>
                <p><?php echo SITE_NAME; ?> மூலம் ஆர்டர் இடுவதன் மூலம், நீங்கள் பின்வருவனவற்றை உறுதிப்படுத்துகிறீர்கள்:</p>
                <ul>
                    <li>நீங்கள் வழங்கிய பெயர், முகவரி, தொலைபேசி எண் மற்றும் மின்னஞ்சல் தகவல்கள் துல்லியமானவை.</li>
                    <li>நீங்கள் தெரிவுசெய்த கட்டண முறையைப் பயன்படுத்துவதற்கான முழு உரிமை உங்களுக்கு உண்டு.</li>
                    <li>ஆர்டரை அனுப்புவதற்கு முன்னர் உங்கள் தகவல்களை தொலைபேசி அல்லது மின்னஞ்சல் மூலம் உறுதிப்படுத்தும் உரிமை எங்களுக்கு உண்டு.</li>
                </ul>
                <p>ஆர்டர் நிலைகள் பின்வருவனவற்றை உள்ளடக்கும்:</p>
                <ul>
                    <li>நிலுவையில் (Pending)</li>
                    <li>செயலாக்கத்தில் (Processing)</li>
                    <li>பொதி செய்யப்பட்டது (Packed)</li>
                    <li>அனுப்பப்பட்டது (Shipped)</li>
                    <li>விநியோகிக்கப்பட்டது (Delivered)</li>
                    <li>ரத்து செய்யப்பட்டது (Cancelled)</li>
                </ul>
                <p>எங்களிடமிருந்து மின்னஞ்சல் அல்லது தொலைபேசி உறுதிப்படுத்தல் அழைப்பு கிடைத்த பின்னரே உங்கள் ஆர்டர் முழுமையாக ஏற்றுக்கொள்ளப்பட்டதாகக் கருதப்படும்.</p>

                <h2>9. கட்டண முறைகள்</h2>
                <p>பொருட்களைப் பெற்றுக்கொள்ளும்போது அல்லது முன்கூட்டியே செலுத்த பின்வரும் கட்டண முறைகள் வழங்கப்படுகின்றன:</p>
                <ul>
                    <li>பொருட்களைப் பெற்று பணமாக செலுத்துதல் (Cash on Delivery - COD)</li>
                    <li>நேரடி வங்கிப் பணப்பரிமாற்றம் (Bank Transfer)</li>
                    <li>QR குறியீடு கட்டணங்கள் (LANKAQR)</li>
                    <li>பாதுகாப்பான ஆன்லைன் கார்டு கட்டணங்கள் (Visa, Mastercard, Debit / Credit Cards)</li>
                </ul>
                <p>அனைத்து ஆன்லைன் கட்டணங்களும் அதிபாதுகாப்பான SSL என்க்ரிப்ஷன் மூலம் செயல்படுத்தப்படுகின்றன. உங்கள் கார்டு விபரங்கள் எதுவும் எங்கள் சர்வரில் சேமிக்கப்படுவதில்லை.</p>

                <h2>10. விநியோகமும் விநியோக காலமும்</h2>
                <p><?php echo SITE_NAME; ?> <strong>இலங்கை முழுவதும் (Island Wide Delivery)</strong> இலங்கை தபால் திணைக்களம் (SL Post COD) மற்றும் முன்னணி கூரியர் நிறுவனங்கள் ஊடாக பாதுகாப்பான விநியோக சேவையை வழங்குகிறது.</p>
                <p>விநியோக காலம் பின்வரும் காரணிகளால் மாறுபடலாம்:</p>
                <ul>
                    <li>இலங்கையில் நீங்கள் இருக்கும் இடம் / மாவட்டம்</li>
                    <li>ஆர்டர்களைத் தயாரித்து பேக்கிங் செய்ய எடுக்கும் நேரம்</li>
                    <li>கூரியர் மற்றும் தபால் சேவை விடுமுறை நாட்கள்</li>
                    <li>மோசமான வானிலை மற்றும் எதிர்பாராத போக்குவரத்துத் தடைகள்</li>
                </ul>
                <p>சராசரியாக 2 முதல் 4 வேலை நாட்களுக்குள் விநியோகம் செய்யப்படும். முழுமையான விபரங்களை எங்கள் <a href="<?php echo BASE_URL; ?>shipping-policy.php">விநியோகக் கொள்கை</a> பக்கத்தில் பார்வையிடலாம்.</p>

                <h2>11. திருப்பி அளித்தல் மற்றும் மீளளிப்புக் கொள்கை</h2>
                <p>வாடிக்கையாளர் திருப்தி எமது முதன்மை நோக்கம். தயாரிப்புகள் எமது <a href="<?php echo BASE_URL; ?>refund-policy.php">மீளளிப்புக் கொள்கை</a>க்கு இணங்க கையாளப்படுகின்றன:</p>
                <ul>
                    <li>சேதமடைந்த, காலாவதியான அல்லது தவறாக அனுப்பப்பட்ட தயாரிப்புகள் உடனடியாக மாற்றீடு செய்யப்படும் அல்லது முழுத் தொகையும் மீளளிக்கப்படும்.</li>
                    <li>உணவுப் பாதுகாப்பு மற்றும் சுகாதாரக் காரணங்களுக்காக, திறக்கப்பட்ட அல்லது பயன்படுத்தப்பட்ட உணவுப் பொருட்கள் மீளப்பெறப்பட மாட்டாது.</li>
                    <li>ஏதேனும் சிக்கல்கள் இருப்பின், பொருட்கள் கிடைத்த 48 மணி நேரத்திற்குள் எமது வாடிக்கையாளர் சேவைக்கு ஆதாரப் புகைப்படங்களுடன் தெரிவிக்க வேண்டும்.</li>
                </ul>

                <h2>12. உத்தரவாதமும் தயாரிப்புப் பயன்பாடும்</h2>
                <p>இயற்கை உணவுப் பொருட்கள் என்பதால், நேரடி சூரிய ஒளி படாத, குளிர்ந்த மற்றும் உலர்ந்த இடங்களில் சரியான முறையில் சேமிக்கப்பட வேண்டும். முறையற்ற சேமிப்பு அல்லது பயன்பாட்டின் காரணமாக ஏற்படும் பாதிப்புகளுக்கு நிறுவனம் பொறுப்பேற்காது.</p>
                <p>உங்களுக்கு ஏதேனும் உணவு ஒவ்வாமை (Allergies) இருப்பின், கொள்வனவு செய்வதற்கு முன்னர் தயாரிப்பு விவரங்களையும் மூலப்பொருட்களையும் கவனமாக வாசிக்குமாறு கேட்டுக்கொள்கிறோம்.</p>

                <h2>13. சலுகைகள், கூப்பன்கள் மற்றும் தள்ளுபடிகள்</h2>
                <ul>
                    <li>விசேட தள்ளுபடி கூப்பன்கள் மற்றும் சலுகைகள் அவற்றின் குறிப்பிட்ட கால அவகாசம் மற்றும் நிபந்தனைகளுக்கு உட்பட்டவை.</li>
                    <li>ஒரு ஆர்டருக்கு ஒரு சலுகைக் குறியீடு மட்டுமே பயன்படுத்தப்பட முடியும்.</li>
                    <li>முன்னறிவிப்பின்றி எந்தவொரு சலுகையையும் மாற்றவோ அல்லது இரத்து செய்யவோ நிறுவனத்திற்கு உரிமை உண்டு.</li>
                </ul>

                <h2>14. அறிவுசார் சொத்துரிமை</h2>
                <p><?php echo SITE_NAME; ?> தளத்தில் உள்ள சின்னங்கள் (Logos), படங்கள், வாசகங்கள், வலைத்தள வடிவமைப்பு மற்றும் உள்ளடக்கங்கள் அனைத்தும் <?php echo STORE_OWNER; ?> நிறுவனத்திற்குச் சொந்தமானவையாகும். எழுத்துப்பூர்வ அனுமதியின்றி இவற்றை மறுபிரசுரம் செய்வதோ அல்லது வணிக ரீதியாகப் பயன்படுத்துவதோ சட்டப்படி குற்றமாகும்.</p>

                <h2>15. தடைசெய்யப்பட்ட நடவடிக்கைகள்</h2>
                <p>வலைத்தள பயனர்கள் பின்வருவனவற்றில் ஈடுபடக்கூடாது:</p>
                <ul>
                    <li>சட்டவிரோதமான, மோசடியான அல்லது தவறான வழிகளில் வலைத்தளத்தைப் பயன்படுத்துதல்</li>
                    <li>சர்வர் அமைப்புகளையோ அல்லது வாடிக்கையாளர் தரவுகளையோ அனுமதியின்றி அணுக முயற்சித்தல்</li>
                    <li>போலியான ஆர்டர்கள் அல்லது தவறான தகவல்களைப் பதிவு செய்தல்</li>
                    <li>தீங்கிழைக்கும் மென்பொருட்கள் அல்லது வைரஸ்களைப் பரப்புதல்</li>
                </ul>

                <h2>16. பொறுப்பு வரம்பு</h2>
                <p>இலங்கைச் சட்டத்தினால் அனுமதிக்கப்பட்டுள்ள அதிகபட்ச வரம்பிற்கு உட்பட்டு, எதிர்பாராத சேவைகள் தாமதம், கூரியர் தாமதங்கள், அல்லது தவிர்க்க முடியாத இயற்கை இடர்பாடுகளால் ஏற்படும் இழப்புகளுக்கு நிறுவனம் பொறுப்பல்ல. எந்தவொரு சந்தர்ப்பத்திலும் நிறுவனத்தின் மொத்தப் பொறுப்பு, சம்பந்தப்பட்ட தயாரிப்பிற்காக நீங்கள் செலுத்திய தொகையை விட அதிகரிக்காது.</p>

                <h2>17. மூன்றாம் தரப்பு சேவைகள்</h2>
                <p>கட்டணப் பரிவர்த்தனைகள், வரைபடங்கள் மற்றும் கூரியர் சேவைகளுக்காக மூன்றாம் தரப்பு சேவைகளைப் பயன்படுத்துகிறோம். அந்த சேவைகளின் செயற்பாடுகள் அவற்றின் சொந்த விதிமுறைகளுக்கு உட்பட்டவை.</p>

                <h2>18. தனியுரிமைப் பாதுகாப்பு</h2>
                <p>உங்கள் தனிப்பட்ட விபரங்கள் அனைத்தும் எமது <a href="<?php echo BASE_URL; ?>privacy.php">தனியுரிமைக் கொள்கை</a>க்கு இணங்க இரகசியமாகவும் பாதுகாப்பாகவும் நிர்வகிக்கப்படுகின்றன. உங்கள் அனுமதியின்றி விபரங்கள் விற்கப்பட மாட்டாது.</p>

                <h2>19. வாடிக்கையாளர் மதிப்புரைகள் (Reviews)</h2>
                <p>உண்மையான வாடிக்கையாளர்கள் தயாரிப்புகளுக்கு மதிப்புரைகளையும் கருத்துக்களையும் பதிவு செய்யலாம். தவறான, ஆபாசமான அல்லது பொருத்தமற்ற கருத்துக்களை நீக்கும் உரிமை நிறுவனத்திற்கு உண்டு.</p>

                <h2>20. விதிமுறைகளில் மாற்றங்கள்</h2>
                <p>இந்த விதிமுறைகளை எப்போது வேண்டுமானாலும் திருத்தவோ அல்லது புதுப்பிக்கவோ எங்களுக்கு உரிமை உண்டு. மாற்றங்கள் இந்த பக்கத்தில் வெளியிடப்பட்ட உடனேயே நடைமுறைக்கு வரும்.</p>

                <h2>21. ஆளுகைச் சட்டம்</h2>
                <p>இந்த விதிமுறைகளும் நிபந்தனைகளும் <strong>இலங்கை ஜனநாயக சோசலிசக் குடியரசின் சட்டங்களுக்கு</strong> உட்பட்டு நிர்வகிக்கப்படுகின்றன. ஏதேனும் முரண்பாடுகள் அல்லது பிணக்குகள் ஏற்படின், அவை இலங்கை நீதிமன்றங்களின் அதிகார வரம்பிற்கு உட்பட்டவையாகும்.</p>

                <h2>22. பிரித்துப்பார்க்கும் தன்மை (Severability)</h2>
                <p>இந்த விதிமுறைகளின் ஏதேனும் ஒரு பிரிவு செல்லாது அல்லது செயல்படுத்த முடியாது என நீதிமன்றத்தால் தீர்ப்பளிக்கப்பட்டால், ஏனைய பிரிவுகள் முழுமையாக செல்லுபடியாகும்.</p>

                <h2>23. தொடர்பு விபரங்கள்</h2>
                <p>இந்த விதிமுறைகள் அல்லது உங்கள் ஆர்டர்கள் தொடர்பாக ஏதேனும் சந்தேகங்கள் இருப்பின், எங்களை நேரடியாகத் தொடர்பு கொள்ளலாம்:</p>
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
            <h1 class="page-title">Terms &amp; Conditions</h1>
            <p class="page-updated">Effective Date: 01 January 2026 &bull; Last updated: July 2026</p>

            <div class="page-body">
                <p>Welcome to <a href="https://<?php echo STORE_DOMAIN; ?>"><?php echo STORE_DOMAIN; ?></a>, operated by <?php echo STORE_OWNER; ?> (Business Registration: <?php echo STORE_BUSINESS_REG; ?>).</p>
                <p>By accessing or using this website, you agree to comply with and be bound by these Terms &amp; Conditions. If you do not agree with any part of these terms, please do not use our website or services.</p>

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

                <h2>2. Acceptance of Terms</h2>
                <p>By using <?php echo SITE_NAME; ?> and its related services, you acknowledge that you have read, understood, and agreed to these Terms &amp; Conditions, our <a href="<?php echo BASE_URL; ?>privacy.php">Privacy Policy</a>, <a href="<?php echo BASE_URL; ?>refund-policy.php">Refund Policy</a>, <a href="<?php echo BASE_URL; ?>shipping-policy.php">Shipping Policy</a>, and any additional policies published on the website.</p>
                <p>Continued use of the website after updates to these terms constitutes acceptance of the revised terms.</p>

                <h2>3. Eligibility</h2>
                <ul>
                    <li>You must be at least <strong>18 years old</strong>, or have parental or legal guardian consent, to use this website and place orders.</li>
                    <li>By placing an order, you confirm that you are legally capable of entering into a binding contract under the laws of Sri Lanka.</li>
                    <li>We reserve the right to refuse service to anyone who does not meet eligibility requirements.</li>
                </ul>

                <h2>4. Customer Accounts</h2>
                <p>To add items to your cart and complete checkout at <?php echo SITE_NAME; ?>, you <strong>must register and maintain an active customer account</strong>. Guest checkout is not available.</p>
                <p>Users may create accounts using:</p>
                <ul>
                    <li>Email registration</li>
                    <li>Google login (where available)</li>
                    <li>Facebook login (where available)</li>
                </ul>
                <p>You are responsible for:</p>
                <ul>
                    <li>Maintaining the confidentiality and security of your account credentials</li>
                    <li>Protecting your password</li>
                    <li>All activities conducted under your account</li>
                    <li>Providing accurate, current, and complete registration information</li>
                </ul>
                <p>We reserve the right to suspend or terminate accounts involved in fraudulent, abusive, or suspicious activity, or that violate these Terms &amp; Conditions.</p>

                <h2>5. Products and Services</h2>
                <p><?php echo SITE_NAME; ?> is an online store specialising in <strong>pure natural groceries, cold-pressed oils, cashews, traditional grains, organic spices, and healthy foods</strong>. Our catalogue includes:</p>
                <ul>
                    <li>Pure cold-pressed coconut, sesame, and herbal oils</li>
                    <li>Mullaitivu farm-fresh cashews, dry fruits, and pulses</li>
                    <li>Traditional heritage rice, grains, natural spices, and sweeteners</li>
                    <li>100% pure, natural, and chemical-free everyday groceries</li>
                </ul>
                <p>We are committed to offering authentic products sourced and selected with care. Product availability and catalogue items may change without prior notice. Product images and descriptions are for illustration; slight variations in natural packaging or texture may occur.</p>

                <h2>6. Product Information and Authenticity</h2>
                <ul>
                    <li>We strive to display accurate product images, ingredients, descriptions, and prices. Colours and appearance may vary slightly due to screen settings or lighting.</li>
                    <li>Items sold are genuine natural foods and quality-assured products as described.</li>
                    <li>Product availability is subject to stock. We reserve the right to limit quantities per customer or per order.</li>
                    <li>If a product becomes unavailable after you place an order, we may cancel that item or the full order and issue a full refund for any amount paid.</li>
                </ul>

                <h2>7. Pricing</h2>
                <ul>
                    <li>All prices are displayed in <strong>Sri Lankan Rupees (LKR)</strong>.</li>
                    <li>We reserve the right to modify prices, correct pricing errors, and cancel orders resulting from incorrect pricing or system errors.</li>
                    <li>Promotional prices apply only for the stated promotional period and subject to stated terms.</li>
                </ul>

                <h2>8. Orders</h2>
                <p>By placing an order through <?php echo SITE_NAME; ?>, you agree that:</p>
                <ul>
                    <li>All information you provide (name, address, phone, email, payment details) is accurate and complete.</li>
                    <li>You are authorised to use the payment method submitted.</li>
                    <li>We may verify customer details before processing or dispatching an order.</li>
                    <li>Orders may be cancelled or refused due to stock limitations, verification failures, suspected fraud, or violation of these terms.</li>
                </ul>
                <p>Order statuses include: Pending, Processing, Packed, Shipped, Delivered, and Cancelled. An order is confirmed only after you receive an order confirmation from us.</p>

                <h2>9. Payments</h2>
                <p>Accepted payment methods include:</p>
                <ul>
                    <li>Cash on Delivery (COD) across Sri Lanka</li>
                    <li>Direct Bank Transfer</li>
                    <li>LANKAQR payments</li>
                    <li>Secure online payment gateway (credit/debit cards including Visa &amp; Mastercard)</li>
                </ul>
                <p>All online payments are processed through secure, encrypted connections. We do not store full card details on our servers.</p>

                <h2>10. Shipping and Delivery</h2>
                <p><?php echo SITE_NAME; ?> provides <strong>island wide delivery within Sri Lanka</strong> via Sri Lanka Post (SL Post COD) and reputable courier partners. We do not currently offer international shipping.</p>
                <p>Estimated delivery times are 2 to 4 business days. Full details are set out in our <a href="<?php echo BASE_URL; ?>shipping-policy.php">Shipping Policy</a>.</p>

                <h2>11. Returns and Refunds</h2>
                <p>Returns and refunds are handled in accordance with our <a href="<?php echo BASE_URL; ?>refund-policy.php">Refund Policy</a> and applicable consumer protection laws in Sri Lanka.</p>
                <ul>
                    <li>Damaged, expired, or incorrectly supplied products will be replaced or refunded promptly.</li>
                    <li>Opened, used, or tampered food products cannot be returned due to hygiene and health regulations.</li>
                    <li>Please report any delivery issues within 48 hours of receipt with supporting photos.</li>
                </ul>

                <h2>12. Warranties and Product Storage</h2>
                <p>Natural and organic foods should be stored in a cool, dry place away from direct sunlight. We are not liable for spoilage or deterioration caused by improper storage or handling after delivery.</p>
                <p>Customers with known food allergies are advised to check all product ingredient details carefully before consumption.</p>

                <h2>13. Promotions, Coupons and Discounts</h2>
                <ul>
                    <li>Promotional codes, coupons, and special offers are subject to their stated terms and validity dates.</li>
                    <li>Only one promotion may apply per order unless explicitly stated.</li>
                    <li>We reserve the right to modify or withdraw promotions at any time.</li>
                </ul>

                <h2>14. Intellectual Property</h2>
                <p>All content on <?php echo SITE_NAME; ?> including logos, graphics, text, images, and website code is owned by <?php echo STORE_OWNER; ?> and protected by intellectual property laws. Unauthorized reproduction or use is strictly prohibited.</p>

                <h2>15. Prohibited Activities</h2>
                <p>Users shall not use the website for unlawful purposes, attempt unauthorized access to our servers, place fraudulent orders, or transmit harmful viruses or malicious code.</p>

                <h2>16. Limitation of Liability</h2>
                <p>To the maximum extent permitted by Sri Lankan law, <?php echo STORE_OWNER; ?> shall not be liable for indirect, incidental, or consequential damages. Our total liability for any claim shall not exceed the amount paid for the products in question.</p>

                <h2>17. Third-Party Services</h2>
                <p>We work with trusted third-party partners for payment gateway processing and logistics. Their services are governed by their respective terms and policies.</p>

                <h2>18. Privacy</h2>
                <p>Your privacy is important to us. Your personal data is handled securely in accordance with our <a href="<?php echo BASE_URL; ?>privacy.php">Privacy Policy</a>.</p>

                <h2>19. Customer Reviews</h2>
                <p>Logged-in customers may submit genuine product reviews. We reserve the right to remove any review that is defamatory, offensive, or fraudulent.</p>

                <h2>20. Modifications to These Terms</h2>
                <p>We reserve the right to update these Terms &amp; Conditions at any time. Changes become effective immediately upon posting on this website.</p>

                <h2>21. Governing Law</h2>
                <p>These Terms &amp; Conditions are governed by and construed in accordance with the laws of the <strong>Democratic Socialist Republic of Sri Lanka</strong>. Any disputes shall be subject to the exclusive jurisdiction of the courts of Sri Lanka.</p>

                <h2>22. Severability</h2>
                <p>If any provision of these terms is deemed invalid or unenforceable, the remaining provisions shall remain in full force and effect.</p>

                <h2>23. Contact Information</h2>
                <p>For inquiries regarding these Terms &amp; Conditions or our products, please reach out to us:</p>
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

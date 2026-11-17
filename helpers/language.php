<?php
/**
 * Vaanakam - Enhanced Language Helper with Dynamic Product, Category & Banner Translators
 */
require_once __DIR__ . '/../config/language.php';

$__current_lang = null;

if (!function_exists('get_current_language')) {
    function get_current_language(): string
    {
        global $__current_lang;
        if ($__current_lang !== null) {
            return $__current_lang;
        }
        if (session_status() === PHP_SESSION_NONE && php_sapi_name() !== 'cli') {
            @session_start();
        }
        $supported = defined('SUPPORTED_LANGUAGES') ? SUPPORTED_LANGUAGES : [];
        if (!empty($_SESSION['lang']) && isset($supported[$_SESSION['lang']])) {
            $__current_lang = $_SESSION['lang'];
            return $__current_lang;
        }
        if (!empty($_COOKIE['vaanakam_lang']) && isset($supported[$_COOKIE['vaanakam_lang']])) {
            if (session_status() === PHP_SESSION_ACTIVE) {
                $_SESSION['lang'] = $_COOKIE['vaanakam_lang'];
            }
            $__current_lang = $_COOKIE['vaanakam_lang'];
            return $__current_lang;
        }
        return defined('DEFAULT_LANGUAGE') ? DEFAULT_LANGUAGE : 'en';
    }
}

if (!function_exists('set_current_language')) {
    function set_current_language(string $lang): bool
    {
        global $__current_lang;
        $lang = strtolower(trim($lang));
        $supported = defined('SUPPORTED_LANGUAGES') ? SUPPORTED_LANGUAGES : [];
        if (!isset($supported[$lang])) {
            return false;
        }
        $__current_lang = $lang;
        if (session_status() === PHP_SESSION_NONE && php_sapi_name() !== 'cli') {
            @session_start();
        }
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION['lang'] = $lang;
        }
        if (php_sapi_name() !== 'cli' && !headers_sent()) {
            setcookie('vaanakam_lang', $lang, [
                'expires'  => time() + (86400 * 365),
                'path'     => '/',
                'httponly' => false,
                'samesite' => 'Lax'
            ]);
        }
        return true;
    }
}

if (!function_exists('__t')) {
    function __t(string $key, array $replace = []): string
    {
        static $translations = [];
        $lang = get_current_language();

        if (!isset($translations[$lang])) {
            $langFile = __DIR__ . '/../languages/' . $lang . '.php';
            if (is_file($langFile)) {
                $translations[$lang] = require $langFile;
            } else {
                $translations[$lang] = [];
            }
        }

        $text = $translations[$lang][$key] ?? null;
        if ($text === null) {
            if (!isset($translations['en'])) {
                $enFile = __DIR__ . '/../languages/en.php';
                $translations['en'] = is_file($enFile) ? (require $enFile) : [];
            }
            $text = $translations['en'][$key] ?? $key;
        }

        if (!empty($replace)) {
            foreach ($replace as $k => $v) {
                $text = str_replace(':' . $k, (string)$v, $text);
            }
        }

        return $text;
    }
}

if (!function_exists('get_language_info')) {
    function get_language_info(?string $lang = null): array
    {
        $lang = $lang ?? get_current_language();
        $supported = defined('SUPPORTED_LANGUAGES') ? SUPPORTED_LANGUAGES : [];
        return $supported[$lang] ?? ($supported['en'] ?? [
            'code' => 'en', 'name' => 'English', 'native_name' => 'English', 'flag' => '🇬🇧', 'short' => 'EN'
        ]);
    }
}

if (!function_exists('get_supported_languages')) {
    function get_supported_languages(): array
    {
        return defined('SUPPORTED_LANGUAGES') ? SUPPORTED_LANGUAGES : [];
    }
}

/**
 * Master Tamil Dictionary for Database Entities (Products, Categories, Subcategories, Banners)
 */
if (!function_exists('get_master_tamil_entities')) {
    function get_master_tamil_entities(): array
    {
        static $map = null;
        if ($map !== null) {
            return $map;
        }

        $map = [
            // === CATEGORIES & SUBCATEGORIES ===
            'Pure Oils'                 => 'தூய மரச்செக்கு எண்ணெய்கள்',
            'Oils'                      => 'எண்ணெய்கள்',
            'Cold-Pressed Oils'         => 'மரச்செக்கு எண்ணெய்கள்',
            'Rice & Grains'             => 'அரிசி & பாரம்பரிய தானியங்கள்',
            'Traditional Rice & Grains' => 'பாரம்பரிய அரிசி & தானியங்கள்',
            'Rice & Traditional Grains' => 'பாரம்பரிய அரிசி & தானியங்கள்',
            'Grains & Rice'             => 'அரிசி & தானியங்கள்',
            'Grains'                    => 'தானியங்கள்',
            'Cashews & Nuts'            => 'முந்திரி & உலர் பருப்புகள்',
            'Nuts'                      => 'நட்ஸ் & உலர் பருப்புகள்',
            'Spices & Masala'           => 'மசாலா & நறுமணப் பொருட்கள்',
            'Spices & Powders'          => 'மசாலா & நறுமணத் தூள்கள்',
            'Spices'                    => 'மசாலாக்கள்',
            'Honey & Sweets'            => 'இயற்கைத் தேன் & இனிப்புகள்',
            'Organic Honey & Sweeteners'=> 'இயற்கைத் தேன் & பனை இனிப்புகள்',
            'Honey & Sweeteners'        => 'இயற்கைத் தேன் & பனை இனிப்புகள்',
            'Honey'                     => 'தேன் & பனை வெல்லம்',
            'Herbal & Health'           => 'மூலிகை & ஆரோக்கிய உணவுகள்',
            'Herbal'                    => 'மூலிகைப் பொருட்கள்',
            'All Products'              => 'அனைத்துப் பொருட்கள்',
            'Hot Deals'                 => 'சிறப்பு சலுகைகள்',
            'Best Sellers'              => 'அதிக விற்பனையானவை',
            'New Arrivals'              => 'புதிய வரவுகள்',
            'Featured'                  => 'சிறப்புத் தயாரிப்புகள்',
            'Collections'               => 'பிரிவுகள்',

            // Grocery Subcategories & Products
            'Cold-Pressed Coconut Oil'  => 'மரச்செக்கு தேங்காய் எண்ணெய்',
            'Cold Pressed Coconut Oil'  => 'மரச்செக்கு தேங்காய் எண்ணெய்',
            'Pure Cold-Pressed Coconut Oil' => 'தூய மரச்செக்கு தேங்காய் எண்ணெய்',
            'Cold-Pressed Sesame Oil'   => 'மரச்செக்கு நல்லெண்ணெய்',
            'Cold Pressed Sesame Oil'   => 'மரச்செக்கு நல்லெண்ணெய்',
            'Pure Sesame Oil'           => 'தூய நல்லெண்ணெய்',
            'Cold-Pressed Gingelly Oil' => 'மரச்செக்கு நல்லெண்ணெய்',
            'Cold-Pressed Groundnut Oil'=> 'மரச்செக்கு கடலை எண்ணெய்',
            'Pure Cow Ghee'             => 'தூய பசும் நெய்',
            'Organic Cow Ghee'          => 'இயற்கை பசும் நெய்',
            'Cow Ghee'                  => 'பசும் நெய்',
            'Ghee'                      => 'நெய்',
            'Cold-Pressed Oils'         => 'மரச்செக்கு எண்ணெய்கள்',
            'Coconut Oil'               => 'தேங்காய் எண்ணெய்',
            'Sesame Oil'                => 'நல்லெண்ணெய்',
            'Gingelly Oil'              => 'நல்லெண்ணெய்',
            'Groundnut Oil'             => 'கடலை எண்ணெய்',

            // Cashews & Nuts
            'Mullaitivu Roasted Cashews'=> 'முல்லைத்தீவு வறுத்த முந்திரி',
            'Roasted Cashews'           => 'வறுத்த முந்திரி',
            'Roasted Cashew Nuts'       => 'வறுத்த முந்திரிப் பருப்பு',
            'Raw Cashews'               => 'பச்சை முந்திரி',
            'Raw Cashew Nuts'           => 'பச்சை முந்திரிப் பருப்பு',
            'Spicy Roasted Cashews'     => 'காரசாரமான வறுத்த முந்திரி',
            'Salted Cashews'            => 'உப்பு முந்திரி',
            'Whole Cashews'             => 'முழு முந்திரி',
            'Cashew Nuts'               => 'முந்திரிப் பருப்பு',
            'Cashews'                   => 'முந்திரி',
            'Almonds'                   => 'பாதாம் பருப்பு',
            'Raw Almonds'               => 'இயற்கை பாதாம் பருப்பு',
            'Walnuts'                   => 'அக்ரூட் பருப்பு',
            'Pistachios'                => 'பிஸ்தா பருப்பு',
            'Dates'                     => 'பேரீச்சம்பழம்',
            'Medjool Dates'             => 'மெட்ஜூல் பேரீச்சம்பழம்',
            'Dry Fruits'                => 'உலர் பழங்கள்',
            'Dry Grapes'                => 'உலர் திராட்சை',
            'Raisins'                   => 'உலர் திராட்சை',

            // Rice & Traditional Grains
            'Traditional Red Rice'      => 'பாரம்பரிய சிவப்பு அரிசி',
            'Red Raw Rice'              => 'சிவப்பு பச்சரிசி',
            'Red Rice'                  => 'சிவப்பு அரிசி',
            'White Raw Rice'            => 'பச்சரிசி',
            'Raw Rice'                  => 'பச்சரிசி',
            'Kalu Heenati Rice'         => 'களு ஹீனட்டி அரிசி',
            'Kuruluthuda Rice'          => 'குருளுதுட அரிசி',
            'Suwandel Rice'             => 'சுவந்தெல் அரிசி',
            'Pachchaperumal Rice'       => 'பச்சைப்பெருமாள் அரிசி',
            'Maduwa Rice'               => 'மாடுவ அரிசி',
            'Finger Millet (Ragi)'      => 'கேழ்வரகு (ராகி)',
            'Finger Millet Flour'       => 'கேழ்வரகு மாவு',
            'Finger Millet'             => 'கேழ்வரகு',
            'Ragi Flour'                => 'ராகி மாவு',
            'Ragi'                      => 'ராகி',
            'Foxtail Millet'            => 'தினை',
            'Kodo Millet'               => 'வரகு',
            'Little Millet'             => 'சாமை',
            'Barnyard Millet'           => 'குதிரைவாலி',

            // Spices & Condiments
            'Ceylon Black Pepper'       => 'இலங்கை கருப்பு மிளகு',
            'Pure Black Pepper'         => 'தூய கருப்பு மிளகு',
            'Black Pepper Powder'       => 'கருப்பு மிளகு தூள்',
            'Black Pepper'              => 'கருப்பு மிளகு',
            'Pepper'                    => 'மிளகு',
            'Turmeric Powder'           => 'மஞ்சள் தூள்',
            'Pure Turmeric Powder'      => 'தூய மஞ்சள் தூள்',
            'Turmeric'                  => 'மஞ்சள்',
            'Chili Powder'              => 'மிளகாய் தூள்',
            'Crushed Chili'             => 'மிளகாய் தூள் (சில்லி ஃப்ளேக்ஸ்)',
            'Curry Powder'              => 'கறி மசாலா தூள்',
            'Roasted Curry Powder'      => 'வறுத்த கறி மசாலா தூள்',
            'Raw Curry Powder'          => 'வறுக்காத கறித்தூள்',
            'Coriander Powder'          => 'மல்லித்தூள்',
            'Coriander Seeds'           => 'கொத்தமல்லி விதை',
            'Cumin Seeds'               => 'சீரகம்',
            'Cumin Powder'              => 'சீரகத்தூள்',
            'Fennel Seeds'              => 'பெருஞ்சீரகம் (சோம்பு)',
            'Mustard Seeds'             => 'கடுகு',
            'Fenugreek Seeds'           => 'வெந்தயம்',
            'Cardamom'                  => 'ஏலக்காய்',
            'Ceylon Cardamom'           => 'இலங்கை ஏலக்காய்',
            'Ceylon Cinnamon'           => 'இலங்கை இலவங்கப்பட்டை',
            'Cinnamon Powder'           => 'இலவங்கப்பட்டை பொடி',
            'Cinnamon Sticks'           => 'இலவங்கப்பட்டை குச்சிகள்',
            'Cinnamon'                  => 'இலவங்கப்பட்டை',
            'Cloves'                    => 'கிராம்பு',
            'Nutmeg'                    => 'ஜாதிக்காய்',

            // Honey & Traditional Sweets
            'Pure Wild Honey'           => 'தூய காட்டுத் தேன்',
            'Wild Honey'                => 'காட்டுத் தேன்',
            'Raw Bee Honey'             => 'இயற்கை தேனீ தேன்',
            'Natural Honey'             => 'இயற்கைத் தேன்',
            'Bee Honey'                 => 'தூய தேன்',
            'Palm Jaggery'              => 'பாரம்பரிய பனை வெல்லம்',
            'Traditional Palm Jaggery'  => 'பாரம்பரிய பனை வெல்லம்',
            'Palmyra Jaggery'           => 'பனை வெல்லம்',
            'Kithul Jaggery'            => 'கித்துள் வெல்லம்',
            'Kithul Treacle'            => 'கித்துள் பாணி',
            'Cane Jaggery'              => 'கரும்பு வெல்லம்',
            'Jaggery'                   => 'வெல்லம்',

            // Herbal & Wellness
            'Moringa Leaf Powder'       => 'முருங்கை இலை பொடி',
            'Organic Moringa Powder'    => 'இயற்கை முருங்கை பொடி',
            'Moringa Powder'            => 'முருங்கை பொடி',
            'Curry Leaf Powder'         => 'கறிவேப்பிலை பொடி',
            'Herbal Tea'                => 'மூலிகை தேநீர்',
            'Green Tea'                 => 'பச்சை தேநீர்',
            'Amla Powder'               => 'நெல்லிக்காய் பொடி',
            'Triphala Powder'           => 'திரிபலா பொடி',
            'Neem Powder'               => 'வேப்பிலை பொடி',

            // Pulses & Grains
            'Green Gram'                => 'பாசிப்பருப்பு',
            'Moong Dal'                 => 'பாசிப்பருப்பு',
            'Black Gram'                => 'உளுந்தம்பருப்பு',
            'Urad Dal'                  => 'உளுந்தம்பருப்பு',
            'Toor Dal'                  => 'துவரம்பருப்பு',
            'Chickpeas'                 => 'கொண்டைக்கடலை',
            'Brown Chickpeas'           => 'கருப்பு கொண்டைக்கடலை',

            // Electronics & Tech fallback categories
            'Smartphones & Tablets'     => 'ஸ்மார்ட்போன்கள் & டேப்லெட்டுகள்',
            'Audio & Speakers'          => 'ஆடியோ & ஸ்பீக்கர்கள்',
            'Accessories'               => 'துணைக்கருவிகள்',
            'Wearables & Smartwatches'  => 'ஸ்மார்ட்வாட்ச்கள் & கடிகாரங்கள்',
            'Laptops & Computers'       => 'மடிக்கணினிகள் & கணினிகள்',
            'TVs & Home Entertainment'  => 'தொலைக்காட்சி & பொழுதுபோக்கு',
            'Apple iPhones'             => 'ஆப்பிள் ஐபோன்கள்',
            'Android Phones'            => 'ஆண்ட்ராய்டு போன்கள்',
            'iPads & Tablets'           => 'ஐபேட்கள் & டேப்லெட்டுகள்',
            'Wireless Earbuds'          => 'வயர்லெஸ் இயர்பட்ஸ்',
            'Headphones'                => 'ஹெட்போன்கள்',
            'Bluetooth Speakers'        => 'புளூடூத் ஸ்பீக்கர்கள்',
            'Chargers & Adapters'       => 'சார்ஜர்கள் & அடாப்டர்கள்',
            'Cables & Hubs'             => 'கேபிள்கள் & ஹப்கள்',
            'Cases & Covers'            => 'கேஸ்கள் & கவர்கள்',
            'Apple Watch'               => 'ஆப்பிள் வாட்ச்',
            'Fitness Trackers'          => 'ஃபிட்னஸ் டிராக்கர்கள்',

            // Banners and Headlines
            'Welcome to VAANAKAM'       => 'வானகத்திற்கு நல்வரவு',
            'Good Food - Healthy Life'  => 'சிறந்த உணவு - ஆரோக்கியமான வாழ்வு',
            '100% Pure & Natural'       => '100% தூய & இயற்கை',
            'Shop Fresh Groceries'      => 'இயற்கை உணவுகளை வாங்க',
            'Shop Now'                  => 'இப்போதே வாங்க',
            'Our Story'                 => 'எங்கள் கதை',
            'Fresh organic groceries, pure cold-pressed oils, premium cashews, and traditional natural foods from Mullaitivu. Delivered fresh island wide across Sri Lanka.'
                => 'தூய இயற்கை மளிகைப் பொருட்கள், மரச்செக்கு எண்ணெய்கள், உயர்தர முந்திரி மற்றும் பாரம்பரிய இயற்கை உணவுகள் முல்லைத்தீவிலிருந்து உங்கள் இல்லத்திற்கு. நாடு தழுவிய புதிய விநியோகம்.',
        ];

        return $map;
    }
}

/**
 * Universal dynamic translator for database entities & text (Product names, Categories, Banners)
 */
if (!function_exists('translate_text')) {
    function translate_text(?string $text): string
    {
        if ($text === null || $text === '') {
            return '';
        }
        if (get_current_language() !== 'ta') {
            return $text;
        }

        $dict = get_master_tamil_entities();
        $trimmed = trim($text);

        // 1. Direct exact match
        if (isset($dict[$trimmed])) {
            return $dict[$trimmed];
        }

        // 2. Case-insensitive exact match
        $lower = mb_strtolower($trimmed, 'UTF-8');
        foreach ($dict as $en => $ta) {
            if (mb_strtolower($en, 'UTF-8') === $lower) {
                return $ta;
            }
        }

        // 3. Fallback to __t() dictionary key
        $tVal = __t($trimmed);
        if ($tVal !== $trimmed) {
            return $tVal;
        }

        return $text;
    }
}

/**
 * Translate Product Names with smart compound and phrase matching
 */
if (!function_exists('translate_product_name')) {
    function translate_product_name(?string $name): string
    {
        if ($name === null || $name === '') {
            return '';
        }
        if (get_current_language() !== 'ta') {
            return $name;
        }

        $trimmed = trim($name);
        $dict = get_master_tamil_entities();

        // 1. Exact match
        if (isset($dict[$trimmed])) {
            return $dict[$trimmed];
        }

        // 2. Case-insensitive exact match
        $lower = mb_strtolower($trimmed, 'UTF-8');
        foreach ($dict as $en => $ta) {
            if (mb_strtolower($en, 'UTF-8') === $lower) {
                return $ta;
            }
        }

        // 3. Compound / Phrase matching:
        // Replace longest English phrases first with their Tamil equivalents
        $translated = $trimmed;
        static $sortedKeys = null;
        if ($sortedKeys === null) {
            $sortedKeys = array_keys($dict);
            usort($sortedKeys, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
        }

        foreach ($sortedKeys as $enKey) {
            if (mb_strlen($enKey, 'UTF-8') < 3) {
                continue;
            }
            if (stripos($translated, $enKey) !== false) {
                $taVal = $dict[$enKey];
                $pattern = '/\b' . preg_quote($enKey, '/') . '\b/iu';
                if (preg_match($pattern, $translated)) {
                    $translated = preg_replace($pattern, $taVal, $translated);
                }
            }
        }

        // Translate common units/words in product titles
        $unitMap = [
            '/\b10kg\b/i'    => '10 கிலோ',
            '/\b5kg\b/i'     => '5 கிலோ',
            '/\b2kg\b/i'     => '2 கிலோ',
            '/\b1kg\b/i'     => '1 கிலோ',
            '/\b500g\b/i'    => '500 கிராம்',
            '/\b250g\b/i'    => '250 கிராம்',
            '/\b100g\b/i'    => '100 கிராம்',
            '/\b50g\b/i'     => '50 கிராம்',
            '/\b5l\b/i'      => '5 லீட்டர்',
            '/\b2l\b/i'      => '2 லீட்டர்',
            '/\b1l\b/i'      => '1 லீட்டர்',
            '/\b500ml\b/i'   => '500 மி.லீ',
            '/\b250ml\b/i'   => '250 மி.லீ',
            '/\b100ml\b/i'   => '100 மி.லீ',
            '/\bOrganic\b/i' => 'இயற்கை',
            '/\bPure\b/i'    => 'தூய',
            '/\bFresh\b/i'   => 'புதிய',
            '/\bNatural\b/i' => 'இயற்கை',
            '/\bTraditional\b/i' => 'பாரம்பரிய',
            '/\bRoasted\b/i' => 'வறுத்த',
            '/\bRaw\b/i'     => 'பச்சை',
        ];
        foreach ($unitMap as $regex => $taUnit) {
            $translated = preg_replace($regex, $taUnit, $translated);
        }

        return $translated;
    }
}

/**
 * Shorthand alias
 */
if (!function_exists('__tp')) {
    function __tp(?string $name): string
    {
        return translate_product_name($name);
    }
}

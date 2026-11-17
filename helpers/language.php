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
 * Smart automatic English to Tamil translation engine
 * - Exact dictionary matching
 * - Multi-word phrase & compound matching
 * - Units & packaging conversion (e.g. 500ml, 1kg, 250g)
 * - Extensive grocery, natural products, spices, herbs vocabulary
 */
if (!function_exists('auto_translate_to_tamil')) {
    function auto_translate_to_tamil(?string $text): string
    {
        if ($text === null || trim($text) === '') {
            return '';
        }

        $trimmed = trim($text);
        $dict = get_master_tamil_entities();

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

        // 3. Fallback to translation dictionary key
        $tVal = __t($trimmed);
        if ($tVal !== $trimmed) {
            return $tVal;
        }

        // 4. Phrase & Compound matching (longest phrases first)
        static $sortedKeys = null;
        if ($sortedKeys === null) {
            $sortedKeys = array_keys($dict);
            usort($sortedKeys, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
        }

        $translated = $trimmed;
        foreach ($sortedKeys as $enKey) {
            if (mb_strlen($enKey, 'UTF-8') < 3) {
                continue;
            }
            $pattern = '/\b' . preg_quote($enKey, '/') . '\b/iu';
            if (preg_match($pattern, $translated)) {
                $translated = preg_replace($pattern, $dict[$enKey], $translated);
            }
        }

        // 5. Units & quantities map
        $unitMap = [
            '/\b10\s*kg\b/i'        => '10 கிலோ',
            '/\b5\s*kg\b/i'         => '5 கிலோ',
            '/\b2\s*kg\b/i'         => '2 கிலோ',
            '/\b1\s*kg\b/i'         => '1 கிலோ',
            '/\b750\s*g\b/i'        => '750 கிராம்',
            '/\b500\s*g\b/i'        => '500 கிராம்',
            '/\b375\s*g\b/i'        => '375 கிராம்',
            '/\b250\s*g\b/i'        => '250 கிராம்',
            '/\b200\s*g\b/i'        => '200 கிராம்',
            '/\b150\s*g\b/i'        => '150 கிராம்',
            '/\b100\s*g\b/i'        => '100 கிராம்',
            '/\b50\s*g\b/i'         => '50 கிராம்',
            '/\b25\s*g\b/i'         => '25 கிராம்',
            '/\b5\s*l(?:iter|itre)?s?\b/i'  => '5 லீட்டர்',
            '/\b2\s*l(?:iter|itre)?s?\b/i'  => '2 லீட்டர்',
            '/\b1\s*l(?:iter|itre)?s?\b/i'  => '1 லீட்டர்',
            '/\b750\s*ml\b/i'       => '750 மி.லீ',
            '/\b500\s*ml\b/i'       => '500 மி.லீ',
            '/\b375\s*ml\b/i'       => '375 மி.லீ',
            '/\b250\s*ml\b/i'       => '250 மி.லீ',
            '/\b200\s*ml\b/i'       => '200 மி.லீ',
            '/\b100\s*ml\b/i'       => '100 மி.லீ',
            '/\b50\s*ml\b/i'        => '50 மி.லீ',
            '/\b(\d+)\s*pcs?\b/i'   => '$1 எண்ணிக்கை',
            '/\b(\d+)\s*packs?\b/i' => '$1 பாக்கெட்',
        ];
        foreach ($unitMap as $regex => $taUnit) {
            $translated = preg_replace($regex, $taUnit, $translated);
        }

        // 6. Comprehensive Grocery, Spices & Natural Products Word Map
        $wordsMap = [
            'organic'       => 'இயற்கை',
            'pure'          => 'தூய',
            'natural'       => 'இயற்கை',
            'fresh'         => 'புதிய',
            'traditional'   => 'பாரம்பரிய',
            'roasted'       => 'வறுத்த',
            'raw'           => 'பச்சை',
            'dried'         => 'உலர்',
            'dry'           => 'உலர்',
            'spicy'         => 'காரசாரமான',
            'salted'        => 'உப்பு சேர்க்கப்பட்ட',
            'sweet'         => 'இனிப்பு',
            'crushed'       => 'நசுக்கிய',
            'ground'        => 'அரைத்த',
            'whole'         => 'முழு',
            'sticks'        => 'சுருள் பட்டை',
            'stick'         => 'சுருள் பட்டை',
            'powder'        => 'தூள்',
            'flour'         => 'மாவு',
            'flours'        => 'மாவு வகைகள்',
            'seeds'         => 'விதைகள்',
            'seed'          => 'விதை',
            'leaf'          => 'இலை',
            'leaves'        => 'இலைகள்',
            'oil'           => 'எண்ணெய்',
            'oils'          => 'எண்ணெய்கள்',
            'cold-pressed'  => 'மரச்செக்கு',
            'cold pressed'  => 'மரச்செக்கு',
            'ghee'          => 'நெய்',
            'honey'         => 'தேன்',
            'jaggery'       => 'வெல்லம்',
            'sugar'         => 'சர்க்கரை',
            'salt'          => 'உப்பு',
            'tea'           => 'தேநீர்',
            'coffee'        => 'காபி',
            'soap'          => 'சோப்பு',
            'shampoo'       => 'ஷாம்பு',
            'rice'          => 'அரிசி',
            'grains'        => 'தானியங்கள்',
            'grain'         => 'தானியம்',
            'millet'        => 'சிறுதானியம்',
            'millets'       => 'சிறுதானியங்கள்',
            'ragi'          => 'கேழ்வரகு (ராகி)',
            'dhal'          => 'பருப்பு',
            'dal'           => 'பருப்பு',
            'gram'          => 'பயறு',
            'cashews'       => 'முந்திரி',
            'cashew'        => 'முந்திரி',
            'nuts'          => 'நட்ஸ்',
            'nut'           => 'பருப்பு',
            'almonds'       => 'பாதாம்',
            'almond'        => 'பாதாம்',
            'walnuts'       => 'அக்ரூட்',
            'dates'         => 'பேரீச்சம்பழம்',
            'raisins'       => 'உலர் திராட்சை',
            'spices'        => 'மசாலாக்கள்',
            'spice'         => 'மசாலா',
            'curry'         => 'கறி மசாலா',
            'pepper'        => 'மிளகு',
            'chili'         => 'மிளகாய்',
            'chilli'        => 'மிளகாய்',
            'turmeric'      => 'மஞ்சள்',
            'coriander'     => 'கொத்தமல்லி',
            'cumin'         => 'சீரகம்',
            'fennel'        => 'சோம்பு',
            'fenugreek'     => 'வெந்தயம்',
            'mustard'       => 'கடுகு',
            'cardamom'      => 'ஏலக்காய்',
            'cinnamon'      => 'பட்டை',
            'clove'         => 'கிராம்பு',
            'cloves'        => 'கிராம்பு',
            'moringa'       => 'முருங்கை',
            'neem'          => 'வேம்பு',
            'tulsi'         => 'துளசி',
            'aloe vera'     => 'கற்றாழை',
            'aloevera'      => 'கற்றாழை',
            'ginger'        => 'இஞ்சி',
            'garlic'        => 'பூண்டு',
            'sesame'        => 'எள்ளு / நல்லெண்ணெய்',
            'coconut'       => 'தேங்காய்',
            'groundnut'     => 'கடலை',
            'peanut'        => 'கடலை',
            'kithul'        => 'கித்துள்',
            'wild'          => 'காட்டு',
            'herbal'        => 'மூலிகை',
            'ayurvedic'     => 'ஆயுர்வேத',
            'items'         => 'பொருட்கள்',
            'products'      => 'பொருட்கள்',
            'essentials'    => 'அத்தியாவசியங்கள்',
            'ceylon'        => 'இலங்கை',
            'sri lanka'     => 'இலங்கை',
            'black'         => 'கருப்பு',
            'white'         => 'வெள்ளை',
            'red'           => 'சிவப்பு',
            'green'         => 'பச்சை',
            'yellow'        => 'மஞ்சள்',
            'beverages'     => 'பானங்கள்',
            'snacks'        => 'சிற்றுண்டிகள்',
            'sweeteners'    => 'இனிப்புகள்',
            'powders'       => 'நறுமணத் தூள்கள்',
            'health'        => 'ஆரோக்கியம்',
            'groceries'     => 'மளிகைப் பொருட்கள்',
            'grocery'       => 'மளிகை',
            'handmade'      => 'கைவினைத் தயாரிப்பு',
            'premium'       => 'உயர்தர',
        ];

        static $sortedWords = null;
        if ($sortedWords === null) {
            $sortedWords = array_keys($wordsMap);
            usort($sortedWords, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
        }

        foreach ($sortedWords as $w) {
            $pattern = '/\b' . preg_quote($w, '/') . '\b/iu';
            if (preg_match($pattern, $translated)) {
                $translated = preg_replace($pattern, $wordsMap[$w], $translated);
            }
        }

        return preg_replace('/\s+/', ' ', trim($translated));
    }
}

/**
 * Universal dynamic translator for database entities & text (Categories, Subcategories, Banners)
 */
if (!function_exists('translate_text')) {
    function translate_text(?string $text, ?string $textTa = null): string
    {
        if ($text === null || $text === '') {
            return '';
        }
        if (get_current_language() !== 'ta') {
            return $text;
        }
        if ($textTa !== null && trim($textTa) !== '') {
            return trim($textTa);
        }

        return auto_translate_to_tamil($text);
    }
}

/**
 * Translate Product Names with smart compound and phrase matching
 */
if (!function_exists('translate_product_name')) {
    function translate_product_name(?string $name, ?string $nameTa = null): string
    {
        if ($name === null || $name === '') {
            return '';
        }
        if (get_current_language() !== 'ta') {
            return $name;
        }
        if ($nameTa !== null && trim($nameTa) !== '') {
            return trim($nameTa);
        }

        return auto_translate_to_tamil($name);
    }
}

/**
 * Shorthand alias
 */
if (!function_exists('__tp')) {
    function __tp(?string $name, ?string $nameTa = null): string
    {
        return translate_product_name($name, $nameTa);
    }
}

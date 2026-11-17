<?php
require_once __DIR__ . '/../config/app.php';
$pageTitle = SITE_NAME . " - " . __t('tagline');
require_once __DIR__ . '/../dal/ProductDAL.php';
require_once __DIR__ . '/../dal/CategoryDAL.php';
require_once __DIR__ . '/../dal/BannerDAL.php';
require_once __DIR__ . '/../dal/TestimonialDAL.php';
require_once __DIR__ . '/../dal/MegaDealDAL.php';
require_once __DIR__ . '/../dal/SiteSettingsDAL.php';
require_once __DIR__ . '/../helpers/product-card.php';

// Fetch data (before header so we can preload the hero/banner image)
$banners = [];
$categories = [];
$featuredProducts = [];
$testimonials = [];
$megaDealsEnabled = true;

try {
    $settingsDAL = new SiteSettingsDAL();
    $megaDealsEnabled = $settingsDAL->get('mega_deals_enabled', '1') === '1';
} catch (Exception $e) {}

try {
    $bannerDAL = new BannerDAL();
    $banners = $bannerDAL->getActive();
} catch (Exception $e) {}

$pagePreloadImages = [];
if (!empty($banners[0]['image'])) {
    $pagePreloadImages[] = asset_image_url(ltrim($banners[0]['image'], '/'));
} else {
    $pagePreloadImages[] = asset_image_url('assets/images/pic02.png');
}

require_once __DIR__ . '/partials/header.php';

try {
    $categoryDAL = new CategoryDAL();
    $categories = $categoryDAL->getActive();
} catch (Exception $e) {}

$categoryIconBarConfig = [
    ['name' => 'Pure Oils', 'short' => 'Pure Oils', 'icon' => 'fa-bottle-droplet', 'keywords' => ['oil', 'oils', 'coconut', 'sesame', 'gingelly', 'ghee', 'cold-pressed']],
    ['name' => 'Rice & Grains', 'short' => 'Grains', 'icon' => 'fa-wheat-awn', 'keywords' => ['rice', 'grain', 'grains', 'millet', 'millets', 'flour', 'cereal', 'traditional-rice']],
    ['name' => 'Cashews & Nuts', 'short' => 'Nuts', 'icon' => 'fa-seedling', 'keywords' => ['cashew', 'cashews', 'nut', 'nuts', 'dry-fruits', 'almond', 'walnut', 'peanut']],
    ['name' => 'Spices & Masala', 'short' => 'Spices', 'icon' => 'fa-mortar-pestle', 'keywords' => ['spice', 'spices', 'masala', 'pepper', 'turmeric', 'chili', 'curry-powder']],
    ['name' => 'Honey & Sweets', 'short' => 'Honey', 'icon' => 'fa-jar', 'keywords' => ['honey', 'jaggery', 'palm-jaggery', 'sweet', 'sweets', 'sugar']],
    ['name' => 'Herbal & Health', 'short' => 'Herbal', 'icon' => 'fa-leaf', 'keywords' => ['herbal', 'health', 'wellness', 'tea', 'organic', 'moringa', 'ayurvedic']],
];

if (!function_exists('resolve_category_icon')) {
    function resolve_category_icon(string $name, string $slug, array $rules): string
    {
        $extraRules = [
            ['icon' => 'fa-bottle-droplet', 'keywords' => ['oil', 'oils', 'ghee', 'cold-pressed']],
            ['icon' => 'fa-wheat-awn', 'keywords' => ['rice', 'grain', 'grains', 'millet', 'flour']],
            ['icon' => 'fa-seedling', 'keywords' => ['cashew', 'nut', 'nuts', 'seed', 'dry-fruit']],
            ['icon' => 'fa-mortar-pestle', 'keywords' => ['spice', 'masala', 'pepper', 'turmeric', 'chili']],
            ['icon' => 'fa-jar', 'keywords' => ['honey', 'jaggery', 'sweet']],
            ['icon' => 'fa-leaf', 'keywords' => ['tea', 'herbal', 'organic', 'leaf', 'health']],
            ['icon' => 'fa-carrot', 'keywords' => ['vegetable', 'fresh', 'produce']],
            ['icon' => 'fa-apple-alt', 'keywords' => ['fruit', 'fruits']],
        ];
        $allRules = array_merge($rules, $extraRules);
        $catSlug = strtolower($slug);
        $catName = strtolower($name);
        foreach ($allRules as $rule) {
            foreach ($rule['keywords'] as $kw) {
                $kwNorm = str_replace('-', ' ', $kw);
                if ($catSlug === $kw || strpos($catSlug, $kw) !== false || strpos($catName, $kwNorm) !== false) {
                    return $rule['icon'];
                }
            }
        }
        return 'fa-leaf';
    }
}

try {
    $productDAL = new ProductDAL();
    $featuredProducts = $productDAL->getLatest(8);
} catch (Exception $e) {}

try {
    $testimonialDAL = new TestimonialDAL();
    $testimonials = $testimonialDAL->getApproved(6);
} catch (Exception $e) {}

$megaDeals = [];
try {
    if ($megaDealsEnabled) {
        $megaDealDAL = new MegaDealDAL();
        $megaDeals = $megaDealDAL->getActiveDeals();
    }
} catch (Exception $e) {}
?>

<style>
/* ===== HOME PAGE - VAANAKAM NAVY BLUE + GREEN THEME ===== */
:root { --blue-dark: #0A1C2A; --blue-primary: #0F2B48; --blue-mid: #16A34A; --blue-light: #DCFCE7; --blue-accent: #22C55E; --light-bg: #F0FDF4; --white: #ffffff; --text-dark: #0F2B48; --text-gray: #64748b; --gold: #16A34A; }

/* Banner Section */
.home-banner { position: relative; overflow: visible; background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 50%, #BBF7D0 100%); width: 100%; padding-bottom: clamp(90px, 11vw, 120px); }
.banner-viewport { width: 100%; overflow: hidden; position: relative; }
.banner-slider { display: flex; align-items: flex-start; width: 100%; transition: transform 0.5s ease; will-change: transform; }
.banner-slide { flex: 0 0 100%; flex-shrink: 0; position: relative; width: 100%; display: block; line-height: 0; }
.banner-slide img { width: 100%; height: auto; max-height: none; min-height: 0; display: block; }

.banner-dots { position: absolute; bottom: clamp(118px, 13vw, 142px); left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 5; }
.banner-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(22,163,74,0.2); cursor: pointer; transition: all 0.3s; }
.banner-dot.active { background: var(--blue-primary); width: 28px; border-radius: 5px; }
.banner-arrows { position: absolute; top: 50%; width: 100%; display: flex; justify-content: space-between; padding: 0 16px; transform: translateY(-50%); z-index: 5; pointer-events: none; }
.banner-arrow { width: 40px; height: 40px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px; color: var(--blue-primary); pointer-events: all; transition: all 0.2s; box-shadow: 0 3px 12px rgba(0,0,0,0.1); }
.banner-arrow:hover { background: var(--blue-primary); color: #fff; }

/* Category Icon Bar - overlaps banner bottom, responsive all screens */
.category-icon-bar-section {
    position: relative;
    z-index: 25;
    margin-top: clamp(-115px, -13vw, -150px);
    margin-bottom: clamp(24px, 3vw, 40px);
    pointer-events: none;
    padding: 0 clamp(12px, 2vw, 0);
}
.category-icon-bar-section .container {
    pointer-events: auto;
    max-width: 1280px;
    padding-left: clamp(12px, 2vw, 20px);
    padding-right: clamp(12px, 2vw, 20px);
}
.category-icon-bar {
    background: #fff;
    border-radius: clamp(16px, 2vw, 22px);
    box-shadow: 0 10px 36px rgba(22, 163, 74, 0.1), 0 2px 10px rgba(0, 0, 0, 0.04);
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: stretch;
    justify-content: space-between;
    padding: clamp(18px, 2.5vw, 28px) clamp(4px, 1vw, 12px);
    min-height: clamp(96px, 12vw, 112px);
    border: 1px solid #eee;
    gap: 0;
}
.category-icon-item {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #0F2B48;
    padding: clamp(6px, 1vw, 10px) clamp(4px, 0.8vw, 8px);
    border-right: 1px solid #e8e8e8;
    transition: all 0.25s;
    min-width: 0;
}
.category-icon-item:last-child {
    border-right: none;
}
.category-icon-item:hover {
    transform: translateY(-2px);
}
.category-icon-item:hover .category-icon-circle i {
    color: #16A34A;
}
.category-icon-item:hover .category-icon-label {
    color: #0F2B48;
}
.category-icon-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: clamp(8px, 1.2vw, 12px);
    flex-shrink: 0;
}
.category-icon-circle i {
    font-size: clamp(22px, 2.4vw, 30px);
    color: #16A34A;
    line-height: 1;
    transition: color 0.25s;
}
.category-icon-label {
    font-size: clamp(9px, 0.95vw, 11px);
    font-weight: 700;
    text-align: center;
    line-height: 1.35;
    color: #0F2B48;
    transition: color 0.25s;
    padding: 0 clamp(2px, 0.5vw, 6px);
    width: 100%;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
}
.category-icon-label .label-short { display: none; }
.category-icon-label .label-full { display: block; }

/* Large desktop */
@media (min-width: 1200px) {
    .category-icon-label { font-size: 11px; }
    .category-icon-circle i { font-size: 30px; }
}

/* Medium desktop */
@media (max-width: 1199px) and (min-width: 992px) {
    .category-icon-label { font-size: 10px; }
    .category-icon-circle i { font-size: 26px; }
    .category-icon-bar { padding: 22px 4px; min-height: 104px; }
}

/* Tablet — single row, equal columns */
@media (max-width: 991px) and (min-width: 576px) {
    .category-icon-bar-section { margin-top: -108px; }
    .category-icon-bar {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        padding: 18px 2px;
        min-height: 98px;
    }
    .category-icon-item {
        flex: 1 1 0;
        min-width: 0;
        padding: 8px 3px;
        border-right: 1px solid #e8e8e8;
        border-bottom: none;
    }
    .category-icon-item:last-child { border-right: none; }
    .category-icon-circle i { font-size: 24px; }
    .category-icon-label { font-size: 9px; line-height: 1.25; }
    .category-icon-label .label-full { display: none; }
    .category-icon-label .label-short { display: block; }
}

/* Mobile — single row, short labels */
@media (max-width: 575px) {
    .category-icon-bar-section {
        margin-top: -92px;
        margin-bottom: 28px;
        padding: 0 8px;
    }
    .category-icon-bar-section .container {
        padding-left: 0;
        padding-right: 0;
    }
    .category-icon-bar {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        padding: 14px 0;
        min-height: 86px;
        border-radius: 14px;
    }
    .category-icon-item {
        flex: 1 1 0;
        min-width: 0;
        padding: 6px 2px;
        border-right: 1px solid #e8e8e8;
        border-bottom: none;
    }
    .category-icon-item:last-child { border-right: none; }
    .category-icon-circle { margin-bottom: 6px; }
    .category-icon-circle i { font-size: 20px; }
    .category-icon-label { font-size: 8px; line-height: 1.25; padding: 0 1px; }
    .category-icon-label .label-full { display: none; }
    .category-icon-label .label-short { display: block; }
}

/* Very small phones — still one row */
@media (max-width: 360px) {
    .category-icon-bar { padding: 12px 0; min-height: 78px; }
    .category-icon-item { padding: 4px 1px; }
    .category-icon-circle i { font-size: 18px; }
    .category-icon-label { font-size: 7px; }
}

/* Brands Strip */
.brands-strip { padding: 50px 0 30px; background: #F0FDF4; }
.brands-card { background: #fff; border: 1px solid #eee; border-radius: 14px; padding: 24px 30px; box-shadow: 0 2px 12px rgba(0,0,0,0.03); }
.brands-strip-title { font-size: 14px; font-weight: 700; color: var(--text-dark); margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; }
.brands-strip-title a { font-size: 12px; color: var(--blue-primary); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 4px; }
.brands-grid { display: flex; align-items: center; justify-content: center; }
.brands-all-img { width: 100%; max-width: 100%; height: auto; object-fit: contain; }

/* Categories Strip */
.home-categories { padding: 40px 0; background: #F0FDF4; }
.home-section-title { font-size: 1.2rem; font-weight: 700; color: var(--text-dark); margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; }
.home-section-title .section-title-label { display: flex; align-items: center; gap: 12px; }
.home-section-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(22, 163, 74, 0.12);
}
.home-section-icon.collections {
    background: linear-gradient(135deg, #DCFCE7 0%, #BBF7D0 100%);
    color: #16A34A;
}
.home-section-icon.popular {
    background: linear-gradient(135deg, #DCFCE7 0%, #BBF7D0 100%);
    color: #15803D;
    box-shadow: 0 4px 14px rgba(22, 163, 74, 0.15);
}
.home-section-title a { font-size: 13px; color: var(--blue-primary); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 5px; }
.home-section-title a:hover { color: var(--blue-mid); }
.categories-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
.category-card { display: block; text-decoration: none; border-radius: 16px; overflow: hidden; position: relative; height: 260px; transition: all 0.3s; }
.category-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,0.12); }
.category-card-image { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; transition: transform 0.4s; }
.category-card:hover .category-card-image { transform: scale(1.05); }
.category-card-icon {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(145deg, #DCFCE7 0%, #F0FDF4 55%, #fff 100%);
}
.category-card-icon i {
    font-size: clamp(44px, 8vw, 58px);
    color: #16A34A;
    opacity: 0.9;
    filter: drop-shadow(0 6px 16px rgba(22, 163, 74, 0.15));
}
.category-card-bottom { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; background: linear-gradient(transparent, rgba(0,0,0,0.7)); z-index: 2; }
.category-card-info { }
.category-card-name { font-size: 16px; font-weight: 700; color: #fff; display: block; margin-bottom: 4px; }
.category-card-desc { display: none; }
.category-card-link { font-size: 12px; color: rgba(255,255,255,0.85); font-weight: 500; display: inline-flex; align-items: center; gap: 5px; }
.category-card-arrow { display: none; }
@media (max-width: 992px) { .categories-grid { grid-template-columns: repeat(2, 1fr); } .category-card { height: 220px; } }
@media (max-width: 480px) { .categories-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; } .category-card { height: 200px; border-radius: 12px; } .category-card-image { height: 100%; object-fit: cover; object-position: center; } .category-card-name { font-size: 14px; } .category-card-bottom { padding: 14px; } }

/* Best Sellers */
.home-products { padding: 45px 0; background: #fff; }

/* Mega Deals */
.home-mega-deals { padding: 45px 0; background: linear-gradient(135deg, #F0FDF4 0%, #fff 50%, #DCFCE7 100%); }
.mega-deals-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.mega-deals-header .mega-title { display: flex; align-items: center; gap: 10px; }
.mega-deals-header .mega-title h2 { font-size: 1.2rem; font-weight: 700; color: #0F2B48; }
.mega-deals-header .mega-title .fire-icon { font-size: 22px; color: #ef4444; animation: pulse 1.5s infinite; }
@keyframes pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.15); } }
.mega-deals-header .mega-badge { background: #ef4444; color: #fff; font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px; }
.mega-deals-header a { font-size: 13px; color: var(--blue-primary); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 5px; }
.mega-deals-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
.mega-deal-card { background: #fff; border: 1px solid #eee; border-radius: 12px; overflow: hidden; transition: all 0.3s; position: relative; display: flex; flex-direction: column; }
.mega-deal-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,0.08); border-color: #ef4444; }
.mega-deal-img-wrap { position: relative; background: #f8f9fb; padding: 16px; }
.mega-deal-img-wrap img { width: 100%; height: 160px; object-fit: contain; }
.mega-deal-img-wrap .deal-discount { position: absolute; top: 10px; left: 10px; background: #ef4444; color: #fff; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px; }
.mega-deal-body { padding: 14px; flex: 1; display: flex; flex-direction: column; }
.mega-deal-category { font-size: 10px; color: var(--blue-primary); font-weight: 600; text-transform: uppercase; margin-bottom: 4px; }
.mega-deal-title { font-size: 13px; font-weight: 600; color: #0F2B48; margin-bottom: 8px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-decoration: none; }
.mega-deal-title:hover { color: var(--blue-primary); }
.mega-deal-pricing { margin-top: auto; display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
.mega-deal-pricing .deal-price { font-size: 16px; font-weight: 800; color: #ef4444; }
.mega-deal-pricing .original-price { font-size: 12px; color: #bbb; text-decoration: line-through; }
.mega-deal-btn { display: flex; align-items: center; justify-content: center; gap: 6px; padding: 10px; background: #ef4444; color: #fff; border: none; border-radius: 8px; font-size: 11px; font-weight: 600; cursor: pointer; transition: all 0.2s; width: 100%; font-family: 'Poppins', sans-serif; }
.mega-deal-btn:hover { background: #dc2626; }
@media (max-width: 992px) { .mega-deals-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px) { .mega-deals-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; } .mega-deal-img-wrap img { height: 120px; } }
.products-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }

/* ===== Skincare split promo ===== */
.skincare-split {
    padding: clamp(40px, 6vw, 64px) 0;
    background: #fff;
}
.skincare-split-wrap {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    min-height: clamp(420px, 42vw, 520px);
    border-radius: clamp(16px, 2.5vw, 24px);
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 46, 120, 0.1);
}
.skincare-split-content {
    padding: clamp(32px, 5vw, 52px) clamp(28px, 4vw, 48px);
    background: #16A34A;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    overflow: hidden;
}
.skincare-split-content::before {
    content: '';
    position: absolute;
    width: 280px;
    height: 280px;
    top: -80px;
    right: -60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.06);
    pointer-events: none;
}
.skincare-split-content::after {
    content: '';
    position: absolute;
    width: 180px;
    height: 180px;
    bottom: -40px;
    left: -40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.04);
    pointer-events: none;
}
.skincare-split-tag {
    position: relative;
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.75);
    margin-bottom: 16px;
}
.skincare-split-tag::before {
    content: '';
    display: inline-block;
    width: 28px;
    height: 2px;
    background: rgba(255, 255, 255, 0.5);
    vertical-align: middle;
    margin-right: 12px;
}
.skincare-split-content h2 {
    position: relative;
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.03em;
    margin-bottom: 16px;
}
.skincare-split-lead {
    position: relative;
    font-size: clamp(14px, 1.8vw, 15px);
    color: rgba(255, 255, 255, 0.82);
    line-height: 1.75;
    margin-bottom: 28px;
    max-width: 420px;
}
.skincare-split-list {
    position: relative;
    list-style: none;
    margin: 0 0 32px;
    padding: 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px 20px;
}
.skincare-split-list li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.95);
}
.skincare-split-list li i {
    width: 28px;
    height: 28px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    font-size: 11px;
}
.skincare-split-btns {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
.skincare-split-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 26px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    border-radius: 8px;
    transition: transform 0.2s, background 0.2s, color 0.2s;
}
.skincare-split-btn--fill {
    background: #fff;
    color: #16A34A;
}
.skincare-split-btn--fill:hover {
    transform: translateY(-2px);
    color: #0F2B48;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}
.skincare-split-btn--line {
    background: transparent;
    color: #fff;
    border: 1.5px solid rgba(255, 255, 255, 0.45);
}
.skincare-split-btn--line:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #fff;
    color: #fff;
}
.skincare-split-media {
    position: relative;
    background: #f0f4fa;
    min-height: 280px;
}
.skincare-split-media img {
    width: 100%;
    height: 100%;
    min-height: inherit;
    object-fit: cover;
    object-position: center top;
    display: block;
}
.skincare-split-trust {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 1px;
    margin-top: 1px;
    background: #e8eef8;
    border-radius: 0 0 clamp(16px, 2.5vw, 24px) clamp(16px, 2.5vw, 24px);
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0, 46, 120, 0.06);
}
.skincare-split-trust a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 20px;
    background: #fff;
    text-decoration: none;
    color: inherit;
    transition: background 0.2s;
}
.skincare-split-trust a:hover {
    background: #f8fafd;
}
.skincare-split-trust i {
    font-size: 18px;
    color: #16A34A;
    flex-shrink: 0;
}
.skincare-split-trust strong {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.3;
}
.skincare-split-trust span {
    font-size: 10px;
    color: #94a3b8;
    line-height: 1.35;
}
@media (max-width: 992px) {
    .skincare-split-wrap {
        grid-template-columns: 1fr;
        min-height: 0;
    }
    .skincare-split-media {
        order: -1;
        min-height: 280px;
        max-height: 360px;
    }
    .skincare-split-trust {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}
@media (max-width: 576px) {
    .skincare-split-list {
        grid-template-columns: 1fr;
    }
    .skincare-split-btns {
        flex-direction: column;
    }
    .skincare-split-btn {
        width: 100%;
    }
    .skincare-split-trust {
        grid-template-columns: 1fr;
    }
}

/* Trust Strip */
.trust-strip { background: var(--light-bg); border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 24px 0; }
.trust-strip-grid { display: flex; justify-content: center; gap: 50px; flex-wrap: nowrap; }
.trust-strip-item { display: flex; align-items: center; gap: 10px; }
.trust-strip-item i { font-size: 24px; color: var(--blue-primary); }
.trust-strip-item div strong { display: block; font-size: 12px; color: var(--text-dark); font-weight: 700; }
.trust-strip-item div span { font-size: 10px; color: #777; }

/* About Preview — editorial overlap layout */
.home-about {
    padding: clamp(32px, 5vw, 48px) 0;
    background: #f4f7fc;
    position: relative;
    overflow: hidden;
}
.home-about::before {
    content: '';
    position: absolute;
    width: 520px;
    height: 520px;
    top: -180px;
    right: -120px;
    background: radial-gradient(circle, rgba(22, 163, 74, 0.07) 0%, transparent 68%);
    pointer-events: none;
}
.home-about-shell {
    position: relative;
    display: grid;
    grid-template-columns: 1fr;
    gap: 0;
}
.home-about-panel {
    position: relative;
    z-index: 3;
    padding: 0 4px;
    display: flex;
    min-height: 0;
}
.home-about-panel-inner {
    background: #fff;
    border-radius: 18px;
    padding: clamp(20px, 3vw, 26px);
    box-shadow: 0 16px 40px rgba(0, 41, 104, 0.08);
    border: 1px solid rgba(22, 163, 74, 0.08);
    width: 100%;
    display: flex;
    flex-direction: column;
}
.home-about-copy {
    flex-shrink: 0;
}
.home-about-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #16A34A;
    margin-bottom: 10px;
}
.home-about-tag::before {
    content: '';
    width: 28px;
    height: 2px;
    background: #16A34A;
    border-radius: 2px;
}
.home-about-panel h2 {
    font-size: clamp(1.35rem, 3vw, 1.75rem);
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
    letter-spacing: -0.02em;
    margin: 0 0 10px;
}
.home-about-panel h2 em {
    font-style: normal;
    color: #16A34A;
}
.home-about-lead {
    font-size: 14px;
    color: #334155;
    line-height: 1.65;
    margin: 0 0 8px;
    font-weight: 500;
}
.home-about-text {
    font-size: 13px;
    color: #64748b;
    line-height: 1.65;
    margin: 0 0 16px;
}
.home-about-facts {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 8px;
    margin-bottom: 12px;
    flex: 1;
    align-content: center;
}
.home-about-fact {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 12px;
    background: linear-gradient(135deg, #F8FAFF 0%, #DCFCE7 100%);
    border: 1px solid #DCFCE7;
    min-width: 0;
}
.home-about-fact i {
    width: 32px;
    height: 32px;
    border-radius: 10px;
    background: #16A34A;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.18);
}
.home-about-fact div {
    min-width: 0;
}
.home-about-fact strong {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 2px;
    line-height: 1.3;
}
.home-about-fact span {
    display: block;
    font-size: 11px;
    color: #64748b;
    line-height: 1.4;
}
.home-about-cta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: auto;
    flex-shrink: 0;
}
.home-about-cta a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}
.home-about-cta .btn-main {
    background: #16A34A;
    color: #fff;
    box-shadow: 0 10px 24px rgba(22, 163, 74, 0.28);
}
.home-about-cta .btn-main:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 30px rgba(22, 163, 74, 0.34);
    color: #fff;
}
.home-about-cta .btn-ghost {
    background: transparent;
    color: #16A34A;
    border: 1.5px solid #F5E6B8;
}
.home-about-cta .btn-ghost:hover {
    background: #DCFCE7;
}
.home-about-photo {
    position: relative;
    height: 220px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12);
}
.home-about-photo img {
    width: 100%;
    height: 100%;
    min-height: 0;
    object-fit: cover;
    object-position: center top;
    display: block;
}
.home-about-photo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(15, 61, 36, 0.65) 0%, rgba(10, 40, 22, 0.88) 100%);
    pointer-events: none;
}
.home-about-photo-meta {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
    padding: 14px 16px;
    color: #fff;
}
.home-about-photo-meta p {
    margin: 0;
    font-size: 12px;
    line-height: 1.5;
    color: rgba(255, 255, 255, 0.92);
    max-width: 420px;
    display: flex;
    align-items: flex-start;
    gap: 8px;
}
.home-about-photo-meta p i {
    margin-top: 2px;
    flex-shrink: 0;
    font-size: 13px;
}
.home-about-strip {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 0;
    margin-top: 18px;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #DCFCE7;
    overflow: hidden;
    box-shadow: 0 12px 32px rgba(15, 43, 72, 0.06);
}
.home-about-strip-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border-right: 1px solid #EEF2F8;
    min-width: 0;
}
.home-about-strip-item:last-child { border-right: none; }
.home-about-strip-item i {
    color: #16A34A;
    font-size: 18px;
    flex-shrink: 0;
}
.home-about-strip-item strong {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 2px;
}
.home-about-strip-item span {
    display: block;
    font-size: 11px;
    color: #64748b;
    line-height: 1.35;
}
@media (min-width: 992px) {
    .home-about-shell {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 24px;
        align-items: stretch;
    }
    .home-about-panel,
    .home-about-photo {
        height: 380px;
        min-height: 380px;
        max-height: 380px;
    }
    .home-about-panel {
        margin-bottom: 0;
        padding: 0;
    }
    .home-about-panel-inner {
        padding: 22px 24px;
        height: 100%;
        min-height: 0;
    }
    .home-about-photo img {
        height: 100%;
    }
}
@media (max-width: 991px) {
    .home-about-shell {
        gap: 20px;
    }
    .home-about-panel {
        margin-bottom: 0;
        order: 2;
    }
    .home-about-photo {
        order: 1;
    }
    .home-about-strip {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    .home-about-strip-item:nth-child(2) { border-right: none; }
    .home-about-strip-item:nth-child(-n+2) { border-bottom: 1px solid #EEF2F8; }
}
@media (max-width: 576px) {
    .home-about-facts {
        grid-template-columns: 1fr;
    }
    .home-about-cta {
        flex-direction: column;
    }
    .home-about-cta a {
        width: 100%;
        justify-content: center;
    }
    .home-about-strip {
        grid-template-columns: 1fr;
    }
    .home-about-strip-item {
        border-right: none;
        border-bottom: 1px solid #EEF2F8;
    }
    .home-about-strip-item:last-child {
        border-bottom: none;
    }
}

/* Testimonials */
.home-testimonials { padding: 50px 0; background: var(--light-bg); }
.testimonials-slider-wrap { position: relative; max-width: 700px; margin: 0 auto; }
.testimonials-slider { position: relative; width: 100%; min-height: 280px; }
.testimonial-card {
    background: #fff; border: 1px solid #eee; border-radius: 16px; padding: 36px; text-align: center;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04); position: absolute; top: 0; left: 0; width: 100%;
    min-height: 260px; display: flex; flex-direction: column; justify-content: center;
    opacity: 0; visibility: hidden; pointer-events: none;
    transition: opacity 0.35s ease, visibility 0.35s ease;
    box-sizing: border-box;
}
.testimonial-card.active {
    opacity: 1; visibility: visible; pointer-events: auto;
}
.testimonial-card::before { content: '\201C'; position: absolute; top: 14px; left: 28px; font-size: 4rem; color: var(--blue-light); font-family: Georgia, serif; line-height: 1; }
.testimonial-stars { color: #f5a623; font-size: 16px; margin-bottom: 16px; letter-spacing: 2px; }
.testimonial-text {
    font-size: 14px; color: #444; line-height: 1.8; margin-bottom: 20px; font-style: italic;
    position: relative; z-index: 1;
    display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical;
    overflow: hidden; min-height: calc(1.8em * 3);
}
.testimonial-divider { width: 40px; height: 2px; background: var(--blue-primary); margin: 0 auto 16px; border-radius: 2px; }
.testimonial-author { display: flex; align-items: center; gap: 12px; justify-content: center; }
.testimonial-avatar { width: 42px; height: 42px; border-radius: 50%; background: var(--blue-primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 700; flex-shrink: 0; }
.testimonial-author-info h4 { font-size: 13px; font-weight: 700; color: var(--text-dark); text-align: left; }
.testimonial-author-info span { font-size: 11px; color: #888; }
.testimonials-nav { display: flex; justify-content: center; gap: 12px; margin-top: 20px; }
.testimonial-arrow { width: 38px; height: 38px; border-radius: 50%; border: 1.5px solid #ddd; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 13px; color: var(--blue-primary); transition: all 0.2s; }
.testimonial-arrow:hover { background: var(--blue-primary); color: #fff; border-color: var(--blue-primary); }

/* Responsive */
@media (max-width: 992px) {
    .products-grid { grid-template-columns: repeat(3, 1fr); }
    .home-about-grid { grid-template-columns: 1fr; }
    .brands-grid { gap: 20px; }
    .trust-strip-grid { gap: 24px; }
}

@media (max-width: 768px) {
    .products-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    .categories-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .category-card-image { height: 100%; object-fit: cover; object-position: center; }
    .trust-strip-grid { gap: 16px; overflow-x: auto; flex-wrap: nowrap; padding: 0 10px; scrollbar-width: none; }
    .trust-strip-grid::-webkit-scrollbar { display: none; }
    .trust-strip-item { flex-shrink: 0; }
    .trust-strip-item.hide-mobile { display: none; }
    .banner-dots { display: none; }
    .banner-arrows { display: none; }
    .brands-grid { gap: 16px; }
    .brand-item { font-size: 14px; }
    .home-about-polaroid { max-width: 240px; }
    .brands-all-img { max-height: none; width: 100%; height: auto; }
    .brands-card { padding: 16px 14px; }
}
</style>

<!-- Banner Slider -->
<section class="home-banner">
    <?php if (!empty($banners)): ?>
    <div class="banner-viewport">
    <div class="banner-slider" id="bannerSlider">
        <?php foreach ($banners as $idx => $banner): ?>
        <div class="banner-slide">
            <img src="<?php echo htmlspecialchars(media_image_url($banner['image'])); ?>"
                 alt="<?php echo htmlspecialchars(translate_text($banner['title'] ?? '')); ?>"
                 <?php if ($idx === 0): ?>fetchpriority="high" loading="eager" decoding="sync"<?php else: ?>loading="lazy" decoding="async"<?php endif; ?>>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="banner-dots" id="bannerDots">
        <?php foreach ($banners as $idx => $b): ?>
        <span class="banner-dot <?php echo $idx === 0 ? 'active' : ''; ?>" onclick="goToSlide(<?php echo $idx; ?>)"></span>
        <?php endforeach; ?>
    </div>
    <div class="banner-arrows">
        <span class="banner-arrow" onclick="prevSlide()"><i class="fas fa-chevron-left"></i></span>
        <span class="banner-arrow" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></span>
    </div>
    <?php else: ?>
    <div class="lumak-hero-fallback">
        <div class="container lumak-hero-grid">
            <div class="lumak-hero-text">
                <span class="lumak-hero-badge"><i class="fas fa-leaf"></i> <?php echo __t('pure_natural_badge'); ?></span>
                <h1><?php echo __t('hero_title_prefix'); ?> <span class="lumak-gradient"><?php echo __t('healthy_life'); ?></span></h1>
                <p><?php echo __t('hero_description'); ?></p>
                <div class="lumak-hero-btns">
                    <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-btn-primary"><?php echo __t('shop_fresh_groceries'); ?> <i class="fas fa-arrow-right"></i></a>
                    <a href="<?php echo BASE_URL; ?>about.php" class="lumak-btn-outline"><i class="fas fa-heart"></i> <?php echo __t('our_story'); ?></a>
                </div>
            </div>
            <div class="lumak-hero-image">
                <img src="<?php echo asset_image_url('assets/images/logo.png'); ?>" alt="Vaanakam Natural &amp; Organic Foods" style="width:100%; max-height:340px; object-fit:contain; filter:drop-shadow(0 15px 35px rgba(22,163,74,0.22));">
            </div>
        </div>
    </div>
    <style>
    .lumak-hero-fallback { padding: 50px 0 110px; min-height: 380px; background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 60%, #BBF7D0 100%); position: relative; overflow: hidden; }
    .lumak-hero-fallback::before { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at 20% 30%, rgba(22,163,74,0.08) 0%, transparent 50%), radial-gradient(circle at 80% 70%, rgba(34,197,94,0.1) 0%, transparent 40%); pointer-events: none; }
    .lumak-hero-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; position: relative; z-index: 1; }
    .lumak-hero-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(22,163,74,0.12); color: #15803D; font-size: 12px; font-weight: 600; padding: 6px 14px; border-radius: 20px; margin-bottom: 16px; }
    .lumak-hero-text h1 { font-size: 2.2rem; font-weight: 800; color: #0F2B48; line-height: 1.2; margin-bottom: 14px; }
    .lumak-gradient { color: #16A34A; }
    .lumak-hero-text p { font-size: 15px; color: #555; margin-bottom: 24px; line-height: 1.7; }
    .lumak-hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
    .lumak-btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; background: #16A34A; color: #ffffff; border-radius: 10px; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
    .lumak-btn-primary:hover { transform: translateY(-2px); background: #15803D; box-shadow: 0 8px 24px rgba(22,163,74,0.35); }
    .lumak-btn-outline { display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; background: #fff; color: #0F2B48; border: 2px solid #0F2B48; border-radius: 10px; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
    .lumak-btn-outline:hover { background: #0F2B48; color: #ffffff; }
    .lumak-hero-image img { width: 100%; max-height: 360px; object-fit: contain; filter: drop-shadow(0 20px 40px rgba(22,163,74,0.2)); }
    @media (max-width: 768px) { .lumak-hero-grid { grid-template-columns: 1fr; text-align: center; } .lumak-hero-btns { justify-content: center; } .lumak-hero-text h1 { font-size: 1.6rem; } }
    </style>
    <?php endif; ?>
</section>

<?php
$iconBarItems = [];
foreach ($categoryIconBarConfig as $cfg) {
    $slug = '';
    if (!empty($cfg['link'])) {
        $iconBarItems[] = [
            'name' => $cfg['name'],
            'short' => $cfg['short'] ?? $cfg['name'],
            'icon' => $cfg['icon'],
            'link' => $cfg['link'],
            'slug' => '',
        ];
        continue;
    }
    if (!empty($categories)) {
        foreach ($categories as $cat) {
            $catSlug = strtolower($cat['slug'] ?? '');
            $catName = strtolower($cat['name'] ?? '');
            foreach ($cfg['keywords'] as $kw) {
                if ($catSlug === $kw || strpos($catSlug, $kw) !== false || strpos($catName, str_replace('-', ' ', $kw)) !== false) {
                    $slug = $cat['slug'];
                    break 2;
                }
            }
        }
    }
    $iconBarItems[] = [
        'name' => $cfg['name'],
        'short' => $cfg['short'] ?? $cfg['name'],
        'icon' => $cfg['icon'],
        'slug' => $slug,
        'link' => '',
    ];
}
?>

<!-- Category Icon Bar (half over banner, half over content) -->
<div class="category-icon-bar-section">
    <div class="container">
        <div class="category-icon-bar">
            <?php foreach ($iconBarItems as $item):
                $href = !empty($item['link'])
                    ? BASE_URL . $item['link']
                    : (!empty($item['slug'])
                        ? BASE_URL . 'shop.php?category=' . htmlspecialchars($item['slug'])
                        : BASE_URL . 'shop.php');
            ?>
            <a href="<?php echo $href; ?>" class="category-icon-item">
                <div class="category-icon-circle"><i class="fas <?php echo $item['icon']; ?>"></i></div>
                <span class="category-icon-label">
                    <span class="label-full"><?php echo htmlspecialchars(translate_text($item['name'])); ?></span>
                    <span class="label-short"><?php echo htmlspecialchars(translate_text($item['short'] ?? $item['name'])); ?></span>
                </span>
            </a>
            <?php endforeach; ?>
            </div>
            </div>
        </div>

<!-- Weekly Deals -->
<?php if ($megaDealsEnabled && !empty($megaDeals)): ?>
<section class="home-mega-deals">
    <div class="container">
        <div class="mega-deals-header">
            <div class="mega-title">
                <i class="fas fa-fire fire-icon"></i>
                <h2><?php echo __t('weekly_deals'); ?></h2>
                <span class="mega-badge"><?php echo __t('hot'); ?></span>
            </div>
            <a href="<?php echo BASE_URL; ?>shop.php?deals=hot-deals"><?php echo __t('view_all'); ?> <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="mega-deals-grid">
            <?php foreach ($megaDeals as $deal): ?>
            <div class="mega-deal-card">
                <div class="mega-deal-img-wrap">
                    <a href="<?php echo BASE_URL; ?>product.php?slug=<?php echo htmlspecialchars($deal['slug']); ?>">
                        <?php if ($deal['image']): ?>
                        <img src="<?php echo htmlspecialchars(media_image_url($deal['image'])); ?>" alt="<?php echo htmlspecialchars(translate_product_name($deal['name'], $deal['name_ta'] ?? null)); ?>" loading="lazy">
                        <?php else: ?>
                        <img src="<?php echo asset_image_url('assets/images/logo.png'); ?>" alt="" style="opacity:0.3;">
                        <?php endif; ?>
                    </a>
                    <span class="deal-discount"><?php echo round((($deal['original_price'] - $deal['deal_price']) / $deal['original_price']) * 100); ?>% OFF</span>
                </div>
                <div class="mega-deal-body">
                    <span class="mega-deal-category"><?php echo htmlspecialchars(translate_text($deal['category_name'] ?? '', $deal['category_name_ta'] ?? null)); ?></span>
                    <a href="<?php echo BASE_URL; ?>product.php?slug=<?php echo htmlspecialchars($deal['slug']); ?>" class="mega-deal-title">
                        <?php echo htmlspecialchars(translate_product_name($deal['name'], $deal['name_ta'] ?? null)); ?>
                    </a>
                    <div class="mega-deal-pricing">
                        <span class="deal-price"><?php echo format_price($deal['deal_price']); ?></span>
                        <span class="original-price"><?php echo format_price($deal['original_price']); ?></span>
                    </div>
                    <form action="<?php echo BASE_URL; ?>controllers/CartController.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?php echo $deal['product_id']; ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="redirect_url" value="<?php echo BASE_URL; ?>">
                        <button type="submit" class="mega-deal-btn"><i class="fas fa-shopping-cart"></i> <?php echo __t('add_to_cart'); ?></button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Popular Categories -->
<section class="home-categories">
    <div class="container">
        <div class="home-section-title">
            <span class="section-title-label">
                <span class="home-section-icon collections" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                <?php echo __t('shop_by_collection'); ?>
            </span>
            <a href="<?php echo BASE_URL; ?>shop.php"><?php echo __t('view_all_categories'); ?> <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="categories-grid">
            <?php if (!empty($categories)): ?>
                <?php foreach (array_slice($categories, 0, 4) as $cat):
                    $catIcon = resolve_category_icon($cat['name'] ?? '', $cat['slug'] ?? '', $categoryIconBarConfig);
                ?>
                <a href="<?php echo BASE_URL; ?>shop.php?category=<?php echo htmlspecialchars($cat['slug']); ?>" class="category-card">
                    <?php if (!empty($cat['image'])): ?>
                    <img src="<?php echo htmlspecialchars(media_image_url($cat['image'])); ?>" alt="<?php echo htmlspecialchars($cat['name']); ?>" class="category-card-image" loading="lazy">
                    <?php else: ?>
                    <div class="category-card-icon"><i class="fas <?php echo htmlspecialchars($catIcon); ?>"></i></div>
                    <?php endif; ?>
                    <div class="category-card-bottom">
                        <div class="category-card-info">
                            <span class="category-card-name"><?php echo htmlspecialchars(translate_text($cat['name'], $cat['name_ta'] ?? null)); ?></span>
                            <span class="category-card-link"><?php echo __t('shop_now'); ?> <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <a href="<?php echo BASE_URL; ?>shop.php" class="category-card">
                    <div class="category-card-icon"><i class="fas fa-bottle-droplet"></i></div>
                    <div class="category-card-bottom">
                        <div class="category-card-info">
                            <span class="category-card-name">Pure Oils</span>
                            <span class="category-card-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
                <a href="<?php echo BASE_URL; ?>shop.php" class="category-card">
                    <div class="category-card-icon"><i class="fas fa-wheat-awn"></i></div>
                    <div class="category-card-bottom">
                        <div class="category-card-info">
                            <span class="category-card-name">Rice &amp; Grains</span>
                            <span class="category-card-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
                <a href="<?php echo BASE_URL; ?>shop.php" class="category-card">
                    <div class="category-card-icon"><i class="fas fa-seedling"></i></div>
                    <div class="category-card-bottom">
                        <div class="category-card-info">
                            <span class="category-card-name">Cashews &amp; Nuts</span>
                            <span class="category-card-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
                <a href="<?php echo BASE_URL; ?>shop.php" class="category-card">
                    <div class="category-card-icon"><i class="fas fa-mortar-pestle"></i></div>
                    <div class="category-card-bottom">
                        <div class="category-card-info">
                            <span class="category-card-name">Spices &amp; Masala</span>
                            <span class="category-card-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Best Sellers -->
<section class="home-products">
    <div class="container">
        <div class="home-section-title">
            <span class="section-title-label">
                <span class="home-section-icon popular" aria-hidden="true"><i class="fas fa-fire"></i></span>
                <?php echo __t('popular_picks'); ?>
            </span>
            <a href="<?php echo BASE_URL; ?>shop.php?view=all-products"><?php echo __t('view_all_products'); ?> <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="products-grid">
            <?php
            $cardContext = ezymart_build_product_card_context($featuredProducts);
            foreach ($featuredProducts as $prod):
                $cardBadge = !empty($prod['featured']) ? 'bestseller' : null;
                include __DIR__ . '/partials/product-card.php';
            endforeach;
            ?>
        </div>
        <?php if (!empty($featuredProducts)): ?>
        <?php require_once __DIR__ . '/partials/product-quick-view.php'; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Natural & Organic Foods -->
<section class="skincare-split" aria-label="Natural groceries and organic foods">
    <div class="container">
        <div class="skincare-split-wrap">
            <div class="skincare-split-content">
                <span class="skincare-split-tag"><i class="fas fa-leaf"></i> <?php echo __t('split_tag'); ?></span>
                <h2><?php echo __t('split_title'); ?></h2>
                <p class="skincare-split-lead"><?php echo __t('split_desc'); ?></p>
                <ul class="skincare-split-list">
                    <li><i class="fas fa-check"></i> <?php echo __t('split_bullet_1'); ?></li>
                    <li><i class="fas fa-check"></i> <?php echo __t('split_bullet_2'); ?></li>
                    <li><i class="fas fa-check"></i> <?php echo __t('split_bullet_3'); ?></li>
                    <li><i class="fas fa-check"></i> <?php echo __t('split_bullet_4'); ?></li>
                </ul>
                <div class="skincare-split-btns">
                    <a href="<?php echo BASE_URL; ?>shop.php" class="skincare-split-btn skincare-split-btn--fill">
                        <i class="fas fa-shopping-bag"></i> <?php echo __t('shop_groceries'); ?>
                    </a>
                    <a href="<?php echo BASE_URL; ?>about.php" class="skincare-split-btn skincare-split-btn--line">
                        <?php echo __t('our_story'); ?>
                    </a>
                    <a href="<?php echo BASE_URL; ?>contact.php" class="skincare-split-btn skincare-split-btn--line">
                        <i class="fas fa-phone-alt"></i> <?php echo __t('contact_us'); ?>
                    </a>
                </div>
            </div>
            <div class="skincare-split-media" style="padding:0; margin:0; overflow:hidden; background:transparent;">
                <img src="<?php echo asset_image_url('assets/images/imagenew.webp'); ?>" alt="Vaanakam Natural &amp; Pure Foods" style="width:100%; height:100%; min-height:100%; object-fit:cover; object-position:center center; display:block;" loading="lazy">
            </div>
        </div>
        <div class="skincare-split-trust">
            <a href="<?php echo BASE_URL; ?>shop.php">
                <i class="fas fa-leaf"></i>
                <div>
                    <strong><?php echo __t('trust_pure_title'); ?></strong>
                    <span><?php echo __t('trust_pure_desc'); ?></span>
                </div>
            </a>
            <a href="<?php echo BASE_URL; ?>shop.php">
                <i class="fas fa-bottle-droplet"></i>
                <div>
                    <strong><?php echo __t('trust_oils_title'); ?></strong>
                    <span><?php echo __t('trust_oils_desc'); ?></span>
                </div>
            </a>
            <a href="<?php echo BASE_URL; ?>shop.php">
                <i class="fas fa-truck"></i>
                <div>
                    <strong><?php echo __t('trust_delivery_title'); ?></strong>
                    <span><?php echo __t('trust_delivery_desc'); ?></span>
                </div>
            </a>
            <a href="<?php echo BASE_URL; ?>shop.php">
                <i class="fas fa-shield-heart"></i>
                <div>
                    <strong><?php echo __t('trust_quality_title'); ?></strong>
                    <span><?php echo __t('trust_quality_desc'); ?></span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- About Preview -->
<section class="home-about">
    <div class="container">
        <div class="home-about-shell">
            <div class="home-about-panel">
                <div class="home-about-panel-inner">
                    <div class="home-about-copy">
                        <p class="home-about-tag"><?php echo STORE_OWNER; ?></p>
                        <h2><?php echo __t('about_us'); ?> - <em><?php echo SITE_NAME; ?></em></h2>
                        <p class="home-about-lead"><?php echo __t('hero_description'); ?></p>
                    </div>
                    <div class="home-about-facts">
                        <div class="home-about-fact">
                            <i class="fas fa-leaf"></i>
                            <div>
                                <strong><?php echo __t('trust_pure_title'); ?></strong>
                                <span><?php echo __t('trust_pure_desc'); ?></span>
                            </div>
                        </div>
                        <div class="home-about-fact">
                            <i class="fas fa-truck"></i>
                            <div>
                                <strong><?php echo __t('trust_delivery_title'); ?></strong>
                                <span><?php echo __t('trust_delivery_desc'); ?></span>
                            </div>
                        </div>
                        <div class="home-about-fact">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <strong><?php echo STORE_PHONE_1; ?></strong>
                                <span><?php echo STORE_PHONE_2; ?></span>
                            </div>
                        </div>
                        <div class="home-about-fact">
                            <i class="fas fa-globe"></i>
                            <div>
                                <strong><?php echo STORE_DOMAIN; ?></strong>
                                <span><?php echo __t('tagline'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="home-about-cta">
                        <a href="<?php echo BASE_URL; ?>shop.php" class="btn-main"><i class="fas fa-shopping-bag"></i> <?php echo __t('explore_products'); ?></a>
                        <a href="<?php echo BASE_URL; ?>about.php" class="btn-ghost"><i class="fas fa-arrow-right"></i> <?php echo __t('our_story'); ?></a>
                    </div>
                </div>
            </div>
            <div class="home-about-photo">
                <?php echo render_asset_image('assets/images/pic1..png', [
                    'alt' => 'Vaanakam Store',
                    'width' => 720,
                    'height' => 360,
                    'loading' => 'lazy',
                    'decoding' => 'async',
                ]); ?>
                <div class="home-about-photo-overlay" aria-hidden="true"></div>
                <div class="home-about-photo-meta">
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo STORE_LOCATION; ?></p>
                </div>
            </div>
        </div>
        <div class="home-about-strip">
            <div class="home-about-strip-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <strong><?php echo __t('our_location'); ?></strong>
                    <span><?php echo STORE_LOCATION; ?></span>
                </div>
            </div>
            <div class="home-about-strip-item">
                <i class="fas fa-seedling"></i>
                <div>
                    <strong><?php echo __t('trust_pure_title'); ?></strong>
                    <span><?php echo __t('trust_pure_desc'); ?></span>
                </div>
            </div>
            <div class="home-about-strip-item">
                <i class="fas fa-shipping-fast"></i>
                <div>
                    <strong><?php echo __t('trust_delivery_title'); ?></strong>
                    <span><?php echo __t('trust_delivery_desc'); ?></span>
                </div>
            </div>
            <div class="home-about-strip-item">
                <i class="fas fa-headset"></i>
                <div>
                    <strong><?php echo __t('customer_support'); ?></strong>
                    <span><?php echo __t('tagline'); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<?php if (!empty($testimonials)): ?>
<section class="home-testimonials">
    <div class="container">
        <div class="home-section-title">
            <span><?php echo __t('what_customers_say'); ?></span>
        </div>
        <div class="testimonials-slider-wrap">
            <div class="testimonials-slider" id="testimonialsSlider">
                <?php foreach ($testimonials as $t): ?>
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <?php for ($i = 0; $i < $t['rating']; $i++): ?><i class="fas fa-star"></i><?php endfor; ?>
                        <?php for ($i = $t['rating']; $i < 5; $i++): ?><i class="far fa-star"></i><?php endfor; ?>
                    </div>
                    <p class="testimonial-text">"<?php echo htmlspecialchars($t['message']); ?>"</p>
                    <div class="testimonial-divider"></div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><?php echo strtoupper(substr($t['name'], 0, 1)); ?></div>
                        <div class="testimonial-author-info">
                            <h4><?php echo htmlspecialchars($t['name']); ?></h4>
                            <span><?php echo __t('verified_buyer'); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="testimonials-nav">
                <button class="testimonial-arrow" onclick="prevTestimonial()"><i class="fas fa-chevron-left"></i></button>
                <button class="testimonial-arrow" onclick="nextTestimonial()"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</section>

<script>
var currentTestimonial = 0;
var totalTestimonials = <?php echo count($testimonials); ?>;

function lockTestimonialsHeight() {
    var slider = document.getElementById('testimonialsSlider');
    if (!slider) return;
    var cards = slider.querySelectorAll('.testimonial-card');
    var maxH = 0;

    cards.forEach(function(card) {
        card.style.position = 'relative';
        card.style.opacity = '1';
        card.style.visibility = 'visible';
        card.style.pointerEvents = 'auto';
        maxH = Math.max(maxH, card.offsetHeight);
    });

    slider.style.height = maxH + 'px';

    cards.forEach(function(card) {
        card.style.position = '';
        card.style.opacity = '';
        card.style.visibility = '';
        card.style.pointerEvents = '';
    });
}

function showTestimonial(index) {
    var cards = document.querySelectorAll('#testimonialsSlider .testimonial-card');
    cards.forEach(function(card, i) {
        card.classList.toggle('active', i === index);
    });
}

function nextTestimonial() {
    currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
    showTestimonial(currentTestimonial);
}

function prevTestimonial() {
    currentTestimonial = (currentTestimonial - 1 + totalTestimonials) % totalTestimonials;
    showTestimonial(currentTestimonial);
}

lockTestimonialsHeight();
showTestimonial(0);
window.addEventListener('resize', function() {
    lockTestimonialsHeight();
    showTestimonial(currentTestimonial);
});
setInterval(nextTestimonial, 4000);
</script>
<?php endif; ?>

<!-- Banner Slider JS -->
<script>
(function() {
var currentSlide = 0;
    var sliderInterval = null;

    function getBannerSlideCount() {
    var slider = document.getElementById('bannerSlider');
        if (!slider) return 0;
        return slider.querySelectorAll('.banner-slide').length;
}

function updateDots() {
        var dots = document.querySelectorAll('#bannerDots .banner-dot');
        dots.forEach(function(d, i) {
            d.classList.toggle('active', i === currentSlide);
        });
    }

    window.goToSlide = function(index) {
        var slider = document.getElementById('bannerSlider');
        var totalSlides = getBannerSlideCount();
        if (!slider || totalSlides < 1) return;
        currentSlide = ((index % totalSlides) + totalSlides) % totalSlides;
        slider.style.transform = 'translate3d(-' + (currentSlide * 100) + '%, 0, 0)';
        updateDots();
    };

    window.nextSlide = function() {
        var totalSlides = getBannerSlideCount();
        if (totalSlides < 2) return;
        window.goToSlide(currentSlide + 1);
    };

    window.prevSlide = function() {
        var totalSlides = getBannerSlideCount();
        if (totalSlides < 2) return;
        window.goToSlide(currentSlide - 1);
    };

    function stopBannerSlider() {
        if (sliderInterval) {
            clearInterval(sliderInterval);
            sliderInterval = null;
        }
    }

    function initBannerSlider() {
        stopBannerSlider();
        var slider = document.getElementById('bannerSlider');
        if (!slider) return;

        var totalSlides = getBannerSlideCount();
        currentSlide = 0;
        slider.style.transform = 'translate3d(0, 0, 0)';
        updateDots();

        if (totalSlides > 1) {
            sliderInterval = setInterval(window.nextSlide, 5000);
        }
    }

    document.addEventListener('turbo:load', initBannerSlider);
    document.addEventListener('turbo:before-visit', stopBannerSlider);

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBannerSlider);
    } else {
        initBannerSlider();
    }
})();
</script>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

<?php
// Promo Popup Overlay
require_once __DIR__ . '/../dal/SiteSettingsDAL.php';
$promoSettingsDAL = new SiteSettingsDAL();
$promoPopupImage = $promoSettingsDAL->get('promo_popup_image');
$promoPopupActive = $promoSettingsDAL->get('promo_popup_active');
if ($promoPopupActive === '1' && $promoPopupImage):
?>
<div class="promo-popup-overlay" id="promoPopup">
    <div class="promo-popup-content">
        <button class="promo-popup-close" onclick="closePromoPopup()"><i class="fas fa-times"></i></button>
        <img src="<?php echo htmlspecialchars(media_image_url($promoPopupImage)); ?>" alt="Special Offer">
    </div>
</div>
<style>
.promo-popup-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.7);
    z-index: 99999;
    display: flex; align-items: center; justify-content: center;
    backdrop-filter: blur(4px);
    animation: fadeIn 0.3s ease;
    padding: 20px;
}
.promo-popup-content {
    position: relative;
    max-width: 700px;
    max-height: 85vh;
    width: 90%;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 25px 80px rgba(0,0,0,0.4);
    animation: scaleIn 0.35s ease;
}
.promo-popup-content img {
    width: 100%;
    height: auto;
    max-height: 85vh;
    object-fit: contain;
    display: block;
    background: #fff;
}
.promo-popup-close {
    position: absolute;
    top: 12px; right: 12px;
    width: 36px; height: 36px;
    background: #fff;
    color: #333;
    border: none;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s;
    z-index: 1;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
.promo-popup-close:hover { background: #ef4444; color: #fff; transform: scale(1.1); }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes scaleIn { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
@media (max-width: 768px) { .promo-popup-content { max-width: 95%; width: 95%; } }
</style>
<script>
function closePromoPopup() {
    document.getElementById('promoPopup').style.display = 'none';
    sessionStorage.setItem('promoPopupClosed', '1');
}
// Don't show again if already closed in this session
if (sessionStorage.getItem('promoPopupClosed') === '1') {
    document.getElementById('promoPopup').style.display = 'none';
}
</script>
<?php endif; ?>

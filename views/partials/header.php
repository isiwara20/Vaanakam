<?php
require_once __DIR__ . '/../../config/app.php';

$headerWishCount = 0;
$headerCartCount = 0;
$headerCartTotal = 0;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin'])) {
    try {
        if (!class_exists('WishlistDAL')) { require_once __DIR__ . '/../../dal/WishlistDAL.php'; }
        $headerWishDAL = new WishlistDAL();
        $headerWishCount = $headerWishDAL->getCount($_SESSION['user_id']);
    } catch (Exception $e) {}
    try {
        if (!class_exists('CartDAL')) { require_once __DIR__ . '/../../dal/CartDAL.php'; }
        $headerCartDAL = new CartDAL();
        $headerCartCount = $headerCartDAL->getCount($_SESSION['user_id']);
        $headerCartItems = $headerCartDAL->getByUser($_SESSION['user_id']);
        foreach ($headerCartItems as $hItem) {
            $headerCartTotal += $hItem['price'] * $hItem['quantity'];
        }
    } catch (Exception $e) {}
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(get_current_language()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? SITE_NAME . ' - ' . __t('tagline'); ?></title>
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon-32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon.png" type="image/png" sizes="64x64">
    <link rel="apple-touch-icon" href="<?php echo BASE_URL; ?>assets/images/apple-touch-icon.png" sizes="180x180">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/favicon.png" type="image/png">
    <meta name="description" content="<?php echo htmlspecialchars($pageMetaDescription ?? SITE_NAME . ' - ' . __t('tagline') . '. ' . __t('brand_desc') . ' Owned by ' . STORE_DIRECTOR); ?>">
    <?php if (!empty($pageOg) && is_array($pageOg)): ?>
    <meta property="og:site_name" content="<?php echo htmlspecialchars(SITE_NAME); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageOg['title'] ?? $pageTitle ?? SITE_NAME); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageOg['description'] ?? ''); ?>">
    <meta property="og:type" content="<?php echo htmlspecialchars($pageOg['type'] ?? 'website'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($pageOg['url'] ?? ''); ?>">
    <?php if (!empty($pageOg['image'])): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($pageOg['image']); ?>">
    <meta property="og:image:alt" content="<?php echo htmlspecialchars($pageOg['title'] ?? ''); ?>">
    <?php endif; ?>
    <?php if (!empty($pageOg['price'])): ?>
    <meta property="product:price:amount" content="<?php echo htmlspecialchars((string)$pageOg['price']); ?>">
    <meta property="product:price:currency" content="<?php echo htmlspecialchars($pageOg['currency'] ?? 'LKR'); ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageOg['title'] ?? $pageTitle ?? SITE_NAME); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageOg['description'] ?? ''); ?>">
    <?php if (!empty($pageOg['image'])): ?>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($pageOg['image']); ?>">
    <?php endif; ?>
    <?php endif; ?>
    <meta name="lumak-cart-count" content="<?php echo (int)$headerCartCount; ?>">
    <meta name="lumak-cart-total" content="<?php echo htmlspecialchars(format_price($headerCartTotal, 2)); ?>">
    <meta name="lumak-wish-count" content="<?php echo (int)$headerWishCount; ?>">
    <meta name="lumak-currency" content="<?php echo htmlspecialchars(get_current_currency()); ?>">

    <?php ezymart_render_google_analytics_head(); ?>
    
    <!-- DNS Prefetch & Preconnect for faster external resource loading -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    
    <!-- Critical CSS inline for above-the-fold content -->
    <style>
        html{scrollbar-gutter:stable}
        body{margin:0;padding:0;font-family:'Poppins',system-ui,-apple-system,sans-serif;-webkit-font-smoothing:antialiased;background:#fff;line-height:1.6}
        html[lang="ta"], body[lang="ta"], .lang-ta {font-family:'Noto Sans Tamil','Poppins',system-ui,-apple-system,sans-serif}
        #page-wrapper{background:#fff}
        #site-chrome{--lumak-topbar-real:38px;--lumak-topbar-h:var(--lumak-topbar-real);--lumak-navbar-h:72px;--lumak-catnav-h:44px;--lumak-header-total-h:calc(var(--lumak-topbar-h) + var(--lumak-navbar-h) + var(--lumak-catnav-h));position:sticky;top:0;z-index:1000;width:100%;background:#fff;box-shadow:0 2px 12px rgba(15,43,72,0.08)}
        #main-content{overflow-x:clip}
        .top-bar-slot{height:var(--lumak-topbar-real);overflow:visible;transition:height .26s cubic-bezier(.4,0,.2,1);will-change:height}
        #site-chrome.is-scrolled .top-bar-slot{height:0;overflow:hidden}
        #site-chrome.is-scrolled{--lumak-topbar-h:0px}
        .top-bar{background:#0F2B48;color:#ffffff;font-size:12px;padding:10px 0;height:var(--lumak-topbar-real);box-sizing:border-box;display:flex;align-items:center}
        .top-bar-left span,.top-bar-right a,.top-bar-right .top-link,.top-bar-right .top-link span,.top-bar-right .language-selector,.top-bar-right .currency-selector,#currentLanguage,#currentCurrency{display:flex;align-items:center;gap:6px;color:#ffffff!important;font-weight:500;text-decoration:none;cursor:pointer}
        .top-bar-left span i,.top-bar-right a i,.top-bar-right .top-link i,.top-bar-right .language-selector i,.top-bar-right .currency-selector i{color:#22C55E;font-size:11px;min-width:1em;text-align:center}
        .top-bar-left span:hover,.top-bar-right a:hover,.top-bar-right .top-link:hover,.top-bar-right .language-selector:hover,.top-bar-right .currency-selector:hover{color:#22C55E}
        .top-bar-divider{width:1px;height:14px;background:rgba(255,255,255,0.28)!important;margin:0 14px;flex-shrink:0}
        .top-bar-content{display:flex;justify-content:space-between;align-items:center;min-height:18px;width:100%}
        .top-bar-left,.top-bar-right{display:flex;align-items:center}
        .top-bar-right{flex-wrap:nowrap;gap:12px}
        .top-bar-quick-links{display:flex;align-items:center;gap:18px}
        .navbar{background:#fff;padding:10px 0;position:relative;z-index:2;margin:0;border:0;min-height:var(--lumak-navbar-h);box-sizing:border-box}
        .nav-content{display:flex;align-items:center;justify-content:space-between;gap:25px}
        .logo{display:flex;align-items:center;flex-shrink:0;text-decoration:none}
        .logo img{height:54px;max-height:56px;width:auto;display:block;object-fit:contain}
        .search-bar{flex:1;max-width:480px;display:flex;border:2px solid #e2e8f0;border-radius:12px;position:relative;overflow:visible;min-height:46px;box-sizing:border-box;transition:border-color .2s}
        .search-bar:focus-within{border-color:#16A34A}
        .search-input-wrap{flex:1;display:flex;align-items:center;padding-left:15px;min-width:0}
        .search-icon-inside{color:#94a3b8;font-size:14px;margin-right:10px;min-width:14px}
        .search-bar input{flex:1;padding:12px 15px 12px 0;border:none;outline:none;font-size:13px;background:transparent;font-family:inherit;min-width:0}
        .search-btn{background:#16A34A;color:#fff;border:none;padding:12px 20px;cursor:pointer;font-size:15px;border-radius:0 10px 10px 0;flex-shrink:0;transition:background .2s}
        .search-btn:hover{background:#15803D}
        .search-suggestions{display:none;position:absolute;top:calc(100% + 4px);left:-2px;right:-2px;z-index:9999}
        .search-suggestions.is-open{display:block!important}
        .nav-actions{display:flex;gap:8px;align-items:center;flex-shrink:0}
        .nav-action-item{display:flex;align-items:center;gap:10px;padding:8px 14px;border-radius:10px;text-decoration:none;color:#333}
        .nav-action-icon{position:relative;width:40px;height:40px;min-width:40px;min-height:40px;background:#F0FDF4;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;color:#16A34A}
        .nav-action-text{display:flex;flex-direction:column}
        .nav-action-label{font-size:13px;font-weight:600;color:#0F2B48;line-height:1.2}
        .nav-action-sub{font-size:11px;color:#64748b;min-width:75px;line-height:1.2}
        .cart-badge{position:absolute;top:-4px;right:-4px;width:18px;height:18px;font-size:9px;font-weight:700;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#16A34A;color:#fff;border:2px solid #fff}
        .mobile-menu-btn{display:none;width:42px;height:42px;min-width:42px;padding:8px;border:none;background:none;font-size:22px;color:#0F2B48;cursor:pointer;border-radius:10px;flex-shrink:0}
        .mobile-header-actions{display:none;align-items:center;gap:6px;margin-left:auto;flex-shrink:0}
        .mobile-header-cart{position:relative;display:flex;align-items:center;justify-content:center;width:42px;height:42px;min-width:42px;border-radius:50%;color:#16A34A;text-decoration:none;background:#F0FDF4}
        .mobile-header-cart i{font-size:18px}
        .mobile-menu{display:none;max-height:0;overflow:hidden}
        .currency-selector,.language-selector{position:relative;flex-shrink:0;white-space:nowrap}
        #currentCurrency,#currentLanguage{display:inline-block;min-width:2.2em;text-align:left}
        .currency-dropdown,.lang-dropdown{display:none!important;position:absolute;top:calc(100% + 8px);right:0;z-index:10001;min-width:180px;padding:6px;background:#fff;border:1px solid #e2e8f0;border-radius:10px;box-shadow:0 10px 25px rgba(15,43,72,0.15)}
        .currency-dropdown.show,.lang-dropdown.show{display:block!important}
        .currency-dropdown a,.lang-dropdown a{display:block;padding:9px 14px;font-size:12px;color:#0F2B48!important;text-decoration:none!important;white-space:nowrap;border-radius:6px;transition:all .15s}
        .currency-dropdown a:hover,.lang-dropdown a:hover{background:#F0FDF4;color:#16A34A!important}
        .currency-dropdown a.active,.lang-dropdown a.active{background:#DCFCE7;color:#15803D!important;font-weight:600}
        .category-nav{background:#fff;margin:0;border-top:1px solid #e2e8f0;border-bottom:2px solid #16A34A;min-height:var(--lumak-catnav-h);position:relative;z-index:1}
        .category-nav .category-nav-content{display:flex;align-items:stretch;height:var(--lumak-catnav-h)}
        .category-nav .all-categories-btn{background:#16A34A;color:#fff;border:none;display:flex;align-items:center;gap:8px;padding:0 20px;height:100%;min-height:var(--lumak-catnav-h);font-size:12px;font-weight:600;white-space:nowrap;cursor:pointer;font-family:inherit;transition:background .2s}
        .category-nav .all-categories-btn:hover{background:#15803D}
        .all-categories-wrapper{position:relative;height:100%;display:flex;align-items:stretch;flex-shrink:0}
        .all-categories-dropdown{position:absolute;top:100%;left:0;max-height:0;overflow:hidden;opacity:0;z-index:100}
        .category-nav .category-links{display:flex;align-items:center;overflow-x:auto}
        .category-nav .cat-link{display:flex;align-items:center;padding:0 16px;height:var(--lumak-catnav-h);font-size:12px;font-weight:500;color:#0F2B48;text-decoration:none;white-space:nowrap;transition:color .15s}
        .category-nav .cat-link:hover,.category-nav .cat-link.active{color:#16A34A;font-weight:600}
        .footer{background:#0A1C2A}
        .container{max-width:1200px;margin:0 auto;padding:0 20px}
        img{max-width:100%;height:auto}
        .turbo-progress-bar{background:#16A34A;height:3px;position:fixed;top:0;left:0}
        .header-hotline{display:flex;align-items:center;gap:8px;white-space:nowrap;flex-shrink:0;min-width:162px}
        .header-hotline i{font-size:18px;color:#16A34A;width:18px;min-width:18px;text-align:center}
        .header-hotline .hotline-label{display:block;font-size:10px;color:#64748b;font-weight:500;line-height:1.2}
        .header-hotline .hotline-numbers{display:block}
        .store-phone-table{border-collapse:collapse;border-spacing:0;font-family:'Roboto Mono',ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;font-size:14px;font-weight:700;line-height:1.3;color:#0F2B48}
        .store-phone-cell{padding:0;vertical-align:baseline;text-align:left}
        .store-phone-cell+.store-phone-cell{padding-left:.45em}
        .store-phone-link{display:inline-block;color:inherit;text-decoration:none;font-weight:700;white-space:nowrap;-webkit-font-smoothing:antialiased;-webkit-tap-highlight-color:rgba(22,163,74,0.15)}
        .store-phone-link:hover{color:#16A34A}
        .fas,.far,.fab{display:inline-block;min-width:1em;text-align:center;font-style:normal}
        .mobile-lang-btn{display:inline-flex;align-items:center;justify-content:center;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:600;background:#f0f4f8;color:#0F2B48;text-decoration:none;border:1px solid #e2e8f0;transition:all .2s}
        .mobile-lang-btn.active{background:#16A34A;color:#fff;border-color:#16A34A}
        @media (max-width:1100px){.header-hotline{display:none!important}}
        @media (max-width:992px){.nav-action-text{display:none}.nav-action-item{padding:8px}.search-desktop{max-width:320px}}
        @media (max-width:768px){
            #site-chrome{--lumak-navbar-h:54px}
            .search-desktop,.nav-actions{display:none!important}
            .mobile-header-actions{display:flex!important}
            .mobile-menu-btn{display:flex!important;align-items:center;justify-content:center}
            .logo img{height:38px;max-height:40px}
            .top-bar-left,.top-bar-hide-mobile{display:none!important}
            .top-bar{padding:6px 0;height:auto;min-height:34px;box-sizing:border-box}
            .top-bar .container{padding:0 12px!important}
            .top-bar-content{justify-content:space-between;width:100%}
            .top-bar-right{width:100%;justify-content:space-between;gap:8px;flex-wrap:nowrap}
            .top-bar-quick-links{display:flex;align-items:center;gap:8px;min-width:0;flex-shrink:1}
            .top-bar-track-link{font-size:11px;white-space:nowrap;display:inline-flex;align-items:center;gap:4px;overflow:hidden}
            .top-bar-track-link span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:160px}
            .top-bar-utils{display:flex;align-items:center;margin-left:auto;gap:6px;flex-shrink:0}
            .top-bar-divider{margin:0 6px!important;height:12px!important}
            .language-selector,.currency-selector{font-size:11px!important;gap:4px!important}
            .language-selector i,.currency-selector i{font-size:10px!important}
            #currentLanguage,#currentCurrency{font-size:11px!important}
            .currency-dropdown,.lang-dropdown{right:0!important;left:auto!important;max-width:calc(100vw - 20px)!important}
        }
        @media (max-width:380px){
            .top-bar .container{padding:0 8px!important}
            .top-bar-right{gap:4px}
            .top-bar-track-link{font-size:10.5px}
            .top-bar-track-link span{max-width:115px}
            .top-bar-utils{gap:4px}
            .top-bar-divider{margin:0 4px!important}
            .language-selector,.currency-selector{font-size:10px!important;gap:2px!important}
            #currentLanguage,#currentCurrency{font-size:10px!important}
        }
    </style>
    
    <?php
    $lumakPreloadImages = array_values(array_unique(array_filter(array_merge(
        [asset_image_url('assets/images/logo.png')],
        is_array($pagePreloadImages ?? null) ? $pagePreloadImages : []
    ))));
    foreach ($lumakPreloadImages as $preloadImageUrl): ?>
    <link rel="preload" as="image" href="<?php echo htmlspecialchars($preloadImageUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endforeach; ?>
    <!-- CSS - versioned for cache busting -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/../../assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Tamil:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800;900&family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.12/dist/turbo.min.js" defer></script>
</head>
<body<?php echo !empty($bodyClass) ? ' class="' . htmlspecialchars($bodyClass) . '"' : ''; ?>>
    <div id="page-wrapper" style="background:#fff;">
    <div id="site-chrome" data-turbo-permanent>
    <!-- Top Bar -->
    <div class="top-bar-slot">
    <div class="top-bar">
        <div class="container top-bar-content">
            <div class="top-bar-left">
                <span class="top-bar-hide-mobile"><i class="fas fa-leaf"></i> <?php echo __t('tagline'); ?></span>
                <span class="top-bar-divider"></span>
                <span><i class="fas fa-truck"></i> <?php echo __t('island_wide_delivery'); ?></span>
                <span class="top-bar-divider"></span>
                <span><i class="fas fa-shield-alt"></i> <?php echo __t('secure_checkout'); ?></span>
            </div>
            <div class="top-bar-right">
                <div class="top-bar-quick-links">
                    <a href="<?php echo BASE_URL; ?>track-order.php" class="top-link top-bar-track-link"><i class="fas fa-truck"></i> <span><?php echo __t('track_order'); ?></span></a>
                    <a href="<?php echo BASE_URL; ?>warranty.php" class="top-link top-bar-warranty-link top-bar-hide-mobile"><i class="fas fa-shield-alt"></i> <span><?php echo __t('warranty'); ?></span></a>
                </div>
                <span class="top-bar-divider top-bar-hide-mobile"></span>
                <a href="<?php echo BASE_URL; ?>contact.php" class="top-link top-bar-hide-mobile"><?php echo __t('help_center'); ?></a>
                <span class="top-bar-divider top-bar-hide-mobile"></span>
                <div class="top-bar-utils">
                    <!-- Language Selector -->
                    <div class="language-selector" id="languageSelector" onclick="toggleLanguageMenu(event)" title="Change Language">
                        <i class="fas fa-globe"></i>
                        <span id="currentLanguage" class="js-current-language"><?php echo htmlspecialchars(get_language_info()['native_name']); ?></span>
                        <i class="fas fa-chevron-down"></i>
                        <div class="lang-dropdown" id="languageDropdown">
                            <?php foreach (get_supported_languages() as $lCode => $lData): ?>
                            <a href="#" onclick="switchLanguage('<?php echo $lCode; ?>', event)" class="<?php echo get_current_language() === $lCode ? 'active' : ''; ?>">
                                <?php echo $lData['flag']; ?> <?php echo htmlspecialchars($lData['native_name']); ?> (<?php echo htmlspecialchars($lData['name']); ?>)
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <span class="top-bar-divider"></span>
                    <!-- Currency Selector -->
                    <div class="currency-selector" id="currencySelector" onclick="toggleCurrencyMenu(event)" title="Change Currency">
                        <i class="fas fa-coins"></i>
                        <span id="currentCurrency" class="js-current-currency"><?php echo htmlspecialchars(get_current_currency()); ?></span>
                        <i class="fas fa-chevron-down"></i>
                        <div class="currency-dropdown" id="currencyDropdown">
                            <?php foreach (CURRENCIES as $code => $cur): ?>
                            <a href="#" onclick="switchCurrency('<?php echo $code; ?>', event)" class="<?php echo get_current_currency() === $code ? 'active' : ''; ?>">
                                <?php echo htmlspecialchars($code); ?> — <?php echo htmlspecialchars($cur['name']); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar">
        <div class="container nav-content">
            <!-- Logo -->
            <a href="<?php echo BASE_URL; ?>" class="logo">
                <img src="<?php echo asset_image_url('assets/images/logo.png'); ?>" alt="<?php echo htmlspecialchars(SITE_NAME); ?> Logo" width="160" height="54" decoding="async" fetchpriority="high" style="height:54px;width:auto;object-fit:contain;">
            </a>

            <!-- Contact Info -->
            <div class="header-hotline">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <span class="hotline-label"><?php echo __t('call_us'); ?></span>
                    <div class="hotline-numbers">
                        <?php echo render_store_phone_numbers([STORE_PHONE_1], ['attrs' => ['data-turbo' => 'false']]); ?>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-bar search-desktop">
                <div class="search-input-wrap">
                    <i class="fas fa-search search-icon-inside"></i>
                    <input type="text" id="headerSearchInput" placeholder="<?php echo htmlspecialchars(__t('search_placeholder')); ?>" autocomplete="off" oninput="handleSearch(this.value)" onkeypress="if(event.key==='Enter')submitSearch()">
                </div>
                <button class="search-btn" onclick="submitSearch()">
                    <i class="fas fa-search"></i>
                </button>
                <!-- Search Suggestions Dropdown -->
                <div class="search-suggestions" id="searchSuggestions"></div>
            </div>

            <!-- Nav Actions (Desktop) -->
            <div class="nav-actions">
                <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || (isset($_SESSION['is_admin']) && $_SESSION['is_admin'])): ?>
                <a href="<?php echo BASE_URL; ?>login.php" class="nav-action-item">
                    <div class="nav-action-icon">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="nav-action-text">
                        <span class="nav-action-label"><?php echo __t('account'); ?></span>
                        <span class="nav-action-sub"><?php echo __t('login_register'); ?></span>
                    </div>
                </a>
                <?php endif; ?>

                <a href="<?php echo BASE_URL; ?>wishlist.php" class="nav-action-item">
                    <div class="nav-action-icon">
                        <i class="far fa-heart"></i>
                        <span class="cart-badge" id="headerWishBadge" style="background:#ef4444;<?php echo $headerWishCount > 0 ? '' : 'display:none;'; ?>"><?php echo $headerWishCount; ?></span>
                    </div>
                    <div class="nav-action-text">
                        <span class="nav-action-label"><?php echo __t('wishlist'); ?></span>
                        <span class="nav-action-sub" id="headerWishSub"><?php echo $headerWishCount; ?> <?php echo $headerWishCount === 1 ? __t('item') : __t('items'); ?></span>
                    </div>
                </a>

                <a href="<?php echo BASE_URL; ?>cart.php" class="nav-action-item cart-item">
                    <div class="nav-action-icon">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="cart-badge js-header-cart-badge" id="headerCartBadge"><?php echo $headerCartCount; ?></span>
                    </div>
                    <div class="nav-action-text">
                        <span class="nav-action-label"><?php echo __t('cart'); ?></span>
                        <span class="nav-action-sub" id="headerCartTotal"><?php echo format_price($headerCartTotal, 2); ?></span>
                    </div>
                </a>

                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin'])): ?>
                <div class="nav-action-item profile-dropdown-wrap" onclick="toggleProfileMenu(event)">
                    <div class="nav-action-icon">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="nav-action-text">
                        <span class="nav-action-label"><?php echo __t('hi'); ?>, <?php echo htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?></span>
                        <span class="nav-action-sub"><?php echo __t('my_account'); ?> <i class="fas fa-chevron-down" style="font-size:9px;"></i></span>
                    </div>
                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="<?php echo BASE_URL; ?>profile.php" class="profile-dropdown-item"><i class="fas fa-user"></i> <?php echo __t('my_profile'); ?></a>
                        <a href="<?php echo BASE_URL; ?>my-orders.php" class="profile-dropdown-item"><i class="fas fa-box"></i> <?php echo __t('my_orders'); ?></a>
                        <a href="<?php echo BASE_URL; ?>track-order.php" class="profile-dropdown-item"><i class="fas fa-truck"></i> <?php echo __t('track_order'); ?></a>
                        <a href="<?php echo BASE_URL; ?>warranty.php" class="profile-dropdown-item"><i class="fas fa-shield-alt"></i> <?php echo __t('check_warranty'); ?></a>
                        <div class="profile-dropdown-divider"></div>
                        <a href="#" onclick="showLogoutConfirm(event)" class="profile-dropdown-item logout"><i class="fas fa-sign-out-alt"></i> <?php echo __t('logout'); ?></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Mobile Cart + Menu -->
            <div class="mobile-header-actions">
                <a href="<?php echo BASE_URL; ?>cart.php" class="mobile-header-cart" aria-label="View cart">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-badge js-header-cart-badge" id="headerMobileNavCartBadge"><?php echo $headerCartCount; ?></span>
                </a>
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                    <i class="fas fa-bars" id="menuIcon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div class="mobile-menu" id="mobileMenu">
            <!-- Mobile Language & Currency Selector -->
            <div class="mobile-lang-bar" style="display:flex;align-items:center;justify-content:space-between;padding:12px 18px;border-bottom:1px solid #e8ecf1;background:#fafbfc;">
                <span style="font-size:12px;font-weight:600;color:#0F2B48;"><i class="fas fa-globe" style="color:#16A34A;margin-right:6px;"></i> <?php echo __t('language'); ?>:</span>
                <div style="display:flex;gap:6px;">
                    <a href="#" onclick="switchLanguage('en', event)" class="mobile-lang-btn <?php echo get_current_language() === 'en' ? 'active' : ''; ?>">🇬🇧 EN</a>
                    <a href="#" onclick="switchLanguage('ta', event)" class="mobile-lang-btn <?php echo get_current_language() === 'ta' ? 'active' : ''; ?>">🇱🇰 தமிழ்</a>
                </div>
            </div>
            <div class="mobile-search" style="position:relative;">
                <div class="search-input-wrap">
                    <i class="fas fa-search search-icon-inside"></i>
                    <input type="text" id="mobileSearchInput" placeholder="<?php echo htmlspecialchars(__t('search_placeholder')); ?>" autocomplete="off" oninput="handleMobileSearch(this.value)" onkeypress="if(event.key==='Enter')submitMobileSearch()">
                </div>
                <div class="search-suggestions" id="mobileSearchSuggestions"></div>
            </div>
            <div class="mobile-menu-links">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin'])): ?>
                <a href="<?php echo BASE_URL; ?>my-orders.php" class="mobile-menu-item">
                    <i class="far fa-user"></i>
                    <span><?php echo __t('hi'); ?>, <?php echo htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?></span>
                </a>
                <a href="<?php echo BASE_URL; ?>my-orders.php" class="mobile-menu-item">
                    <i class="fas fa-box"></i>
                    <span><?php echo __t('my_orders'); ?></span>
                </a>
                <a href="<?php echo BASE_URL; ?>controllers/AuthController.php?action=logout" class="mobile-menu-item" data-turbo="false">
                    <i class="fas fa-sign-out-alt"></i>
                    <span><?php echo __t('logout'); ?></span>
                </a>
                <?php else: ?>
                <a href="<?php echo BASE_URL; ?>login.php" class="mobile-menu-item">
                    <i class="far fa-user"></i>
                    <span><?php echo __t('login_register'); ?></span>
                </a>
                <?php endif; ?>
                <a href="<?php echo BASE_URL; ?>wishlist.php" class="mobile-menu-item">
                    <i class="far fa-heart"></i>
                    <span><?php echo __t('wishlist'); ?></span>
                </a>
                <a href="<?php echo BASE_URL; ?>cart.php" class="mobile-menu-item">
                    <i class="fas fa-shopping-bag"></i>
                    <span><?php echo __t('cart'); ?></span>
                    <span class="mobile-badge js-header-cart-badge" id="headerMobileCartBadge"><?php echo $headerCartCount; ?></span>
                </a>
                <a href="<?php echo BASE_URL; ?>track-order.php" class="mobile-menu-item">
                    <i class="fas fa-truck"></i>
                    <span><?php echo __t('track_order'); ?></span>
                </a>
                <a href="<?php echo BASE_URL; ?>warranty.php" class="mobile-menu-item">
                    <i class="fas fa-shield-alt"></i>
                    <span><?php echo __t('warranty'); ?></span>
                </a>
                <a href="<?php echo BASE_URL; ?>contact.php" class="mobile-menu-item">
                    <i class="fas fa-headset"></i>
                    <span><?php echo __t('help_center'); ?></span>
                </a>
                <a href="tel:<?php echo preg_replace('/\D+/', '', STORE_PHONE_1); ?>" class="mobile-menu-item" data-turbo="false">
                    <i class="fas fa-phone-alt"></i>
                    <span class="mobile-hotline-number"><?php echo STORE_PHONE_1; ?></span>
                </a>
            </div>
        </div>
    </nav>

    <?php require_once __DIR__ . '/category-nav.php'; ?>

    <script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');
        menu.classList.toggle('active');
        if (menu.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }

    document.getElementById('mobileMenuBtn').addEventListener('click', toggleMobileMenu);

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('mobileMenu');
        const btn = document.getElementById('mobileMenuBtn');
        if (!menu.contains(e.target) && !btn.contains(e.target) && menu.classList.contains('active')) {
            toggleMobileMenu();
        }
    });

    // Profile dropdown toggle
    function toggleProfileMenu(e) {
        e.stopPropagation();
        var dropdown = document.getElementById('profileDropdown');
        if (dropdown) {
            dropdown.classList.toggle('show');
        }
    }

    // Close profile dropdown when clicking outside
    document.addEventListener('click', function(e) {
        var dropdown = document.getElementById('profileDropdown');
        if (dropdown && !e.target.closest('.profile-dropdown-wrap')) {
            dropdown.classList.remove('show');
        }
    });

    // ---- Search Functionality ----
    var searchTimer = null;
    function handleSearch(query) {
        clearTimeout(searchTimer);
        var suggestions = document.getElementById('searchSuggestions');
        if (!suggestions) return;
        if (query.length < 2) {
            suggestions.innerHTML = '';
            suggestions.classList.remove('is-open');
            return;
        }
        searchTimer = setTimeout(function() {
            fetch('<?php echo BASE_URL; ?>controllers/SearchController.php?q=' + encodeURIComponent(query))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!suggestions) return;
                if (data.results && data.results.length > 0) {
                    var html = '';
                    data.results.forEach(function(item) {
                        var imgSrc = item.image ? '<?php echo BASE_URL; ?>' + item.image : '';
                        html += '<a href="<?php echo BASE_URL; ?>product.php?slug=' + item.slug + '" class="search-suggestion-item">';
                        if (imgSrc) {
                            html += '<img src="' + imgSrc + '" alt="" class="search-suggestion-img">';
                        } else {
                            html += '<div class="search-suggestion-img search-suggestion-placeholder"><i class="fas fa-box"></i></div>';
                        }
                        html += '<div class="search-suggestion-info">';
                        html += '<span class="search-suggestion-name">' + item.name + '</span>';
                        html += '<span class="search-suggestion-meta">' + item.category + ' &bull; ' + (item.formatted_price || (typeof formatStorePrice === 'function' ? formatStorePrice(item.price) : item.price)) + '</span>';
                        html += '</div></a>';
                    });
                    suggestions.innerHTML = html;
                    suggestions.classList.add('is-open');
                } else {
                    suggestions.innerHTML = '<div class="search-no-results"><i class="fas fa-search"></i><p>No results found for "' + query + '"</p></div>';
                    suggestions.classList.add('is-open');
                }
            })
            .catch(function() {
                if (suggestions) {
                    suggestions.innerHTML = '';
                    suggestions.classList.remove('is-open');
                }
            });
        }, 300);
    }

    function submitSearch() {
        var query = document.getElementById('headerSearchInput').value.trim();
        if (query.length > 0) {
            window.location.href = '<?php echo BASE_URL; ?>shop.php?search=' + encodeURIComponent(query);
        }
    }

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        var suggestions = document.getElementById('searchSuggestions');
        var mobileSuggestions = document.getElementById('mobileSearchSuggestions');
        if (suggestions && !e.target.closest('.search-bar')) {
            suggestions.classList.remove('is-open');
        }
        if (mobileSuggestions && !e.target.closest('.mobile-search')) {
            mobileSuggestions.classList.remove('is-open');
        }
    });

    // ---- Mobile Search ----
    var mobileSearchTimer = null;
    function handleMobileSearch(query) {
        clearTimeout(mobileSearchTimer);
        var suggestions = document.getElementById('mobileSearchSuggestions');
        if (!suggestions) return;
        if (query.length < 2) {
            suggestions.innerHTML = '';
            suggestions.classList.remove('is-open');
            return;
        }
        mobileSearchTimer = setTimeout(function() {
            fetch('<?php echo BASE_URL; ?>controllers/SearchController.php?q=' + encodeURIComponent(query))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!suggestions) return;
                if (data.results && data.results.length > 0) {
                    var html = '';
                    data.results.forEach(function(item) {
                        var imgSrc = item.image ? '<?php echo BASE_URL; ?>' + item.image : '';
                        html += '<a href="<?php echo BASE_URL; ?>product.php?slug=' + item.slug + '" class="search-suggestion-item">';
                        if (imgSrc) {
                            html += '<img src="' + imgSrc + '" alt="" class="search-suggestion-img">';
                        } else {
                            html += '<div class="search-suggestion-img search-suggestion-placeholder"><i class="fas fa-box"></i></div>';
                        }
                        html += '<div class="search-suggestion-info">';
                        html += '<span class="search-suggestion-name">' + item.name + '</span>';
                        html += '<span class="search-suggestion-meta">' + item.category + ' &bull; ' + (item.formatted_price || (typeof formatStorePrice === 'function' ? formatStorePrice(item.price) : item.price)) + '</span>';
                        html += '</div></a>';
                    });
                    suggestions.innerHTML = html;
                    suggestions.classList.add('is-open');
                } else {
                    suggestions.innerHTML = '<div class="search-no-results"><i class="fas fa-search"></i><p>No results found for "' + query + '"</p></div>';
                    suggestions.classList.add('is-open');
                }
            })
            .catch(function() {
                if (suggestions) {
                    suggestions.innerHTML = '';
                    suggestions.classList.remove('is-open');
                }
            });
        }, 300);
    }

    function submitMobileSearch() {
        var query = document.getElementById('mobileSearchInput').value.trim();
        if (query.length > 0) {
            window.location.href = '<?php echo BASE_URL; ?>shop.php?search=' + encodeURIComponent(query);
        }
    }
    </script>

    <style>
    /* Search Suggestions */
    .search-suggestions {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: -2px;
        right: -2px;
        background: #fff;
        border: 1px solid #e8ecf1;
        border-radius: 12px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        z-index: 9999;
        max-height: 360px;
        overflow-y: auto;
        padding: 6px;
    }
    .search-suggestions.is-open {
        display: block;
    }
    .search-suggestions::-webkit-scrollbar { width: 4px; }
    .search-suggestions::-webkit-scrollbar-thumb { background: #ddd; border-radius: 4px; }
    .search-suggestion-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 8px;
        text-decoration: none;
        color: #333;
        transition: background 0.15s;
    }
    .search-suggestion-item:hover {
        background: #f5f7fa;
    }
    .search-suggestion-img {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        background: #f5f7fa;
        border: 1px solid #edf0f5;
    }
    .search-suggestion-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 16px;
    }
    .search-suggestion-info {
        flex: 1;
        min-width: 0;
    }
    .search-suggestion-name {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #0d1137;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .search-suggestion-meta {
        display: block;
        font-size: 11px;
        color: #6b7099;
        margin-top: 2px;
    }
    .search-no-results {
        text-align: center;
        padding: 30px 20px;
    }
    .search-no-results i {
        font-size: 28px;
        color: #ddd;
        margin-bottom: 10px;
        display: block;
    }
    .search-no-results p {
        font-size: 13px;
        color: #888;
        margin: 0;
    }

    /* Language Selector */
    .language-selector { position: relative; cursor: pointer; }
    .lang-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        z-index: 9999;
        min-width: 130px;
        padding: 6px;
    }
    .lang-dropdown.show { display: block; }
    .lang-dropdown a {
        display: block;
        padding: 9px 14px;
        font-size: 13px;
        color: #333 !important;
        text-decoration: none !important;
        border-radius: 6px;
        transition: background 0.15s, color 0.15s;
        font-weight: 500;
    }
    .lang-dropdown a:hover { background: #16A34A !important; color: #fff !important; }

    /* Currency Selector */
    .currency-selector { position: relative; cursor: pointer; display: flex; align-items: center; gap: 6px; }
    .currency-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        z-index: 9999;
        min-width: 180px;
        padding: 6px;
    }
    .currency-dropdown.show { display: block; }
    .currency-dropdown a {
        display: block;
        padding: 9px 14px;
        font-size: 12px;
        color: #333 !important;
        text-decoration: none !important;
        border-radius: 6px;
        transition: background 0.15s, color 0.15s;
        font-weight: 500;
        white-space: nowrap;
    }
    .currency-dropdown a:hover,
    .currency-dropdown a.active { background: #16A34A !important; color: #fff !important; }

    @media (max-width: 768px) {
        .top-bar {
            padding: 6px 0;
            height: auto;
            min-height: 34px;
            box-sizing: border-box;
        }
        .top-bar .container {
            padding: 0 12px !important;
        }
        .top-bar-hide-mobile { display: none !important; }
        .top-bar-right {
            display: flex !important;
            width: 100%;
            justify-content: space-between !important;
            align-items: center;
            gap: 8px !important;
            flex-wrap: nowrap;
        }
        .top-bar-quick-links {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            flex-shrink: 1;
        }
        .top-bar-track-link {
            font-size: 11px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            overflow: hidden;
        }
        .top-bar-track-link span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 160px;
        }
        .top-bar-utils {
            display: flex;
            align-items: center;
            margin-left: auto;
            gap: 6px !important;
            flex-shrink: 0;
        }
        .top-bar-divider {
            margin: 0 6px !important;
            height: 12px !important;
        }
        .language-selector, .currency-selector {
            font-size: 11px !important;
            gap: 4px !important;
        }
        .language-selector i, .currency-selector i {
            font-size: 10px !important;
        }
        #currentLanguage, #currentCurrency {
            font-size: 11px !important;
        }
        .currency-dropdown, .lang-dropdown {
            right: 0 !important;
            left: auto !important;
            max-width: calc(100vw - 20px) !important;
        }
    }

    @media (max-width: 380px) {
        .top-bar .container { padding: 0 8px !important; }
        .top-bar-right { gap: 4px !important; }
        .top-bar-track-link { font-size: 10.5px; }
        .top-bar-track-link span { max-width: 115px; }
        .top-bar-utils { gap: 4px !important; }
        .top-bar-divider { margin: 0 4px !important; }
        .language-selector, .currency-selector { font-size: 10px !important; gap: 2px !important; }
        #currentLanguage, #currentCurrency { font-size: 10px !important; }
    }

    /* Hide Google Translate bar */
    .goog-te-banner-frame, .skiptranslate { display: none !important; }
    body { top: 0 !important; }
    </style>

    <!-- Currency switcher -->
    <script>
    var STORE_CURRENCY = <?php echo json_encode(currency_js_config()); ?>;

    function formatStorePrice(amountLkr) {
        var cfg = STORE_CURRENCY;
        var converted = Number(amountLkr) / cfg.rate;
        if (cfg.current === 'LKR') {
            return 'LKR ' + converted.toLocaleString(undefined, { minimumFractionDigits: cfg.decimals, maximumFractionDigits: cfg.decimals });
        }
        return cfg.symbol + converted.toLocaleString(undefined, { minimumFractionDigits: cfg.decimals, maximumFractionDigits: cfg.decimals });
    }

    function toggleCurrencyMenu(e) {
        e.stopPropagation();
        var wrap = e.currentTarget;
        var dd = wrap ? wrap.querySelector('.currency-dropdown') : null;
        if (!dd) dd = document.getElementById('currencyDropdown');
        var isOpen = dd && dd.classList.contains('show');
        document.querySelectorAll('.currency-dropdown').forEach(function(el) { el.classList.remove('show'); });
        document.querySelectorAll('.lang-dropdown').forEach(function(el) { el.classList.remove('show'); });
        if (dd && !isOpen) dd.classList.add('show');
    }

    function switchCurrency(code, e) {
        e.preventDefault();
        e.stopPropagation();
        document.querySelectorAll('.currency-dropdown').forEach(function(el) { el.classList.remove('show'); });
        fetch('<?php echo BASE_URL; ?>controllers/CurrencyController.php?code=' + encodeURIComponent(code))
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                window.location.reload();
            }
        });
    }

    function toggleLanguageMenu(e) {
        e.stopPropagation();
        var wrap = e.currentTarget;
        var dd = wrap ? wrap.querySelector('.lang-dropdown') : null;
        if (!dd) dd = document.getElementById('languageDropdown');
        var isOpen = dd && dd.classList.contains('show');
        document.querySelectorAll('.lang-dropdown').forEach(function(el) { el.classList.remove('show'); });
        document.querySelectorAll('.currency-dropdown').forEach(function(el) { el.classList.remove('show'); });
        if (dd && !isOpen) dd.classList.add('show');
    }

    function switchLanguage(lang, e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        document.querySelectorAll('.lang-dropdown').forEach(function(el) { el.classList.remove('show'); });
        fetch('<?php echo BASE_URL; ?>controllers/LanguageController.php?lang=' + encodeURIComponent(lang) + '&ajax=1')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(function() {
            window.location.href = '<?php echo BASE_URL; ?>controllers/LanguageController.php?lang=' + encodeURIComponent(lang);
        });
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.currency-selector')) {
            document.querySelectorAll('.currency-dropdown').forEach(function(el) { el.classList.remove('show'); });
        }
        if (!e.target.closest('.language-selector')) {
            document.querySelectorAll('.lang-dropdown').forEach(function(el) { el.classList.remove('show'); });
        }
    });
    </script>
    </div><!-- #site-chrome -->
    <main id="main-content" class="page-main">

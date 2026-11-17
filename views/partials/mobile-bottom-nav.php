<?php
$mobileNavScript = basename($_SERVER['SCRIPT_NAME'] ?? $_SERVER['PHP_SELF'] ?? 'index.php');
$mobileNavHomeActive = in_array($mobileNavScript, ['index.php', ''], true);
$mobileNavShopActive = in_array($mobileNavScript, ['shop.php', 'product.php'], true);
$mobileNavWishActive = $mobileNavScript === 'wishlist.php';
$mobileNavAccountActive = in_array($mobileNavScript, ['login.php', 'register.php', 'profile.php', 'my-orders.php', 'track-order.php'], true);
$mobileNavLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']);
$mobileNavAccountUrl = $mobileNavLoggedIn ? BASE_URL . 'profile.php' : BASE_URL . 'login.php';

$mobileNavCategories = [];
try {
    if (!class_exists('CategoryDAL')) {
        require_once __DIR__ . '/../../dal/CategoryDAL.php';
    }
    if (!function_exists('translate_text')) {
        require_once __DIR__ . '/../../helpers/language.php';
    }
    $mobileNavCatDAL = new CategoryDAL();
    $mobileNavCategories = $mobileNavCatDAL->getActive();
} catch (Exception $e) {}
?>
<nav class="mobile-bottom-nav" id="mobileBottomNav" aria-label="Mobile navigation">
    <div class="mobile-bottom-nav-inner">
        <a href="<?php echo BASE_URL; ?>" class="mobile-nav-item<?php echo $mobileNavHomeActive ? ' is-active' : ''; ?>" data-nav="home">
            <span class="mobile-nav-dot" aria-hidden="true"></span>
            <i class="fas fa-home"></i>
            <span class="mobile-nav-label"><?php echo __t('home'); ?></span>
        </a>

        <button type="button" class="mobile-nav-item" id="mobileNavCategoriesBtn" data-nav="categories" aria-expanded="false" aria-controls="mobileCatSheet">
            <span class="mobile-nav-dot" aria-hidden="true"></span>
            <i class="fas fa-th"></i>
            <span class="mobile-nav-label"><?php echo __t('all_categories'); ?></span>
        </button>

        <a href="<?php echo BASE_URL; ?>shop.php" class="mobile-nav-item mobile-nav-item--shop<?php echo $mobileNavShopActive ? ' is-active' : ''; ?>" data-nav="shop">
            <span class="mobile-nav-shop-ring">
                <i class="fas fa-shopping-bag"></i>
            </span>
            <span class="mobile-nav-label"><?php echo __t('shop'); ?></span>
        </a>

        <a href="<?php echo BASE_URL; ?>wishlist.php" class="mobile-nav-item<?php echo $mobileNavWishActive ? ' is-active' : ''; ?>" data-nav="wishlist">
            <span class="mobile-nav-dot" aria-hidden="true"></span>
            <i class="far fa-heart"></i>
            <span class="mobile-nav-label"><?php echo __t('wishlist'); ?></span>
        </a>

        <a href="<?php echo $mobileNavAccountUrl; ?>" class="mobile-nav-item<?php echo $mobileNavAccountActive ? ' is-active' : ''; ?>" data-nav="account"<?php echo !$mobileNavLoggedIn ? ' data-turbo="false"' : ''; ?>>
            <span class="mobile-nav-dot" aria-hidden="true"></span>
            <i class="far fa-user"></i>
            <span class="mobile-nav-label"><?php echo __t('account'); ?></span>
        </a>
    </div>
</nav>

<div class="mobile-cat-overlay" id="mobileCatOverlay" hidden></div>
<div class="mobile-cat-sheet" id="mobileCatSheet" role="dialog" aria-modal="true" aria-labelledby="mobileCatSheetTitle" hidden>
    <div class="mobile-cat-sheet-header">
        <h3 id="mobileCatSheetTitle"><?php echo __t('all_categories'); ?></h3>
        <button type="button" class="mobile-cat-sheet-close" id="mobileCatSheetClose" aria-label="Close categories">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="mobile-cat-sheet-body">
        <a href="<?php echo BASE_URL; ?>shop.php" class="mobile-cat-sheet-item mobile-cat-sheet-all">
            <i class="fas fa-store"></i>
            <span><?php echo __t('shop'); ?></span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <?php foreach ($mobileNavCategories as $mCat): ?>
        <a href="<?php echo BASE_URL; ?>shop.php?category=<?php echo htmlspecialchars($mCat['slug']); ?>" class="mobile-cat-sheet-item">
            <span><?php echo htmlspecialchars(translate_text($mCat['name'])); ?></span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<script>
(function() {
    function mobileNavPage() {
        var path = window.location.pathname;
        var segments = path.split('/').filter(function(s) { return s; });
        var last = segments[segments.length - 1] || '';
        if (!last || last === 'ezymart' || last === 'index.php') return 'index.php';
        return last;
    }

    function syncMobileNavActive() {
        var page = mobileNavPage();
        var homePages = ['', 'index.php'];
        var shopPages = ['shop.php', 'product.php'];
        var accountPages = ['login.php', 'register.php', 'profile.php', 'my-orders.php', 'track-order.php'];

        document.querySelectorAll('.mobile-nav-item[data-nav]').forEach(function(item) {
            var nav = item.getAttribute('data-nav');
            var active = false;
            if (nav === 'home') active = homePages.indexOf(page) >= 0;
            else if (nav === 'shop') active = shopPages.indexOf(page) >= 0;
            else if (nav === 'wishlist') active = page === 'wishlist.php';
            else if (nav === 'account') active = accountPages.indexOf(page) >= 0;
            else if (nav === 'categories') active = item.getAttribute('aria-expanded') === 'true';

            item.classList.toggle('is-active', active);
        });
    }

    function initMobileCatSheet() {
        var btn = document.getElementById('mobileNavCategoriesBtn');
        var sheet = document.getElementById('mobileCatSheet');
        var overlay = document.getElementById('mobileCatOverlay');
        var closeBtn = document.getElementById('mobileCatSheetClose');
        if (!btn || !sheet || !overlay) return;

        function openSheet() {
            sheet.hidden = false;
            overlay.hidden = false;
            requestAnimationFrame(function() {
                sheet.classList.add('is-open');
                overlay.classList.add('is-open');
                btn.classList.add('is-active');
                btn.setAttribute('aria-expanded', 'true');
                document.body.classList.add('mobile-sheet-open');
            });
        }

        function closeSheet() {
            sheet.classList.remove('is-open');
            overlay.classList.remove('is-open');
            btn.classList.remove('is-active');
            btn.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('mobile-sheet-open');
            setTimeout(function() {
                sheet.hidden = true;
                overlay.hidden = true;
                syncMobileNavActive();
            }, 300);
        }

        btn.addEventListener('click', function() {
            if (sheet.classList.contains('is-open')) closeSheet();
            else openSheet();
        });

        if (closeBtn) closeBtn.addEventListener('click', closeSheet);
        overlay.addEventListener('click', closeSheet);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sheet.classList.contains('is-open')) closeSheet();
        });
    }

    document.addEventListener('turbo:load', function() {
        syncMobileNavActive();
        initMobileCatSheet();
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            syncMobileNavActive();
            initMobileCatSheet();
        });
    } else {
        syncMobileNavActive();
        initMobileCatSheet();
    }
})();
</script>

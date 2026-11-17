<?php
require_once __DIR__ . '/../config/app.php';
$pageTitle = __t('about_us') . " - " . SITE_NAME;
require_once __DIR__ . '/partials/header.php';

$aboutBannerUrl = null;
$aboutBannerRoot = dirname(__DIR__);
foreach (['webp', 'jpg', 'jpeg', 'png'] as $ext) {
    $candidate = 'assets/images/about/ezymart-about-banner.' . $ext;
    if (is_file($aboutBannerRoot . '/' . $candidate)) {
        $aboutBannerUrl = asset_image_url($candidate);
        break;
    }
}
?>

<style>
/* ===== VAANAKAM About Page ===== */
.lumak-about-hero {
    position: relative;
    padding: clamp(56px, 10vw, 88px) 0 clamp(110px, 15vw, 140px);
    background: #0F2B48;
    overflow: hidden;
    text-align: center;
    color: #fff;
    min-height: clamp(300px, 38vw, 480px);
    display: flex;
    align-items: center;
}
.lumak-about-hero.has-banner {
    background: #0A1C2A;
}
.lumak-about-hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}
.lumak-about-hero-bg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
    display: block;
}
.lumak-about-hero-overlay {
    position: absolute;
    inset: 0;
    z-index: 1;
    background:
        linear-gradient(180deg, rgba(15, 61, 36, 0.65) 0%, rgba(22, 163, 74, 0.75) 52%, rgba(10, 43, 24, 0.90) 100%),
        linear-gradient(90deg, rgba(15, 61, 36, 0.40) 0%, transparent 35%, transparent 65%, rgba(15, 61, 36, 0.40) 100%);
    pointer-events: none;
}
.lumak-about-hero .container {
    position: relative;
    z-index: 2;
    width: 100%;
}
.lumak-about-hero::before,
.lumak-about-hero::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}
.lumak-about-hero::before {
    width: min(480px, 90vw);
    height: min(480px, 90vw);
    top: -180px;
    right: -120px;
    background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
}
.lumak-about-hero::after {
    width: min(360px, 70vw);
    height: min(360px, 70vw);
    bottom: -140px;
    left: -80px;
    background: radial-gradient(circle, rgba(34, 197, 94, 0.25) 0%, transparent 70%);
}
.lumak-about-hero.has-banner::before,
.lumak-about-hero.has-banner::after {
    z-index: 2;
    opacity: 0.45;
}
.lumak-about-hero-inner {
    position: relative;
    z-index: 3;
    max-width: 720px;
    margin: 0 auto;
}
.lumak-about-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.14);
    border: 1px solid rgba(255,255,255,0.22);
    backdrop-filter: blur(8px);
    padding: 8px 18px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 20px;
}
.lumak-about-hero h1 {
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 800;
    line-height: 1.15;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
}
.lumak-about-hero h1 span {
    background: #F0FDF4;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.lumak-about-hero-lead {
    font-size: clamp(14px, 2.2vw, 16px);
    color: rgba(255,255,255,0.88);
    line-height: 1.75;
    max-width: 560px;
    margin: 0 auto;
}
.lumak-about-hero-hearts {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
    z-index: 2;
}
.lumak-about-hero-hearts i {
    position: absolute;
    color: rgba(255,255,255,0.12);
}
.lumak-about-hero-hearts .h1 { top: 18%; left: 8%; font-size: 20px; transform: rotate(-12deg); }
.lumak-about-hero-hearts .h2 { top: 28%; right: 10%; font-size: 28px; opacity: 0.7; }
.lumak-about-hero-hearts .h3 { bottom: 32%; left: 12%; font-size: 16px; transform: rotate(8deg); }

.lumak-about-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 0;
    max-width: 880px;
    margin: clamp(-70px, -8vw, -50px) auto 0;
    position: relative;
    z-index: 2;
    background: #fff;
    border-radius: 18px;
    border: 1px solid #DCFCE7;
    box-shadow: 0 16px 48px rgba(250, 188, 39, 0.12);
    overflow: hidden;
}
.lumak-about-stat {
    text-align: center;
    padding: clamp(18px, 3vw, 26px) 12px;
    border-right: 1px solid #DCFCE7;
}
.lumak-about-stat:last-child { border-right: none; }
.lumak-about-stat strong {
    display: block;
    font-size: clamp(1.25rem, 3vw, 1.6rem);
    font-weight: 800;
    color: #16A34A;
    line-height: 1.2;
    margin-bottom: 4px;
}
.lumak-about-stat span {
    font-size: 11px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.lumak-about-body {
    padding: clamp(48px, 7vw, 72px) 0 clamp(56px, 8vw, 80px);
    background: #F0FDF4;
}

.lumak-about-story {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: clamp(28px, 5vw, 48px);
    align-items: center;
    margin-bottom: clamp(40px, 6vw, 64px);
}
.lumak-about-story-visual {
    position: relative;
}
.lumak-about-story-frame {
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid #DCFCE7;
    box-shadow: 0 20px 50px rgba(250, 188, 39, 0.12);
    line-height: 0;
    background: #fff;
}
.lumak-about-story-frame img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    aspect-ratio: 4 / 3;
}
.lumak-about-story-float {
    position: absolute;
    bottom: -16px;
    right: -12px;
    background: #16A34A;
    color: #fff;
    padding: 14px 18px;
    border-radius: 14px;
    font-size: 12px;
    font-weight: 700;
    box-shadow: 0 8px 24px rgba(250, 188, 39, 0.35);
    display: flex;
    align-items: center;
    gap: 8px;
}
.lumak-about-story-float i { font-size: 16px; }
.lumak-about-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #16A34A;
    margin-bottom: 12px;
}
.lumak-about-story-text h2 {
    font-size: clamp(1.5rem, 3.5vw, 2rem);
    font-weight: 800;
    color: #0F2B48;
    line-height: 1.2;
    margin-bottom: 16px;
}
.lumak-about-story-text p {
    font-size: 14px;
    color: #555;
    line-height: 1.85;
    margin-bottom: 14px;
    text-align: justify;
    text-justify: inter-word;
}
.lumak-about-story-text p:last-child { margin-bottom: 0; }

/* Director / leadership */
.ez-director-section {
    margin-bottom: clamp(40px, 6vw, 64px);
}
.ez-director-card {
    display: grid;
    grid-template-columns: minmax(260px, 38%) minmax(0, 1fr);
    background: #fff;
    border-radius: 18px;
    border: 1px solid #F0FDF4;
    box-shadow: 0 16px 48px rgba(22, 163, 74, 0.12);
    overflow: hidden;
    min-height: 400px;
}
.ez-director-visual {
    position: relative;
    min-height: 280px;
    overflow: hidden;
}
.ez-director-visual-panel {
    position: relative;
    width: 100%;
    height: 100%;
    min-height: 280px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 14px;
    padding: 32px 24px;
    background:
        radial-gradient(circle at 18% 22%, rgba(255, 255, 255, 0.14) 0%, transparent 42%),
        radial-gradient(circle at 82% 78%, rgba(212, 175, 55, 0.16) 0%, transparent 38%),
        #0F2B48;
    color: #fff;
    text-align: center;
}
.ez-director-visual-glow {
    position: absolute;
    inset: auto;
    width: min(220px, 55%);
    height: min(220px, 55%);
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 72%);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}
.ez-director-visual-icons {
    position: absolute;
    inset: 0;
    pointer-events: none;
}
.ez-director-visual-icons i {
    position: absolute;
    color: rgba(255, 255, 255, 0.18);
}
.ez-director-visual-icons .icon-1 {
    top: 14%;
    left: 12%;
    font-size: 28px;
    transform: rotate(-12deg);
}
.ez-director-visual-icons .icon-2 {
    top: 18%;
    right: 14%;
    font-size: 22px;
}
.ez-director-visual-icons .icon-3 {
    bottom: 16%;
    left: 16%;
    font-size: 20px;
    transform: rotate(8deg);
}
.ez-director-visual-center {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}
.ez-director-visual-logo {
    width: auto;
    height: 54px;
    background: #fff;
    padding: 6px 14px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.ez-director-visual-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.18);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.ez-director-visual-badge i {
    color: #16A34A;
}
.ez-director-visual-name {
    font-size: clamp(1rem, 2vw, 1.15rem);
    font-weight: 700;
    line-height: 1.35;
    max-width: 16ch;
}
.ez-director-visual-role {
    font-size: 12px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.78);
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.ez-director-message {
    padding: clamp(28px, 4vw, 38px) clamp(28px, 4vw, 40px);
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.ez-director-head {
    margin-bottom: 20px;
    padding-bottom: 18px;
    border-bottom: 1px solid #EEF2F8;
}
.ez-director-label {
    display: block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #16A34A;
    margin-bottom: 10px;
}
.ez-director-head h2 {
    font-size: clamp(1.2rem, 2.5vw, 1.55rem);
    font-weight: 800;
    color: #0f172a;
    line-height: 1.25;
    margin: 0 0 8px;
    letter-spacing: -0.02em;
}
.ez-director-meta {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
}
.ez-director-meta strong {
    color: #16A34A;
    font-weight: 600;
}
.ez-director-message blockquote {
    margin: 0 0 22px;
    padding: 0;
    border: none;
}
.ez-director-message blockquote p {
    font-size: 14px;
    color: #475569;
    line-height: 1.8;
    margin: 0 0 10px;
}
.ez-director-message blockquote p:last-child {
    margin-bottom: 0;
}
.ez-director-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    padding-top: 16px;
    border-top: 1px solid #EEF2F8;
    margin-top: auto;
}
.ez-director-footer-text {
    font-size: 12px;
    color: #64748b;
    line-height: 1.5;
}
.ez-director-footer-text strong {
    display: block;
    font-size: 13px;
    color: #0f172a;
    margin-bottom: 2px;
}
.ez-director-footer img {
    height: 48px;
    width: auto;
    object-fit: contain;
    opacity: 0.85;
}

.lumak-about-pillars {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: clamp(40px, 6vw, 56px);
}
.lumak-about-pillar {
    background: #fff;
    border: 1px solid #DCFCE7;
    border-radius: 18px;
    padding: 28px 24px;
    text-align: center;
    transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
}
.lumak-about-pillar:hover {
    transform: translateY(-4px);
    border-color: #d4c0ff;
    box-shadow: 0 14px 36px rgba(250, 188, 39, 0.1);
}
.lumak-about-pillar-icon {
    width: 52px;
    height: 52px;
    margin: 0 auto 16px;
    border-radius: 14px;
    background: #16A34A;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 8px 20px rgba(250, 188, 39, 0.28);
}
.lumak-about-pillar h3 {
    font-size: 16px;
    font-weight: 700;
    color: #0F2B48;
    margin-bottom: 10px;
}
.lumak-about-pillar p {
    font-size: 13px;
    color: #666;
    line-height: 1.7;
    margin: 0;
}

.lumak-about-section-head {
    text-align: center;
    max-width: 620px;
    margin: 0 auto clamp(28px, 4vw, 40px);
}
.lumak-about-section-head h2 {
    font-size: clamp(1.4rem, 3vw, 1.75rem);
    font-weight: 800;
    color: #0F2B48;
    margin-bottom: 10px;
}
.lumak-about-section-head p {
    font-size: 14px;
    color: #666;
    line-height: 1.7;
    margin: 0;
}

.lumak-about-values {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: clamp(40px, 6vw, 56px);
}
.lumak-about-value {
    display: flex;
    gap: 16px;
    align-items: flex-start;
    background: #fff;
    border: 1px solid #DCFCE7;
    border-radius: 16px;
    padding: 22px 20px;
    transition: border-color 0.2s;
}
.lumak-about-value:hover { border-color: #d4c0ff; }
.lumak-about-value > i {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    border-radius: 12px;
    background: #DCFCE7;
    color: #16A34A;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}
.lumak-about-value h4 {
    font-size: 14px;
    font-weight: 700;
    color: #0F2B48;
    margin-bottom: 6px;
}
.lumak-about-value p {
    font-size: 13px;
    color: #666;
    line-height: 1.65;
    margin: 0;
}

.lumak-about-collections {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: clamp(40px, 6vw, 56px);
}
.lumak-about-collection {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 18px;
    background: #fff;
    border: 1px solid #DCFCE7;
    border-radius: 14px;
    text-decoration: none;
    color: inherit;
    transition: all 0.25s;
}
.lumak-about-collection:hover {
    border-color: #16A34A;
    background: #faf8ff;
    transform: translateX(4px);
    color: inherit;
}
.lumak-about-collection i {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #F0FDF4;
    color: #16A34A;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}
.lumak-about-collection span {
    font-size: 13px;
    font-weight: 600;
    color: #333;
    line-height: 1.35;
}

.lumak-about-contact-strip {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: clamp(32px, 5vw, 48px);
}
.lumak-about-contact-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 20px;
    background: #fff;
    border: 1px solid #DCFCE7;
    border-radius: 14px;
}
.lumak-about-contact-item > i {
    font-size: 22px;
    color: #16A34A;
    flex-shrink: 0;
}
.lumak-about-contact-item strong {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #0F2B48;
    margin-bottom: 2px;
}
.lumak-about-contact-item span,
.lumak-about-contact-item a {
    font-size: 12px;
    color: #666;
    text-decoration: none;
    line-height: 1.5;
}
.lumak-about-contact-item a:hover { color: #16A34A; }

.lumak-about-cta {
    background: #16A34A;
    border-radius: 22px;
    padding: clamp(36px, 5vw, 52px) clamp(24px, 4vw, 40px);
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.lumak-about-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
    pointer-events: none;
}
.lumak-about-cta h3 {
    font-size: clamp(1.25rem, 3vw, 1.6rem);
    font-weight: 800;
    margin-bottom: 10px;
    position: relative;
}
.lumak-about-cta > p {
    font-size: 14px;
    color: rgba(255,255,255,0.85);
    margin-bottom: 24px;
    max-width: 480px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
}
.lumak-about-cta-btns {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    position: relative;
}
.lumak-about-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 26px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
}
.lumak-about-cta-btn.primary {
    background: #fff;
    color: #16A34A;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}
.lumak-about-cta-btn.primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.15);
    color: #16A34A;
}
.lumak-about-cta-btn.secondary {
    background: rgba(255,255,255,0.12);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.28);
}
.lumak-about-cta-btn.secondary:hover {
    background: rgba(255,255,255,0.2);
    color: #fff;
}

@media (min-width: 993px) {
    .ez-director-visual,
    .ez-director-visual-panel {
        min-height: 100%;
        height: 100%;
    }
}
@media (max-width: 992px) {
    .lumak-about-story { grid-template-columns: 1fr; }
    .lumak-about-story-float { right: 12px; bottom: -12px; }
    .ez-director-card { grid-template-columns: 1fr; min-height: 0; }
    .ez-director-visual { max-height: 360px; overflow: hidden; }
    .ez-director-visual-panel { min-height: 360px; }
    .lumak-about-pillars { grid-template-columns: 1fr; }
    .lumak-about-collections { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

@media (max-width: 768px) {
    .lumak-about-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .lumak-about-stat:nth-child(2) { border-right: none; }
    .lumak-about-stat:nth-child(-n+2) { border-bottom: 1px solid #DCFCE7; }
    .lumak-about-values { grid-template-columns: 1fr; }
    .lumak-about-contact-strip { grid-template-columns: 1fr; }
    .lumak-about-collections { grid-template-columns: 1fr; }
}

@media (max-width: 480px) {
    .lumak-about-cta-btns { flex-direction: column; align-items: stretch; }
    .lumak-about-cta-btn { justify-content: center; }
}
</style>

<!-- Hero -->
<header class="lumak-about-hero<?php echo $aboutBannerUrl ? ' has-banner' : ''; ?>">
    <?php if ($aboutBannerUrl): ?>
    <div class="lumak-about-hero-bg" aria-hidden="true">
        <img src="<?php echo htmlspecialchars($aboutBannerUrl); ?>"
             alt=""
             width="1920"
             height="520"
             loading="eager"
             fetchpriority="high"
             decoding="async">
    </div>
    <div class="lumak-about-hero-overlay" aria-hidden="true"></div>
    <?php endif; ?>
    <div class="lumak-about-hero-hearts" aria-hidden="true">
        <i class="fas fa-leaf h1"></i>
        <i class="fas fa-seedling h2"></i>
        <i class="fas fa-bottle-droplet h3"></i>
    </div>
    <div class="container">
        <div class="lumak-about-hero-inner">
            <span class="lumak-about-hero-badge"><i class="fas fa-leaf"></i> 100% Pure &amp; Natural Groceries</span>
            <h1>About <span><?php echo SITE_NAME; ?></span></h1>
            <p class="lumak-about-hero-lead">Sri Lanka's trusted destination for authentic cold-pressed oils, premium cashews, traditional grains, and natural grocery essentials by <?php echo STORE_OWNER; ?>. Pure food, island wide delivery, and healthy living from Mullaitivu.</p>
        </div>
    </div>
</header>

<!-- Stats -->
<div class="container">
    <div class="lumak-about-stats">
        <div class="lumak-about-stat"><strong>100%</strong><span>Pure &amp; Natural</span></div>
        <div class="lumak-about-stat"><strong>100+</strong><span>Grocery Items</span></div>
        <div class="lumak-about-stat"><strong>24/7</strong><span>Customer Care</span></div>
        <div class="lumak-about-stat"><strong>SL</strong><span>Island Wide Delivery</span></div>
    </div>
</div>

<section class="lumak-about-body">
    <div class="container">

        <!-- Our Story -->
        <div class="lumak-about-story">
            <div class="lumak-about-story-visual">
                <div class="lumak-about-story-frame">
                    <?php echo render_asset_image('assets/images/about/ezymart-skincare-collection.png', [
                        'alt' => 'Featured collection at Vaanakam',
                        'loading' => 'lazy',
                        'width' => 800,
                        'height' => 600,
                    ]); ?>
                </div>
                <div class="lumak-about-story-float">
                    <i class="fas fa-truck"></i> Island Wide Delivery
                </div>
            </div>
            <div class="lumak-about-story-text">
                <span class="lumak-about-eyebrow"><i class="fas fa-leaf"></i> Who We Are</span>
                <h2>Your Trusted Natural Foods &amp; Grocery Store</h2>
                <p><?php echo SITE_NAME; ?> is a natural foods and organic grocery store operated by <?php echo STORE_OWNER; ?>. We offer a carefully selected range of authentic cold-pressed oils, premium cashews, traditional rice and grains, organic spices, and natural health products at fair prices.</p>
                <p>Based at <?php echo STORE_LOCATION; ?>, we serve families and health-conscious customers across Sri Lanka with fresh island wide delivery and friendly customer support. Guided by our motto <em>"Good Food - Healthy Life"</em>, <?php echo SITE_NAME; ?> is dedicated to making pure, unadulterated food accessible to every home.</p>
            </div>
        </div>

        <!-- Director -->
        <div class="ez-director-section">
            <div class="ez-director-card">
                <div class="ez-director-visual">
                    <div class="ez-director-visual-panel" aria-hidden="true">
                        <div class="ez-director-visual-glow"></div>
                        <div class="ez-director-visual-icons">
                            <i class="fas fa-leaf icon-1"></i>
                            <i class="fas fa-seedling icon-2"></i>
                            <i class="fas fa-store icon-3"></i>
                        </div>
                        <div class="ez-director-visual-center">
                            <?php echo render_asset_image('assets/images/logobottom.png', [
                                'alt' => SITE_NAME,
                                'class' => 'ez-director-visual-logo',
                                'loading' => 'lazy',
                            ]); ?>
                            <span class="ez-director-visual-badge"><i class="fas fa-user-tie"></i> Leadership</span>
                            <p class="ez-director-visual-name"><?php echo htmlspecialchars(STORE_DIRECTOR); ?></p>
                            <span class="ez-director-visual-role"><?php echo htmlspecialchars(STORE_DIRECTOR_TITLE); ?> · <?php echo htmlspecialchars(STORE_OWNER); ?></span>
                        </div>
                    </div>
                </div>
                <div class="ez-director-message">
                    <div class="ez-director-head">
                        <span class="ez-director-label">Leadership Message</span>
                        <h2><?php echo htmlspecialchars(STORE_DIRECTOR); ?></h2>
                        <p class="ez-director-meta"><strong><?php echo htmlspecialchars(STORE_DIRECTOR_TITLE); ?></strong> · <?php echo htmlspecialchars(STORE_OWNER); ?></p>
                    </div>
                    <blockquote>
                        <p><?php echo SITE_NAME; ?> was established with a singular passion: to bring pure, chemical-free, traditional groceries and healthy natural foods to Sri Lankan families. We believe that good health begins with pure food.</p>
                        <p>Every order is handled with genuine care — from pristine food-grade packaging to timely island wide delivery. We take pride in sourcing authentic cold-pressed oils, handpicked cashews, and traditional grains directly from trusted farmers.</p>
                        <p>Thank you for welcoming <?php echo SITE_NAME; ?> into your kitchen. Good Food - Healthy Life!</p>
                    </blockquote>
                    <div class="ez-director-footer">
                        <div class="ez-director-footer-text">
                            <strong><?php echo htmlspecialchars(STORE_DIRECTOR); ?></strong>
                            <?php echo htmlspecialchars(STORE_DIRECTOR_TITLE); ?>, <?php echo htmlspecialchars(STORE_OWNER); ?>
                        </div>
                        <?php echo render_asset_image('assets/images/logobottom.png', [
                            'alt' => SITE_NAME,
                            'class' => 'ez-director-footer-logo',
                            'loading' => 'lazy',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission pillars -->
        <div class="lumak-about-pillars">
            <div class="lumak-about-pillar">
                <div class="lumak-about-pillar-icon"><i class="fas fa-bullseye"></i></div>
                <h3>Our Mission</h3>
                <p>To deliver 100% pure, natural, and chemical-free groceries at fair prices with fresh island wide delivery and sincere customer care across Sri Lanka.</p>
            </div>
            <div class="lumak-about-pillar">
                <div class="lumak-about-pillar-icon"><i class="fas fa-eye"></i></div>
                <h3>Our Vision</h3>
                <p>To become Sri Lanka's most trusted natural foods brand, inspiring healthy lifestyles through pure, traditional foods and sustainable agriculture.</p>
            </div>
            <div class="lumak-about-pillar">
                <div class="lumak-about-pillar-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3>Our Promise</h3>
                <p>Every grocery item is chemical-free, carefully inspected, and packed fresh for your family's health and wellbeing. Good food is our personal guarantee at <?php echo SITE_NAME; ?>.</p>
            </div>
        </div>

        <!-- Values -->
        <div class="lumak-about-section-head">
            <h2>What We Stand For</h2>
            <p>The values behind every product, every package, and every customer conversation at <?php echo SITE_NAME; ?>.</p>
        </div>
        <div class="lumak-about-values">
            <div class="lumak-about-value">
                <i class="fas fa-leaf"></i>
                <div>
                    <h4>100% Pure &amp; Chemical Free</h4>
                    <p>Naturally processed foods without harmful preservatives, artificial additives, or chemical adulteration.</p>
                </div>
            </div>
            <div class="lumak-about-value">
                <i class="fas fa-seedling"></i>
                <div>
                    <h4>Farm Fresh &amp; Traditional</h4>
                    <p>Authentic cold-pressed oils, hand-harvested cashews, and traditional grains that preserve natural nutrition.</p>
                </div>
            </div>
            <div class="lumak-about-value">
                <i class="fas fa-truck"></i>
                <div>
                    <h4>Island Wide Delivery</h4>
                    <p>Secure checkout, careful packaging, and reliable shipping to your doorstep anywhere in Sri Lanka.</p>
                </div>
            </div>
            <div class="lumak-about-value">
                <i class="fas fa-headset"></i>
                <div>
                    <h4>Customer First</h4>
                    <p>We listen, we care, and we support you before and after every order at <?php echo SITE_NAME; ?>.</p>
                </div>
            </div>
        </div>

        <!-- Collections -->
        <div class="lumak-about-section-head">
            <h2>Our Natural Food Categories</h2>
            <p>Explore natural groceries and healthy living essentials at <?php echo SITE_NAME; ?>.</p>
        </div>
        <div class="lumak-about-collections">
            <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-about-collection"><i class="fas fa-bottle-droplet"></i><span>Pure Cold-Pressed Oils</span></a>
            <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-about-collection"><i class="fas fa-wheat-awn"></i><span>Rice &amp; Traditional Grains</span></a>
            <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-about-collection"><i class="fas fa-seedling"></i><span>Cashews &amp; Dry Fruits</span></a>
            <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-about-collection"><i class="fas fa-mortar-pestle"></i><span>Organic Spices &amp; Masala</span></a>
            <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-about-collection"><i class="fas fa-jar"></i><span>Natural Honey &amp; Sweets</span></a>
            <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-about-collection"><i class="fas fa-leaf"></i><span>Herbal &amp; Health Foods</span></a>
        </div>

        <!-- Contact -->
        <div class="lumak-about-contact-strip">
            <div class="lumak-about-contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <strong>Location</strong>
                    <span><?php echo STORE_LOCATION; ?></span>
                </div>
            </div>
            <div class="lumak-about-contact-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <strong>Call Us</strong>
                    <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_1); ?>"><?php echo STORE_PHONE_1; ?></a>
                    <span> / </span>
                    <a href="tel:<?php echo preg_replace('/\s+/', '', STORE_PHONE_2); ?>"><?php echo STORE_PHONE_2; ?></a>
                </div>
            </div>
            <div class="lumak-about-contact-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <strong>Email</strong>
                    <a href="mailto:<?php echo STORE_EMAIL; ?>"><?php echo STORE_EMAIL; ?></a>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="lumak-about-cta">
            <h3>Good Food - Healthy Life</h3>
            <p>Ready to experience fresh, chemical-free groceries and authentic natural foods? Explore our pantry essentials or reach out to us anytime.</p>
            <div class="lumak-about-cta-btns">
                <a href="<?php echo BASE_URL; ?>shop.php" class="lumak-about-cta-btn primary"><i class="fas fa-shopping-bag"></i> Shop Fresh Groceries</a>
                <a href="<?php echo BASE_URL; ?>contact.php" class="lumak-about-cta-btn secondary"><i class="fas fa-envelope"></i> Contact Us</a>
                <a href="https://wa.me/<?php echo STORE_WHATSAPP; ?>" target="_blank" rel="noopener" class="lumak-about-cta-btn secondary"><i class="fab fa-whatsapp"></i> WhatsApp</a>
            </div>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

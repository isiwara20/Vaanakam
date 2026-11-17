<?php
require_once __DIR__ . '/../config/app.php';
$pageTitle = __t('forgot_password') . " - " . SITE_NAME;
$pagePreloadImages = [asset_image_url('assets/images/login-couple3.png')];
require_once __DIR__ . '/partials/header.php';

// Get flash messages
$fpError = $_SESSION['fp_error'] ?? '';
$fpSuccess = $_SESSION['fp_success'] ?? '';
$fpEmail = $_SESSION['fp_email'] ?? '';
unset($_SESSION['fp_error'], $_SESSION['fp_success'], $_SESSION['fp_email']);
?>

<!-- Forgot Password Section -->
<section class="login-section">
    <div class="container">
        <div class="login-wrapper forgot-wrapper">
            <!-- Left: Forgot Password Form -->
            <div class="login-form-container">
                <div class="forgot-icon-wrap">
                    <span class="forgot-lock-icon">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <h1><?php echo __t('forgot_password_q'); ?></h1>
                <p class="login-subtitle"><?php echo __t('forgot_password_desc'); ?></p>

                <?php if ($fpError): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($fpError); ?>
                    </div>
                <?php endif; ?>

                <?php if ($fpSuccess): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($fpSuccess); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>controllers/AuthController.php" method="POST" class="login-form">
                    <input type="hidden" name="action" value="forgot_password">

                    <div class="form-group">
                        <label for="email"><?php echo __t('email_address'); ?></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" 
                                   placeholder="<?php echo htmlspecialchars(__t('enter_email_placeholder')); ?>" 
                                   value="<?php echo htmlspecialchars($fpEmail); ?>" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <span><?php echo __t('send_reset_link'); ?></span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>

                <div class="back-to-login">
                    <a href="<?php echo BASE_URL; ?>login.php">
                        <i class="fas fa-arrow-left"></i> <?php echo __t('back_to_login'); ?>
                    </a>
                </div>
            </div>

            <!-- Right: Branding Panel -->
            <div class="login-brand-panel">
                <?php echo render_asset_image('assets/images/login-couple3.png', [
                    'alt' => SITE_NAME,
                    'class' => 'brand-panel-img',
                    'fetchpriority' => 'high',
                    'loading' => 'eager',
                    'decoding' => 'async',
                ]); ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

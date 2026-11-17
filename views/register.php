<?php
require_once __DIR__ . '/../config/app.php';
$pageTitle = __t('login_register') . " - " . SITE_NAME;
$pagePreloadImages = [asset_image_url('assets/images/login-couple2.png')];
require_once __DIR__ . '/partials/header.php';

// Get flash messages
$registerError = $_SESSION['register_error'] ?? '';
$registerSuccess = $_SESSION['register_success'] ?? '';
$registerName = $_SESSION['register_name'] ?? '';
$registerEmail = $_SESSION['register_email'] ?? '';
$registerPhone = $_SESSION['register_phone'] ?? '';
unset($_SESSION['register_error'], $_SESSION['register_success'], $_SESSION['register_name'], $_SESSION['register_email'], $_SESSION['register_phone']);
?>

<!-- Register Section -->
<section class="login-section">
    <div class="container">
        <div class="login-wrapper">
            <!-- Left: Register Form -->
            <div class="login-form-container">
                <h1><?php echo __t('create_account'); ?></h1>
                <p class="login-subtitle"><?php echo __t('register_subtitle'); ?></p>

                <?php if ($registerError): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($registerError); ?>
                    </div>
                <?php endif; ?>

                <?php if ($registerSuccess): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($registerSuccess); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>controllers/AuthController.php" method="POST" class="login-form" data-turbo="false">
                    <input type="hidden" name="action" value="register">

                    <div class="form-group">
                        <label for="name"><?php echo __t('full_name'); ?></label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="name" name="name" 
                                   placeholder="<?php echo htmlspecialchars(__t('enter_name_placeholder')); ?>" 
                                   value="<?php echo htmlspecialchars($registerName); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email"><?php echo __t('email_address'); ?></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" 
                                   placeholder="<?php echo htmlspecialchars(__t('enter_email_placeholder')); ?>" 
                                   value="<?php echo htmlspecialchars($registerEmail); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone"><?php echo __t('phone_number'); ?></label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone-alt input-icon"></i>
                            <input type="tel" id="phone" name="phone" 
                                   placeholder="<?php echo htmlspecialchars(__t('enter_phone_placeholder')); ?>" 
                                   value="<?php echo htmlspecialchars($registerPhone); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password"><?php echo __t('password'); ?></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" 
                                   placeholder="<?php echo htmlspecialchars(__t('create_password_placeholder')); ?>" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password', 'eyeIcon1')">
                                <i class="fas fa-eye" id="eyeIcon1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password"><?php echo __t('confirm_password'); ?></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="confirm_password" name="confirm_password" 
                                   placeholder="<?php echo htmlspecialchars(__t('confirm_password_placeholder')); ?>" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('confirm_password', 'eyeIcon2')">
                                <i class="fas fa-eye" id="eyeIcon2"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="terms" required>
                            <span><?php echo __t('agree_terms_prefix'); ?> <a href="<?php echo BASE_URL; ?>terms.php" class="forgot-password"><?php echo __t('terms_conditions'); ?></a> <?php echo __t('and'); ?> <a href="<?php echo BASE_URL; ?>privacy.php" class="forgot-password"><?php echo __t('privacy_policy'); ?></a></span>
                        </label>
                    </div>

                    <button type="submit" class="btn-login">
                        <span><?php echo __t('create_account_btn'); ?></span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <p class="register-link">
                    <?php echo __t('already_have_account'); ?> <a href="<?php echo BASE_URL; ?>login.php"><?php echo __t('login_now'); ?></a>
                </p>
            </div>

            <!-- Right: Branding Panel -->
            <div class="login-brand-panel">
                <?php echo render_asset_image('assets/images/login-couple2.png', [
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

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

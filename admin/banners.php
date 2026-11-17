<?php
$currentPage = 'banners';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../dal/BannerDAL.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

$bannerDAL = new BannerDAL();
$adminName = $_SESSION['user_name'] ?? 'Admin';
$message = '';
$messageType = 'success';

// Handle upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && empty($_FILES) && (int)($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
    $message = 'The uploaded file exceeds the post_max_size (' . ini_get('post_max_size') . ') in server PHP settings.';
    $messageType = 'error';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'upload') {
    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['banner_image'];
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if (in_array($file['type'], $allowed) && $file['size'] < 15 * 1024 * 1024) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $filename = 'banner_' . time() . '_' . uniqid() . '.' . $ext;
            $uploadDir = __DIR__ . '/../assets/uploads/banners/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                // Convert to high-quality WebP while keeping memory safe on shared hosting
                require_once __DIR__ . '/../services/ImageOptimizer.php';
                $optimizedPath = ImageOptimizer::optimizeBanner($dest, 90);
                $optimizedFilename = basename($optimizedPath ?: $dest);
                
                $title = trim($_POST['title'] ?? '');
                $link = trim($_POST['link'] ?? '');
                $sortOrder = (int)($_POST['sort_order'] ?? 0);
                $bannerDAL->create($title, 'assets/uploads/banners/' . $optimizedFilename, $link, $sortOrder);
                $message = 'Banner uploaded successfully!';
                $messageType = 'success';
            } else {
                $message = 'Failed to move uploaded file. Check folder write permissions on assets/uploads/banners.';
                $messageType = 'error';
            }
        } else {
            $message = 'Invalid file. Please use a JPG, PNG, or WebP image under 15MB.';
            $messageType = 'error';
        }
    } else {
        $errCode = $_FILES['banner_image']['error'] ?? UPLOAD_ERR_NO_FILE;
        $messageType = 'error';
        switch ($errCode) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $message = 'The file is too large for the server. Server upload_max_filesize limit is currently ' . ini_get('upload_max_filesize') . '. Increase it in cPanel > MultiPHP INI Editor.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = 'File upload was interrupted. Please try again.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = 'No file was chosen. Please select an image.';
                break;
            default:
                $message = 'Upload failed with error code: ' . $errCode;
                break;
        }
    }
}

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $bannerDAL->delete((int)$_POST['id']);
    header('Location: ' . BASE_URL . 'admin/banners.php');
    exit;
}

// Handle status toggle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'toggle') {
    $newStatus = $_POST['status'] === 'active' ? 'inactive' : 'active';
    $bannerDAL->updateStatus((int)$_POST['id'], $newStatus);
    header('Location: ' . BASE_URL . 'admin/banners.php');
    exit;
}

$banners = $bannerDAL->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . '/partials/favicon.php'; ?>
    <title>Banners - Admin</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/admin.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-layout">
        <?php include __DIR__ . '/partials/sidebar.php'; ?>

        <main class="main-content">
            <?php include __DIR__ . '/partials/topbar.php'; ?>

            <div class="dashboard-content">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Banner Management</h1>
                        <p class="page-subtitle">Manage homepage slider banners</p>
                    </div>
                </div>

                <?php if ($message): ?>
                <div style="padding:14px 20px; border-radius:10px; margin-bottom:20px; font-size:13px; background:<?php echo $messageType === 'error' ? '#fef2f2' : '#ecfdf5'; ?>; color:<?php echo $messageType === 'error' ? '#b91c1c' : '#065f46'; ?>; border:1px solid <?php echo $messageType === 'error' ? '#fecaca' : '#a7f3d0'; ?>;">
                    <i class="fas fa-<?php echo $messageType === 'error' ? 'exclamation-circle' : 'check-circle'; ?>"></i> <?php echo htmlspecialchars($message); ?>
                </div>
                <?php endif; ?>

                <!-- Upload Form -->
                <div style="background:#fff; border:1px solid #eee; border-radius:14px; padding:28px; margin-bottom:24px;">
                    <h3 style="font-size:15px; font-weight:700; color:#0F2B48; margin-bottom:16px;">Upload New Banner</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="upload">
                        <div style="display:grid; grid-template-columns:1fr 1fr 100px; gap:14px; align-items:end;">
                            <div>
                                <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:6px;">Banner Image (1200x400 recommended)</label>
                                <input type="file" name="banner_image" accept="image/*" required style="width:100%; padding:10px; border:1.5px solid #e4e8f0; border-radius:10px; font-size:12px;">
                            </div>
                            <div>
                                <label style="display:block; font-size:12px; font-weight:600; color:#333; margin-bottom:6px;">Title (optional)</label>
                                <input type="text" name="title" placeholder="Banner title" style="width:100%; padding:10px 14px; border:1.5px solid #e4e8f0; border-radius:10px; font-family:'Poppins',sans-serif; font-size:13px;">
                            </div>
                            <button type="submit" style="padding:11px 20px; background:#14532D; color:#fff; border:none; border-radius:10px; font-family:'Poppins',sans-serif; font-size:12px; font-weight:600; cursor:pointer; height:42px;">
                                <i class="fas fa-upload"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Banners Grid -->
                <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:16px;">
                    <?php foreach ($banners as $b): ?>
                    <div style="background:#fff; border:1px solid #eee; border-radius:12px; overflow:hidden;">
                        <img src="<?php echo htmlspecialchars(media_image_url($b['image'])); ?>" alt="" style="width:100%; height:150px; object-fit:cover;">
                        <div style="padding:14px; display:flex; align-items:center; justify-content:space-between;">
                            <div>
                                <strong style="font-size:13px; color:#0F2B48;"><?php echo htmlspecialchars($b['title'] ?: 'Banner #' . $b['id']); ?></strong>
                                <span style="display:block; font-size:11px; color:<?php echo $b['status'] === 'active' ? '#16a34a' : '#ef4444'; ?>; font-weight:600; margin-top:2px;"><?php echo ucfirst($b['status']); ?></span>
                            </div>
                            <div style="display:flex; gap:6px;">
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="toggle">
                                    <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                    <input type="hidden" name="status" value="<?php echo $b['status']; ?>">
                                    <button type="submit" style="padding:6px 10px; background:#f0f2f8; border:none; border-radius:6px; cursor:pointer; font-size:11px;" title="Toggle">
                                        <i class="fas fa-<?php echo $b['status'] === 'active' ? 'eye-slash' : 'eye'; ?>"></i>
                                    </button>
                                </form>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this banner?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                    <button type="submit" style="padding:6px 10px; background:#fef2f2; color:#ef4444; border:none; border-radius:6px; cursor:pointer; font-size:11px;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if (empty($banners)): ?>
                    <div style="padding:40px; text-align:center; color:#999; font-size:13px; grid-column:1/-1;">
                        <i class="fas fa-images" style="font-size:32px; display:block; margin-bottom:10px; color:#ddd;"></i>
                        No banners uploaded yet. Upload your first banner above.
                    </div>
                    <?php endif; ?>
                </div>

                <div class="admin-footer" style="margin-top:40px;">
                    <p>&copy; 2026 VAANAKAM. All rights reserved.</p>
                </div>
            </div>
        </main>
    </div>

    <script>
    document.getElementById('menuToggle').addEventListener('click', function() {
        document.querySelector('.admin-layout').classList.toggle('sidebar-collapsed');
    });
    </script>
</body>
</html>

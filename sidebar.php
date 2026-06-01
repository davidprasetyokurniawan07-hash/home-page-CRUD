<?php

require_once __DIR__ . '/../config/config.php';

$current = basename($_SERVER['PHP_SELF']);
$user = getUser();
$initials = strtoupper(substr($user['full_name'], 0, 1) . (strpos($user['full_name'], ' ') !== false ? substr($user['full_name'], strpos($user['full_name'], ' ') + 1, 1) : ''));

global $conn;
$totalKaryawan = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM karyawan WHERE status='aktif'"))[0] ?? 0;
?>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo-icon">👥</div>
        <div class="sidebar-brand">
            
            <span>v1.0 · <?= APP_NAME ?></span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>

        <div class="nav-item">
            <a href="<?= BASE_URL ?>index.php" class="nav-link <?= $current === 'index.php' ? 'active' : '' ?>">
                <span class="icon">🏠</span>
                
            </a>
        </div>
        <div class="nav-item">
            <a href="<?= BASE_URL ?>pages/karyawan.php" class="nav-link <?= $current === 'karyawan.php' ? 'active' : '' ?>">
                <span class="icon">👤</span>
                
                <span class="badge"><?= $totalKaryawan ?></span>
            </a>
        </div>
        <div class="nav-item">
            <a href="<?= BASE_URL ?>pages/departemen.php" class="nav-link <?= $current === 'departemen.php' ? 'active' : '' ?>">
                <span class="icon">🏢</span>
              
            </a>
        </div>

        <?php if (isAdmin()): ?>
        <div class="nav-section-label">Administrasi</div>
        <div class="nav-item">
            <a href="<?= BASE_URL ?>pages/users.php" class="nav-link <?= $current === 'users.php' ? 'active' : '' ?>">
                <span class="icon">🔐</span>
                
            </a>
        </div>
        <?php endif; ?>

        <div class="nav-section-label">Akun</div>
        <div class="nav-item">
            <a href="<?= BASE_URL ?>pages/profile.php" class="nav-link <?= $current === 'profile.php' ? 'active' : '' ?>">
                <span class="icon">⚙️</span>
             
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar"><?= htmlspecialchars($initials) ?></div>
            <div class="user-info">
                <div class="user-name"><?= htmlspecialchars($user['full_name']) ?></div>
                <div class="user-role"><?= ucfirst($user['role']) ?></div>
            </div>
            <a href="<?= BASE_URL ?>logout.php" class="logout-btn" title="Logout">⏻</a>
        </div>
    </div>
</aside>
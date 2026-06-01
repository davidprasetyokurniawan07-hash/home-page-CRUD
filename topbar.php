<?php
$user = getUser();
?>
<header class="topbar">
    <div class="topbar-left">
        <button class="hamburger" onclick="toggleSidebar()">☰</button>
        <div>
            <div class="page-title"><?= $pageTitle ?? 'Dashboard' ?></div>
            <div class="breadcrumb">HR System / <span><?= $pageTitle ?? 'Dashboard' ?></span></div>
        </div>
    </div>
    <div class="topbar-right">
        <input type="text" class="topbar-search" placeholder="🔍  Cari..." id="globalSearch" onkeyup="globalSearchFn(this.value)">
        <div style="width:1px;height:30px;background:var(--border);"></div>
        <span style="font-size:0.78rem;color:var(--text-muted);">
            <?= date('d M Y') ?>
        </span>
    </div>
</header>
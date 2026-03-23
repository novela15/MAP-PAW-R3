<!DOCTYPE html>

<html>
    <head>
        <script>
            // I feel this is a bit hacky, I need to set classes on the root document element to prevent the
            // sidebar from flickering when reloaded quick enough.
            if (localStorage.getItem("is_sidebar_collapsed") === "true") {
                document.documentElement.classList.add("sidebar-collapsed");
            }
        </script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo SKELETON_PATH; ?>skeleton.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    </head>

    <body>
        <div class="sidebar no-transition">
            <div class="sidebar-header">
                <button class="sidebar-toggle-button" title="Sembunyikan/munculkan sidebar"><i class="fas fa-bars"></i></button>
            </div>

            <div class="sidebar-label">Menu</div>

            <button class="sidebar-button">
                <i class="icon fa-solid fa-book"></i>
                <span class="text">Buku Anggaran</span>
            </button>
            <button class="sidebar-button budget-category">
                <i class="icon fa-solid fa-tag"></i>
                <span class="text">Kategori Anggaran</span>
            </button>
            <button class="sidebar-button budget-account">
                <i class="icon fa-solid fa-university"></i>
                <span class="text">Akun Anggaran</span>
            </button>
            <button class="sidebar-button">
                <i class="icon fa-solid fa-file-invoice-dollar"></i>
                <span class="text">Catat Belanja</span>
            </button>
            <button class="sidebar-button has-submenu">
                <i class="icon fa-solid fa-chart-bar"></i>
                <span class="text">Laporan</span>
                <i class="fas fa-chevron-right submenu-icon"></i>
            </button>
            <div class="submenu hidden">
                <button class="sidebar-button">
                    <i class="icon fa-solid fa-journal-whills"></i>
                    <span class="text">Jurnal Umum</span>
                </button>
                <button class="sidebar-button selected-sidebar-button">
                    <i class="icon fa-solid fa-columns"></i>
                    <span class="text">Buku Besar</span>
                </button>
                <button class="sidebar-button">
                    <i class="icon fa-solid fa-chart-line"></i>
                    <span class="text">Realisasi Anggaran</span>
                </button>
            </div>
            <button class="sidebar-button">
                <i class="icon fa-solid fa-lock"></i>
                <span class="text">Tutup Buku</span>
            </button>

            <div class="filler"></div>

            <form action="logout" method="POST">
                <button class="sidebar-button sidebar-logout-button" name="logout_button" type="submit">
                    <i class="icon fa-solid fa-sign-out-alt"></i>
                    <span class="text">Keluar</span>
                </button>
            </form>
        </div>
        <div class="container no-transition">

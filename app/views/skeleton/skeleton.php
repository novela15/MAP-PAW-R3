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

        <title>MAP - <?php echo $pageTitle ?? "Unknown"; ?></title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/skeleton/skeleton.css?v=<?php echo time();?>">
        <link rel="stylesheet" href="frontend/modal/modal.css?v=<?php echo time();?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    </head>

    <body>
        <div class="modal-overlay hidden"></div>

        <div class="sidebar no-transition">
            <div class="sidebar-header">
                <button class="sidebar-toggle-button" title="Sembunyikan/munculkan sidebar"><i class="fas fa-bars"></i></button>
                <div class="filler"></div>
                <img class="sidebar-icon" src="assets/map_icon_256.png">
            </div>

            <div class="sidebar-label">MENU</div>

            <a class="sidebar-button" href="budget-book">
                <i class="icon fa-solid fa-book"></i>
                <span class="text">Buku Anggaran</span>
            </a>
            <a class="sidebar-button" href="budget-category">
                <i class="icon fa-solid fa-tag"></i>
                <span class="text">Kategori Anggaran</span>
            </a>
            <a class="sidebar-button" href="budget-account">
                <i class="icon fa-solid fa-university"></i>
                <span class="text">Akun Anggaran</span>
            </a>
            <a class="sidebar-button" href="record-expense">
                <i class="icon fa-solid fa-file-invoice-dollar"></i>
                <span class="text">Catat Belanja</span>
            </a>
            <button class="sidebar-button has-submenu">
                <i class="icon fa-solid fa-chart-bar"></i>
                <span class="text">Laporan</span>
                <i class="fas fa-chevron-right submenu-icon"></i>
            </button>
            <div class="submenu hidden">
                <a class="sidebar-button" href="general-journal">
                    <i class="icon fa-solid fa-journal-whills"></i>
                    <span class="text">Jurnal Umum</span>
                </a>
                <a class="sidebar-button" href="general-ledger">
                    <i class="icon fa-solid fa-columns"></i>
                    <span class="text">Buku Besar</span>
                </a>
                <a class="sidebar-button" href="budget-realization">
                    <i class="icon fa-solid fa-chart-line"></i>
                    <span class="text">Realisasi Anggaran</span>
                </a>
            </div>
            <a class="sidebar-button" href="close-book">
                <i class="icon fa-solid fa-lock"></i>
                <span class="text">Tutup Buku</span>
            </a>

            <!--
            This element serves no functional purpose,
            it's only used to push the logout button all the way down.
            -->
            <div class="filler"></div>

            <a class="sidebar-button bold-text" href="settings">
                <i class="icon fa-solid fa-gear"></i>
                <span class="text">Setelan</span>
            </a>

            <button class="sidebar-button sidebar-logout-button bold-text">
                <i class="icon fa-solid fa-sign-out-alt"></i>
                <span class="text">Keluar</span>
            </button>
        </div>

        <div class="container no-transition">
            <?php
            if (isset($pageContent) && file_exists($pageContent)) {
                include_once $pageContent;
            } else {
                echo "<h1>Error: Page not found.</h1>";
            }
            ?>
        </div>

        <script src="frontend/skeleton/modalUtils.js?v=<?php echo time();?>" type="module"></script>
        <script src="frontend/skeleton/skeleton.js?v=<?php echo time();?>" type="module"></script>
    </body>
</html>


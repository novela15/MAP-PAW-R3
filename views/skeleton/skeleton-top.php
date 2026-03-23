<?php

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo SKELETON_PATH; ?>skeleton.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    </head>

    <body>
        <div class="sidebar">
            <div class="sidebar-header">
                <button class="sidebar-icon-button"><i class="fas fa-bars"></i></button>
            </div>
            <div class="sidebar-label">Menu</div>
            <button class="sidebar-button selected-sidebar-button">Buku Anggaran</button>
            <button class="sidebar-button">Kategori Anggaran</button>
            <button class="sidebar-button">Akun Anggaran</button>
            <button class="sidebar-button">Catat Belanja</button>
            <button class="sidebar-button has-submenu">
                Laporan
                <i class="fas fa-chevron-right submenu-icon"></i>
            </button>
            <div class="submenu hidden">
                <button class="sidebar-button">Jurnal Umum</button>
                <button class="sidebar-button selected-sidebar-button">Buku Besar</button>
                <button class="sidebar-button">Realisasi Anggaran</button>
            </div>
            <button class="sidebar-button">Tutup Buku</button>
            <div class="filler"></div>
            <button class="sidebar-button sidebar-logout-button">Keluar</button>
        </div>
        <div class="container">

?>

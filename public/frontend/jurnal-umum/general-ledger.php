<link rel="stylesheet" href="frontend/general-ledger/jurnal-umum.css?v=<?php echo time();?>">

<div class="app-container">
    <main class="main-content">
        <div class="content-wrapper">
            <h1 class="page-title">Laporan</h1>
            
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Jurnal Umum</h2>
                </div>

                <div class="table-container">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Akun</th>
                                <th>Volume</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Bukti Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="action-cell">
                                    <button class="btn-invoice">
                                        <i class="fa-solid fa-file-invoice"></i>
                                        <i class="fa-solid fa-magnifying-glass sub-icon"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button class="btn-unduh" id="btnUnduhJurnal">Unduh</button>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="frontend/sidebar/sidebar.js?v=<?php echo time();?>"></script>
<script src="frontend/general-ledger/jurnal-umum.js?v=<?php echo time();?>"></script>
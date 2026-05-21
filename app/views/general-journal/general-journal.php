<link rel="stylesheet" href="frontend/jurnal-umum/jurnal-umum.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="frontend/skeleton/generic.css?v=<?php echo time(); ?>">

<p class="container-header">Laporan</p>

<div class="subcontainer">
    <p class="subcontainer-header">Jurnal Umum</p>

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

<script src="frontend/jurnal-umum/jurnal-umum.js?v=<?php echo time(); ?>"></script>
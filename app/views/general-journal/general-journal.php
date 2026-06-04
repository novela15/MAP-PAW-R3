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
                <?php if (!empty($journalData)): ?>
                    <?php foreach ($journalData as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["datetime"] ?? ""); ?></td>
                            <td><?php echo htmlspecialchars($row["account_name"] ?? ""); ?></td>
                            <td><?php echo htmlspecialchars($row["volume"] ?? ""); ?></td>
                            <td><?php echo htmlspecialchars($row["unit_price"] ?? ""); ?></td>
                            <td><?php echo htmlspecialchars($row["total_price"] ?? ""); ?></td>
                            <td class="action-cell">
                                <button class="btn-invoice" data-proof="<?php echo htmlspecialchars((string)($row["proof"] ?? "")); ?>">
                                    <i class="fa-solid fa-file-invoice"></i>
                                    <i class="fa-solid fa-magnifying-glass sub-icon"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 30px;">Belum ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <button class="btn-unduh" id="btnUnduhJurnal">Unduh</button>
    </div>
</div>

<table id="table-excel-jurnal" style="display:none;">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Akun</th>
            <th>Volume</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>

    <?php if (!empty($journalData)): ?>

        <?php foreach ($journalData as $row): ?>

            <tr>
                <td><?= htmlspecialchars($row["datetime"] ?? "") ?></td>
                <td><?= htmlspecialchars($row["account_name"] ?? "") ?></td>
                <td><?= htmlspecialchars($row["volume"] ?? "") ?></td>
                <td><?= htmlspecialchars($row["unit_price"] ?? "") ?></td>
                <td><?= htmlspecialchars($row["total_price"] ?? "") ?></td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>

    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script src="frontend/shared/export-excel.js?v=<?php echo time(); ?>"></script>
<script src="frontend/jurnal-umum/jurnal-umum.js?v=<?php echo time(); ?>"></script>
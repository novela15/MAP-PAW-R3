<link rel="stylesheet" href="frontend/general-ledger/bukubesar-tabel.css?v=<?php echo time(); ?>">

<p class="container-header">Laporan</p>

<div class="subcontainer">
    <main class="main-content">
        <div class="content-wrapper">
            
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Buku Besar <?php echo htmlspecialchars($name); ?></h2>
                </div>

                <div class="table-container">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($generalLedgerModel)): ?>

                                <?php 
                                    $totalDebit = 0;
                                    $totalCredit = 0;
                                ?>

                                <?php foreach ($generalLedgerModel as $row): ?>

                                    <?php 
                                        $totalDebit += $row["debit"];
                                        $totalCredit += $row["credit"];
                                    ?>

                                    <tr>
                                        <td><?php echo $row["datetime"]; ?></td>
                                        <td><?php echo htmlspecialchars($row["description"]); ?></td>
                                        <td>Rp <?php echo number_format($row["debit"], 0, ',', '.'); ?></td>
                                        <td>Rp <?php echo number_format($row["credit"], 0, ',', '.'); ?></td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="4" class="empty-placeholder">
                                        Tidak ada data.
                                    </td>
                                </tr>

                            <?php endif; ?>

                            <tr class="total-row">
                                <td>Total</td>
                                <td></td>
                                <td>Rp <?php echo number_format($totalDebit ?? 0, 0, ',', '.'); ?></td>
                                <td>Rp <?php echo number_format($totalCredit ?? 0, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button class="btn-unduh" id= "btnUnduhBukuBesar">Unduh</button>
                </div>
            </div>
        </div>
    </main>
</div>

<table id="table-excel-buku-besar" style="display:none;">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>

    <tbody>

    <?php if (!empty($generalLedgerModel)): ?>

        <?php
        $totalDebit = 0;
        $totalCredit = 0;
        ?>

        <?php foreach ($generalLedgerModel as $row): ?>

            <?php
            $totalDebit += $row["debit"];
            $totalCredit += $row["credit"];
            ?>

            <tr>
                <td><?= htmlspecialchars($row["datetime"]) ?></td>
                <td><?= htmlspecialchars($row["description"]) ?></td>
                <td><?= $row["debit"] ?></td>
                <td><?= $row["credit"] ?></td>
            </tr>

        <?php endforeach; ?>

        <tr>
            <td colspan="2"><strong>Total</strong></td>
            <td><?= $totalDebit ?></td>
            <td><?= $totalCredit ?></td>
        </tr>

    <?php endif; ?>

    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script src="frontend/shared/export-excel.js?v=<?php echo time(); ?>"></script>
<script src="frontend/general-ledger/bukubesar-tabel.js?v=<?php echo time(); ?>"></script>

<link rel="stylesheet" href="frontend/bukubesar-tabel-in/bukubesar-tabel.css?v=<?php echo time(); ?>">

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
                        <?php if (!empty($generalLedgerModel)): ?>
                            <?php foreach ($generalLedgerModel as $row): ?>
                                <tr>
                                    <td><?php echo $row["datetime"]; ?></td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td><?php echo $row["debit"]; ?></td>
                                    <td><?php echo $row["credit"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-placeholder">Tidak ada data.</div>
                        <?php endif; ?>
                        <tbody>
                            <tr class="total-row">
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button class="btn-unduh" id="btnUnduhBukuBesar">Unduh</button>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="frontend/general-ledger/bukubesar-tabel.js?v=<?php echo time(); ?>"></script>
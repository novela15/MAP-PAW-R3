<link rel="stylesheet" href="frontend/budget-realization/budget-realization.css?v=<?php echo time(); ?>">

<p class="container-header">Laporan</p>

<div class="subcontainer">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Realisasi Anggaran</h2>
        </div>
        
        <div class="table-responsive">
            <table class="realization-table">
                <thead>
                    <tr>
                        <th colspan="2" class="uraian-col">Uraian</th>
                        <th>Anggaran</th>
                        <th>Realisasi</th>
                        <th>Lebih / Kurang</th>
                        <th>Presentase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grandTotalAnggaran = 0;
                    $grandTotalRealisasi = 0;

                    if (!empty($realizationData)): 
                        foreach ($realizationData as $category): 
                            if (empty($category['accounts'])) continue; 
                            $subTotalAnggaran = 0;
                            $subTotalRealisasi = 0;
                    ?>
                            <tr>
                                <td style="width: 15%; padding-left: 20px;"><strong><?= htmlspecialchars($category['name']) ?></strong></td>
                                <td style="width: 20%;"></td><td></td><td></td><td></td><td></td>
                            </tr>

                            <?php 
                            foreach ($category['accounts'] as $account): 
                                $anggaran = $account['budget_plan'];
                                $realisasi = $account['actual_realization'];
                                $selisih = $anggaran - $realisasi;
                                $persentase = $anggaran > 0 ? ($realisasi / $anggaran) * 100 : 0;
                                $subTotalAnggaran += $anggaran;
                                $subTotalRealisasi += $realisasi;
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?= htmlspecialchars($account['account_name']) ?></td>
                                    <td>Rp <?= number_format($anggaran, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($realisasi, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($selisih, 0, ',', '.') ?></td>
                                    <td><?= number_format($persentase, 1) ?>%</td>
                                </tr>
                            <?php endforeach; ?>

                            <?php 
                                $subSelisih = $subTotalAnggaran - $subTotalRealisasi;
                                $subPersentase = $subTotalAnggaran > 0 ? ($subTotalRealisasi / $subTotalAnggaran) * 100 : 0;
                            ?>
                            <tr class="subtotal-row">
                                <td colspan="2" class="text-right"><strong>Sub Total</strong></td>
                                <td><strong>Rp <?= number_format($subTotalAnggaran, 0, ',', '.') ?></strong></td>
                                <td><strong>Rp <?= number_format($subTotalRealisasi, 0, ',', '.') ?></strong></td>
                                <td><strong>Rp <?= number_format($subSelisih, 0, ',', '.') ?></strong></td>
                                <td><strong><?= number_format($subPersentase, 1) ?>%</strong></td>
                            </tr>

                            <?php 
                            $grandTotalAnggaran += $subTotalAnggaran;
                            $grandTotalRealisasi += $subTotalRealisasi;
                            ?>

                        <?php endforeach; ?>

                        <?php 
                            $grandSelisih = $grandTotalAnggaran - $grandTotalRealisasi;
                            $grandPersentase = $grandTotalAnggaran > 0 ? ($grandTotalRealisasi / $grandTotalAnggaran) * 100 : 0;
                        ?>
                        <tr class="total-row">
                            <td colspan="2" class="text-right"><strong>Total</strong></td>
                            <td><strong>Rp <?= number_format($grandTotalAnggaran, 0, ',', '.') ?></strong></td>
                            <td><strong>Rp <?= number_format($grandTotalRealisasi, 0, ',', '.') ?></strong></td>
                            <td><strong>Rp <?= number_format($grandSelisih, 0, ',', '.') ?></strong></td>
                            <td><strong><?= number_format($grandPersentase, 1) ?>%</strong></td>
                        </tr>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center" style="padding: 30px;">Belum ada data anggaran atau realisasi.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="btn-container">
            <button class="btn-unduh" id="btnUnduhRealisasi">Unduh</button>
        </div>
    </div>
</div>

<table id="table-excel-realization" style="display:none;">
    <thead>
        <tr>
            <th style="background-color: #4b7a76; color: #ffffff;">Kategori</th>
            <th style="background-color: #4b7a76; color: #ffffff;">Akun Anggaran</th>
            <th style="background-color: #4b7a76; color: #ffffff;">Anggaran</th>
            <th style="background-color: #4b7a76; color: #ffffff;">Realisasi</th>
            <th style="background-color: #4b7a76; color: #ffffff;">Lebih / Kurang</th>
            <th style="background-color: #4b7a76; color: #ffffff;">Presentase</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $rowNum = 1; // Mulai dari baris 1 (Header)
        $subtotalRows = []; // Menyimpan baris subtotal untuk rumus Grand Total

        if (!empty($realizationData)): 
            foreach ($realizationData as $category): 
                if (empty($category['accounts'])) continue; 
                
                $rowNum++; // Baris Kategori
        ?>
                <tr>
                    <td><strong><?= htmlspecialchars($category['name']) ?></strong></td>
                    <td></td><td></td><td></td><td></td><td></td>
                </tr>

                <?php 
                $startCatRow = $rowNum + 1; // Baris awal data akun
                
                foreach ($category['accounts'] as $account): 
                    $rowNum++; // Baris Akun
                    $anggaran = $account['budget_plan'];
                    $realisasi = $account['actual_realization'];
                ?>
                    <tr>
                        <td></td>
                        <td><?= htmlspecialchars($account['account_name']) ?></td>
                        <td style="mso-number-format:'\Rp\#\,\#\#0'"><?= $anggaran ?></td>
                        <td style="mso-number-format:'\Rp\#\,\#\#0'"><?= $realisasi ?></td>
                        <td style="mso-number-format:'\Rp\#\,\#\#0'">=C<?= $rowNum ?>-D<?= $rowNum ?></td>
                        <td style="mso-number-format:'0.0%'">=IF(C<?= $rowNum ?>>0, D<?= $rowNum ?>/C<?= $rowNum ?>, 0)</td>
                    </tr>
                <?php endforeach; 
                $endCatRow = $rowNum; // Baris akhir data akun
                $rowNum++; // Baris Subtotal
                $subtotalRows[] = $rowNum; 
                ?>
                <tr style="background-color: #c4e0d9;">
                    <td colspan="2"><strong>Sub Total</strong></td>
                    <td style="mso-number-format:'\Rp\#\,\#\#0'">=SUM(C<?= $startCatRow ?>:C<?= $endCatRow ?>)</td>
                    <td style="mso-number-format:'\Rp\#\,\#\#0'">=SUM(D<?= $startCatRow ?>:D<?= $endCatRow ?>)</td>
                    <td style="mso-number-format:'\Rp\#\,\#\#0'">=C<?= $rowNum ?>-D<?= $rowNum ?></td>
                    <td style="mso-number-format:'0.0%'">=IF(C<?= $rowNum ?>>0, D<?= $rowNum ?>/C<?= $rowNum ?>, 0)</td>
                </tr>
            <?php endforeach; 
            
            $rowNum++; // Baris Grand Total
            // Membuat rumus penjumlahan semua subtotal: =C5+C10+C15 dst
            $formulaC = empty($subtotalRows) ? '0' : '=' . implode('+', array_map(function($r){ return 'C'.$r; }, $subtotalRows));
            $formulaD = empty($subtotalRows) ? '0' : '=' . implode('+', array_map(function($r){ return 'D'.$r; }, $subtotalRows));
            ?>
            <tr style="background-color: #9ac2b9;">
                <td colspan="2"><strong>Total</strong></td>
                <td style="mso-number-format:'\Rp\#\,\#\#0'"><?= $formulaC ?></td>
                <td style="mso-number-format:'\Rp\#\,\#\#0'"><?= $formulaD ?></td>
                <td style="mso-number-format:'\Rp\#\,\#\#0'">=C<?= $rowNum ?>-D<?= $rowNum ?></td>
                <td style="mso-number-format:'0.0%'">=IF(C<?= $rowNum ?>>0, D<?= $rowNum ?>/C<?= $rowNum ?>, 0)</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script src="frontend/shared/export-excel.js?v=<?php echo time(); ?>"></script>
<script src="frontend/budget-realization/budget-realization.js?v=<?php echo time(); ?>"></script>

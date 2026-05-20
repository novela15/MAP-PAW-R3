<link rel="stylesheet" href="frontend/budget-realization/budget-realization.css?v=<?php echo time();?>">

<div class="laporan-header">Laporan</div>

<div class="realization-card">
    <h2>Realisasi Anggaran</h2>
    
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
                    // Variabel untuk menghitung subtotal per kategori
                    $subTotalAnggaran = 0;
                    $subTotalRealisasi = 0;
            ?>
                    
                    <tr>
                        <td style="width: 15%;"><?= htmlspecialchars($category['name']) ?></td>
                        <td style="width: 20%;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <?php 
                    foreach ($category['accounts'] as $account): 
                        $anggaran = $account['budget_plan'];
                        $realisasi = $account['actual_realization'];
                        $selisih = $anggaran - $realisasi;
                        $persentase = $anggaran > 0 ? ($realisasi / $anggaran) * 100 : 0;

                        // Menambahkan angka ke subtotal kategori ini
                        $subTotalAnggaran += $anggaran;
                        $subTotalRealisasi += $realisasi;
                    ?>
                        <tr>
                            <td></td> <td><?= htmlspecialchars($account['account_name']) ?></td>
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
                    // Menambahkan subtotal ke Grand Total (Total Paling Bawah)
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
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Belum ada data anggaran atau realisasi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="btn-container">
        <button class="btn-unduh">Unduh</button>
    </div>
</div>
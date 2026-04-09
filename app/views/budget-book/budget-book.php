<link rel="stylesheet" href="frontend/budget-book/budget-book.css?v=<?php echo time();?>">

<p class="container-header">Buku Anggaran</p>

<div class="horizontal-flex">
    <div class="card">
        <div class="bold">Jumlah Anggaran</div>
        <div class="bold currency">Rp<?= number_format($total_budget, 2, ',', '.') ?></div>
    </div>

    <div class="card">
        <div class="bold">Sisa Anggaran</div>
        <div class="bold currency">Rp0,00</div>
    </div>
</div>

<div class="subcontainer">
    <p class="container-header">Daftar Anggaran</p>

    <table class="budget-book-table">
        <tr>
            <th>Nama Akun</th>
            <th>Anggaran</th>
            <th>Pengeluaran</th>
            <th>Sisa</th>
            <th>Realisasi</th>
            <th>Status</th>
        </tr>

        <?php if (!empty($budgetBook)): ?>
            <?php foreach ($budgetBook as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td>Rp<?= number_format($row['budget'], 2, ',', '.') ?></td>
                    <td>Rp<?= number_format($row['used'], 2, ',', '.') ?></td>
                    <td>Rp<?= number_format($row['surplus'], 2, ',', '.') ?></td>
                    <td><?= number_format($row['realization'], 2, ',', '.') ?>%</td>

                    <td class="
                        <?php 
                            if ($row['status'] === 'Aman') echo 'status-green';
                            elseif ($row['status'] === 'Waspada') echo 'status-yellow';
                            else echo 'status-red';
                        ?>
                    ">
                        <?= htmlspecialchars($row['status']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <td class="empty-table-placeholder" colspan="6">Data anggaran tidak ditemukan.</td>
        <?php endif; ?>
    </table>

    <div class="filler"></div>

    <div class="horizontal-flex">
        <div class="filler"></div>
        <a class="container-button" href="record-expense">Catat Belanja</a>
    </div>
</div>

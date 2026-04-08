<!-- ALWAYS put CSS files at the top -->
<link rel="stylesheet" href="frontend/record-expense/record-expense.css?v=<?php echo time();?>">

<p class="container-header">Akun Anggaran</p>

<div class="subcontainer">
    <div class="horizontal-flex">
        <p class="container-header">Daftar Akun Anggaran</p>
        <div class="add-container horizontal-flex">
            <button class="add-button">+</button>
            <div>Buat</div>
        </div>
    </div>
    <table class="record-expense-table">
        <tr>
            <th>Tanggal</th>
            <th>Akun Anggaran</th>
            <th>Volume</th>
            <th>Satuan</th>
            <th>Jumlah Total</th>
            <th>Keterangan</th>
            <th>Bukti Pengeluaran</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($record-expenseTables)): ?>
            <?php foreach ($record-expenseTables as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["Tanggal"]) ?></td>
                    <td><?= htmlspecialchars($row["Akun Anggaran"]) ?></td>
                    <td><?= htmlspecialchars($row["Volume"]) ?></td>
                    <td><?= htmlspecialchars($row["Satuan"]) ?></td>
                    <td><?= htmlspecialchars($row["Keterangan"]) ?></td>
                    <td><?= htmlspecialchars($row["Bukti Pengeluaran"]) ?></td>
                    <td>
                        <div class="table-action">
                            <button class="delete-button trash-can-button" item-id=<?php echo $row["id"]; ?>>
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <button class="write-button pen-button" item-id=<?php echo $row["id"]; ?>>
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <td class="empty-table-placeholder" colspan="7">Tidak ada akun anggaran yang ditemukan.</td>
        <?php endif; ?>
    </table>
</div>

<!--
    ALWAYS put JS files at the end,
    and ALWAYS make JS files as modules so they don't pollute the global namespace
-->
<script defer src="frontend/record-expense/record-expense.js?v=<?php echo time();?>" type="module"></script>

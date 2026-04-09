<!-- ALWAYS put CSS files at the top -->
<link rel="stylesheet" href="frontend/budget-account/budget-account.css?v=<?php echo time();?>">

<p class="container-header">Akun Anggaran</p>

<div class="subcontainer">
    <div class="horizontal-flex">
        <p class="container-header">Daftar Akun Anggaran</p>
        <div class="add-container horizontal-flex">
            <button class="add-button">+</button>
            <div>Buat</div>
        </div>
    </div>
    <table class="budget-account-table">
        <tr>
            <th>Nama Akun Anggaran</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th>Volume</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($budgetAccountTables)): ?>
            <?php foreach ($budgetAccountTables as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["name"]) ?></td>
                    <td><?= htmlspecialchars($row["category"]) ?></td>
                    <td><?= htmlspecialchars($row["description"]) ?></td>
                    <td><?= htmlspecialchars($row["volume"]) ?></td>
                    <td>Rp<?= htmlspecialchars(number_format($row["unit_price"], 2, ',', '.')) ?></td>
                    <td>Rp<?= htmlspecialchars(number_format($row["amount"], 2, ',', '.')) ?></td>
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
<script defer src="frontend/budget-account/budget-account.js?v=<?php echo time();?>" type="module"></script>

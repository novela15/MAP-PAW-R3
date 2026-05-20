<!-- ALWAYS put CSS files at the top -->
<link rel="stylesheet" href="frontend/budget-account/budget-account.css?v=<?php echo time(); ?>">

<p class="container-header">Akun Anggaran</p>

<div class="subcontainer">
    <div class="horizontal-flex">
        <div class="add-container horizontal-flex">
            <button class="add-button">+</button>
            <div>Buat</div>
        </div>
    </div>

    <div class="grid-container">
        <?php if (!empty($budgetAccountTables)): ?>
            <?php foreach ($budgetAccountTables as $row): ?>
                <div class="card">
                    <div class="name"><?php echo htmlspecialchars($row["name"]); ?></div>
                    <div class="category"><?php echo htmlspecialchars($row["category"]); ?></div>
                    <hr />
                    <div class="content-grid">
                        <div class="volume"><span class="label">Total volume</span><br><?php echo htmlspecialchars($row["volume"]); ?></div>
                        <div class="unit-price"><span class="label">Harga satuan</span><br>Rp<?php echo htmlspecialchars(number_format($row["unit_price"], 2, ',', '.')); ?></div>
                        <div class="total-price"><span class="label">Total pengeluaran</span><br>Rp<?php echo htmlspecialchars(number_format($row["total_price"], 2, ',', '.')); ?></div>
                        <div class="total-price"><span class="label">Jumlah transaksi</span><br><?php echo htmlspecialchars($row["transaction_count"]); ?></div>
                    </div>
                    <div class="description"><span class="label">Deskripsi</span><br><?php echo htmlspecialchars($row["description"]); ?></div>
                    <div class="action">
                        <button class="delete-button trash-can-button" title="Hapus" item-id=<?php echo $row["id"]; ?>>
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                        <button class="write-button pen-button" title="Edit" item-id=<?php echo $row["id"]; ?>>
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-table-placeholder">Tidak ada akun anggaran yang ditemukan.</div>
        <?php endif; ?>
    </div>
</div>

<!--
    ALWAYS put JS files at the end,
    and ALWAYS make JS files as modules so they don't pollute the global namespace
-->
<script defer src="frontend/budget-account/budget-account.js?v=<?php echo time(); ?>" type="module"></script>

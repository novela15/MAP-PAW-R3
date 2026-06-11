<link rel="stylesheet" href="frontend/budget-category/budget-category.css?v=<?php echo time();?>">
<link rel="stylesheet" href="frontend/skeleton/generic.css?v=<?php echo time(); ?>">

<p class="container-header">Kategori Anggaran</p>

<div class="subcontainer">
    <div class="horizontal-flex">
        <input type="text" placeholder="Cari" class="search-bar" search-class="card" search-class-filter="name">
        <div class="filler"></div>
        <div class="add-container horizontal-flex">
            <button class="add-button">+</button>
            <div>Buat</div>
        </div>
    </div>

    <div class="grid-container">
        <?php if (!empty($budgetCategoryModel)): ?>
            <?php foreach ($budgetCategoryModel as $row): ?>
                <div class="card">
                    <div class="name"><?php echo htmlspecialchars($row["name"]); ?></div>
                    <div class="description"><?php echo htmlspecialchars($row["description"]); ?></div>
                    <div class="content-grid">
                        <div class="volume"><span class="label">Terhubung ke</span><br><?php echo htmlspecialchars($row["accounts_count"]); ?> kategori</div>
                        <div class="total-price"><span class="label">Total pengeluaran</span><br>Rp<?php echo htmlspecialchars(number_format($row["total_expense"], 2, ',', '.')); ?></div>
                    </div>

                    <div class="filler"></div>

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
            <div class="empty-placeholder">Tidak ada kategori anggaran yang ditemukan.</div>
        <?php endif; ?>
    </div>
</div>

<script src="frontend/budget-category/budget-category.js?v=<?php echo time(); ?>"></script>

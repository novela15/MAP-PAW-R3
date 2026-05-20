<!-- ALWAYS put CSS files at the top -->
<link rel="stylesheet" href="frontend/record-expense/record-expense.css?v=<?php echo time(); ?>">

<p class="container-header">Catatan Belanja</p>

<div class="subcontainer">
    <div class="horizontal-flex">
        <div class="add-container horizontal-flex">
            <button class="add-button">+</button>
            <div>Buat</div>
        </div>
    </div>

    <div class="grid-container">
        <?php if (!empty($recordExpenseModel)): ?>
            <?php foreach ($recordExpenseModel as $row): ?>
                <div class="card">
                    <div class="content-grid">
                        <div>
                            <div class="name"><?php echo htmlspecialchars($row["name"]); ?></div>
                            <div class="datetime"><?php echo htmlspecialchars(date("D, d M Y, H:i", strtotime($row["datetime"]))); ?></div>
                            <div class="description"><?php echo htmlspecialchars($row["description"]); ?></div>
                        </div>
                        <div>
                            <div class="price-calculation"><?php echo htmlspecialchars($row["volume"]) . " x Rp" . htmlspecialchars(number_format($row["unit_price"], 2, ',', '.')); ?></div>
                            <div class="total-price">Rp<?php echo htmlspecialchars(number_format($row["total_price"], 2, ',', '.')); ?></div>
                            <div class="action">
                                <button class="delete-button trash-can-button" title="Hapus" item-id=<?php echo $row["id"]; ?>>
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                                <button class="write-button pen-button" title="Edit" item-id=<?php echo $row["id"]; ?>>
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </div>
                        </div>
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
<script defer src="frontend/record-expense/record-expense.js?v=<?php echo time(); ?>" type="module"></script>

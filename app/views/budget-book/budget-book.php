<link rel="stylesheet" href="frontend/budget-book/budget-book.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="frontend/skeleton/generic.css?v=<?php echo time(); ?>">

<!-- Google Charts script must be on top apparently -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    window.budgetData = [
        <?php
        if (!empty($budgetBookModel)) {
            foreach ($budgetBookModel as $row) {
                $remaining = $row["budget"] - $row["total_expenses"];
                echo "['" . addslashes(htmlspecialchars($row["name"])) . "', " 
                     . (float)$row["budget"] . ", " 
                     . (float)$row["total_expenses"] . ", " 
                     . (float)$remaining . "],";
            }
        }
        ?>
    ];
    window.monthlySpendingData = [
        <?php
        if (!empty($history)) {
            foreach ($history as $row) {
                echo "['" . addslashes(htmlspecialchars(date("Y m", strtotime($row["expense_month"])))) . "', '" 
                     . addslashes(htmlspecialchars($row["category_name"])) . "', " 
                     . (float)$row["total_expense"] . "],";
            }
        }
        ?>
    ];
</script>
<script src="frontend/budget-book/budget-book.js?v=<?php echo time(); ?>"></script>

<p class="container-header">Buku Anggaran</p>

<div class="horizontal-flex">
    <div class="card">
        <div class="bold">Jumlah Anggaran</div>
        <div class="bold currency-green">Rp<?php echo number_format($total_budget, 2, ',', '.'); ?></div>
    </div>

    <div class="card">
        <div class="bold">Sisa Anggaran</div>
        <?php if ($total_budget - $total_expenses > 0.1): ?>
            <div class="bold currency-green">
        <?php elseif (abs($total_budget - $total_expenses) <= 0.1): ?>
            <div class="bold currency-yellow">
        <?php else: ?>
            <div class="bold currency-red">
        <?php endif; ?>
            Rp<?php echo number_format(($total_budget ?? 0) - ($total_expenses ?? 0), 2, ',', '.'); ?>
        </div>
    </div>
</div>

<div class="horizontal-flex">
    <div class="card">
        <div class="chart categories-chart"></div>
    </div>
    <div class="card">
        <div class="chart monthly-spending-chart"></div>
    </div>
</div>

<div class="subcontainer">
    <div class="grid-container">
        <?php if (!empty($budgetBookModel)): ?>
            <?php foreach ($budgetBookModel as $row): ?>
                <div class="card">
                    <?php if ($row["status"] === "Aman"): ?>
                        <div class="name status-green"><?php echo htmlspecialchars($row["name"]); ?></div>
                    <?php elseif ($row["status"] === "Waspada"): ?>
                        <div class="name status-yellow"><?php echo htmlspecialchars($row["name"]); ?></div>
                    <?php else: ?>
                        <div class="name status-red"><?php echo htmlspecialchars($row["name"]); ?></div>
                    <?php endif; ?>
                    <hr />
                    <div class="content-grid">
                        <div class="total-price"><span class="label">Anggaran</span><br>Rp<?php echo htmlspecialchars(number_format($row["budget"], 2, ',', '.')); ?></div>
                        <div class="total-expenses"><span class="label">Total pengeluaran</span><br>Rp<?php echo htmlspecialchars(number_format($row["total_expenses"], 2, ',', '.')); ?></div>
                        <?php if ($row["budget"] >= $row["total_expenses"]): ?>
                            <div class="surplus"><span class="label">Sisa</span><br><span class="bold">Rp<?php echo htmlspecialchars(number_format($row["budget"] - $row["total_expenses"], 2, ',', '.')); ?></span></div>
                        <?php else: ?>
                            <div class="surplus"><span class="label">Kurang</span><br><span class="bold">Rp<?php echo htmlspecialchars(number_format($row["total_expenses"] - $row["budget"], 2, ',', '.')); ?></span></div>
                        <?php endif; ?>
                        <div class="realization"><span class="label">Realisasi</span><br><?php echo htmlspecialchars(number_format($row["realization"], 0)); ?>%</div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-placeholder">Data anggaran tidak ditemukan.</div>
        <?php endif; ?>
    </div>
</div>

<link rel="stylesheet" href="frontend/general-ledger/buku-besar.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="frontend/skeleton/generic.css?v=<?php echo time(); ?>">

<p class="container-header">Laporan</p>

<div class="subcontainer">
    <div class="card-header">
        <p class="subcontainer-header">Buku Besar</p>

        <div class="search-category">
            <input type="text" placeholder="Cari Kategori" class="category-search-input" id="categorySearch">
            <svg class="category-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
        </div>
    </div>

    <div class="category-grid" id="categoryGrid">
        <?php if (!empty($generalLedgerModel)): ?>
            <?php foreach ($generalLedgerModel as $row): ?>
                <?php $index = $index + 1; ?>
                <?php if ($index >= 3): ?>
                    <?php $index = 0; ?>
                <?php endif; ?>
                <a class="box-url" href="general-ledger?account=<?php echo $row['name']; ?>"><div class="category-box <?php echo 'color-' . $index; ?>"><i><?php echo htmlspecialchars($row["name"]); ?></i></div></a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-placeholder">Tidak ada kategori anggaran yang ditemukan.</div>
        <?php endif; ?>
    </div>
</div>

<script defer src="frontend/general-ledger/general-ledger.js?v=<?php echo time(); ?>"></script>

<link rel="stylesheet" href="frontend/budget-category/kategori.css?v=<?php echo time();?>">

<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@600;700&family=Inter:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<p class="container-header">Kategori Anggaran</p>

<div class="subcontainer">
        <div class="table-card">
            <div class="table-header-row">
                <h3 class="table-title">Daftar Kategori Anggaran</h3>
        <div class="add-container horizontal-flex">
            <button class="add-button">+</button>
            <div>Buat</div>
        </div>
            </div>

            <table class="custom-table" id="table-kategori">
                <tr>
                    <th>Nama Kategori Akun</th>
                    <th>Keterangan</th>
                    <th class="action-header">Action</th>
                </tr>
                <?php if (!empty($table)): ?>
                    <?php foreach ($table as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["name"]) ?></td>
                            <td><?= htmlspecialchars($row["description"]) ?></td>
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

    <script src="frontend/budget-category/kategori.js?v=<?php echo time();?>"></script>
</body>
</div>

<div class="modal modal-account-edit">
    <div class="modal-content">
        <div class="modal-header">Edit Akun Anggaran</div>

        <form class="input-container" method="POST" action="budget-account">
            <p>Kategori</p>
            <select name="category_id" required>
            <?php foreach ($budgetCategories as $category): ?>
                <option value="<?php echo $category["id"]; ?>" <?php echo ($accountData && $accountData["category_id"] == $category["id"]) ? "selected" : ""; ?>>
                    <?php echo $category["name"]; ?>
                </option>
            <?php endforeach; ?>
            </select>
            
            <p>Nama Akun</p>
            <input type="text" name="name" value="<?php echo $accountData ? htmlspecialchars($accountData["name"]) : ""; ?>" required>

            <p>Volume</p>
            <input type="number" name="volume" min="0" step="0.01" value="<?php echo $accountData ? $accountData["volume"] : ""; ?>" required>

            <p>Satuan</p>
            <div class="input-group">
                <span class="input-prefix">Rp</span>
                <input type="number" name="unit_price" placeholder="Harga" value="<?php echo $accountData ? $accountData["unit_price"] : ""; ?>" required>
            </div>

            <p>Deskripsi</p>
            <textarea name="description"><?php echo $accountData ? htmlspecialchars($accountData["description"]) : ""; ?></textarea>

            <input type="hidden" name="item_id" value="<?php echo $accountData ? $accountData["id"] : ""; ?>">
            <input type="hidden" name="type" value="edit">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

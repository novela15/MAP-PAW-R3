<div class="modal modal-account">
    <div class="modal-content">
        <div class="modal-header">Edit Akun Anggaran</div>

        <form class="input-container" method="POST" action="budget-account?action=edit&item_id=<?php echo $_GET["item_id"] ?>">
            <p>Kategori</p>
            <select name="category_id" required>
            <?php foreach ($budgetCategories as $category): ?>
                <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
            <?php endforeach; ?>
            </select>

            <p>Nama Akun</p>
            <input type="text" name="name" value="" required>

            <p>Satuan</p>
            <input type="text" name="unit" value="" required>

            <p>Deskripsi</p>
            <textarea name="description"></textarea>

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

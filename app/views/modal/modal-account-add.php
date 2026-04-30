<div class="modal modal-account">
    <div class="modal-content">
        <div class="modal-header">Tambah Akun Anggaran</div>

        <form class="input-container" method="POST" action="budget-account">
            <p>Kategori</p>
            <select name="category_id" required>
            <?php foreach ($budgetCategories as $category): ?>
                <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
            <?php endforeach; ?>
            </select>

            <p>Nama Akun</p>
            <input type="text" name="name" value="" required>

            <p>Harga Satuan</p>
            <input type="number" name="unit_price" value="" required>

            <p>Deskripsi</p>
            <textarea name="description"></textarea>

            <input type="hidden" name="type" value="add">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

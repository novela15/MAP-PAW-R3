<div class="modal modal-account">
    <div class="modal-content">
        <div class="modal-header">Akun Anggaran</div>

        <form class="input-container" method="POST" action="budget-account">
            <p>Nama Kategori</p>
            <select name="category_id" required>
                <option value="" disabled selected>Pilih Kategori...</option>
                <?php foreach ($budgetCategories as $category): ?>
                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <p>Nama Akun</p>
            <input type="text" name="name" value="" required>

            <p>Volume</p>
            <input type="number" name="volume" min="0" step="0.01" required>

            <p>Satuan</p>
            <div class="input-group">
                <span class="input-prefix">Rp</span>
                <input type="number" name="unit_price" placeholder="Harga" required>
            </div>

            <p>Deskripsi</p>
            <textarea name="description"></textarea>

            <input type="hidden" name="type" value="add">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">BATAL</button>
                <div class="filler"></div>
                <button class="ok" type="submit">SIMPAN</button>
            </div>
        </form>
    </div>
</div>

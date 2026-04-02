<div id="modalAkun" class="modal" style="display:none;">
    <div class="modal-content">
        <h3>Akun Anggaran</h3>

        <form method="POST" action="/budget-account/store">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

            <label>Kategori</label>
            <select name="category_id">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>">
                        <?= $cat['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Nama Akun</label>
            <input type="text" name="name" required>

            <label>Volume</label>
            <input type="number" name="volume">

            <label>Satuan</label>
            <input type="text" name="unit" value="Rp">

            <label>Jumlah Anggaran</label>
            <input type="number" name="amount" required>

            <label>Deskripsi</label>
            <textarea name="description"></textarea>

            <button type="button" onclick="closeModal('modalAkun')">Batal</button>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>
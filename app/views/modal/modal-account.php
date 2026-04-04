<div class="modal hidden modal-account">
    <div class="modal-content">
        <div class="modal-header">Akun Anggaran</div>

        <form class="input-container" method="POST" action="budget-account/add">
            <p>Kategori</p>
            <select name="category_id"></select>

            <p>Nama Akun</p>
            <input type="text" name="name" required>

            <p>Volume</p>
            <input type="number" name="volume">

            <p>Satuan</p>
            <input type="text" name="unit" value="Rp">

            <p>Jumlah</p>
            <input type="number" name="amount" required>

            <p>Deskripsi</p>
            <textarea name="description"></textarea>

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalKategori" class="modal" style="display:none;">
    <div class="modal-content">
        <h3>Kategori Anggaran</h3>

        <form method="POST" action="/kategori/store">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi"></textarea>

            <button type="button" onclick="closeModal('modalKategori')">Batal</button>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>
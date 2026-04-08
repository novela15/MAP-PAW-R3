<div class="modal modal-account">
    <div class="modal-content">
        <div class="modal-header">Tambah Kategori Anggaran</div>

        <form class="input-container" method="POST" action="budget-category">
            <p>Nama Kategori</p>
            <input type="text" name="name" value="" required>

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

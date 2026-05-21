<div class="modal modal-category-edit
    <div class="modal-content">
        <div class="modal-header">Edit Kategori Anggaran</div>

        <form class="input-container" method="POST" action="budget-category">
            <p>Nama Kategori</p>
            <input type="text" name="name" value="<?php echo $categoryData ? htmlspecialchars($categoryData['name']) : ''; ?>" required>

            <p>Deskripsi</p>
            <textarea name="description"><?php echo $categoryData ? htmlspecialchars($categoryData['description']) : ''; ?></textarea>

            <!-- Mengubah name="item_id" menjadi name="id" untuk konsistensi query UPDATE -->
            <input type="hidden" name="id" value="<?php echo $categoryData ? $categoryData['id'] : ''; ?>">
            <input type="hidden" name="type" value="edit">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
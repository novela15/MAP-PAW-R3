<div class="modal modal-account">
    <div class="modal-content">
        <div class="modal-header">Edit Catatan Belanja</div>

        <form class="input-container" method="POST" action="record-expense">
            <p>Tanggal</p>
            <input type="date" name="datetime" required>

            <p>Nama Akun</p>
            <select name="budget_account_id" required>
                <option value="" disabled selected>Pilih Akun...</option>
                <?php foreach ($budgetAccounts as $category): ?>
                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <p>Volume</p>
            <input type="number" name="volume" placeholder="Contoh: 1" required>

            <p>Harga Satuan</p>
            <div class="input-group">
                <span class="input-prefix">Rp</span>
                <input type="number" name="unit_price" placeholder="Harga" required>
            </div>

            <p>Struk</p>
            <div class="input-group">
                <label class="upload-btn">
                    Upload
                    <input type="file" name="proof" style="display: none;" onchange="this.nextElementSibling.value = this.files[0].name">
                </label>
                <input type="text" placeholder="No file chosen" readonly>
            </div>

            <p>Deskripsi</p>
            <textarea name="description" rows="4"></textarea>

            <input type="hidden" name="type" value="add">

            <input type="hidden" name="item_id" value="<?php echo $_GET["item_id"] ?>">
            <input type="hidden" name="type" value="edit">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

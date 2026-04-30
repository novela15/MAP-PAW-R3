<div class="modal modal-account">
    <div class="modal-content">
        <div class="modal-header">Edit Catatan Belanja</div>

        <form class="input-container" method="POST" action="record-expense">
            <p>Akun Anggaran</p>
            <select name="budget_account_id" required>
            <?php foreach ($budgetAccounts as $category): ?>
                <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
            <?php endforeach; ?>
            </select>

            <p>Volume</p>
            <input type="number" name="volume" value="" required>

            <p>Deskripsi</p>
            <textarea name="description"></textarea>

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

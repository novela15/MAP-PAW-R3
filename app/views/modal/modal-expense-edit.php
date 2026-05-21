<div class="modal modal-expense-edit
    <div class="modal-content">
        <div class="modal-header">Edit Catatan Belanja</div>

        <!-- Tambahkan enctype jika proses update melampirkan file struk baru -->
        <form class="input-container" method="POST" action="record-expense" enctype="multipart/form-data">
            <p>Tanggal</p>
            <!-- Memotong format datetime jika dari DB berupa Y-m-d H:i:s agar cocok dengan input type="date" -->
            <?php 
                $dateValue = '';
                if ($expenseData) {
                    $dateValue = explode(' ', $expenseData['datetime'])[0]; 
                }
            ?>
            <input type="date" name="datetime" value="<?php echo $dateValue; ?>" required>

            <p>Nama Akun</p>
            <select name="budget_account_id" required>
                <option value="" disabled>Pilih Akun...</option>
                <?php foreach ($budgetAccounts as $account): ?>
                    <option value="<?php echo $account["id"]; ?>" <?php echo ($expenseData && $expenseData['budget_account_id'] == $account['id']) ? 'selected' : ''; ?>>
                        <?php echo $account["name"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <p>Volume</p>
            <input type="number" name="volume" placeholder="Contoh: 1" value="<?php echo $expenseData ? $expenseData['volume'] : ''; ?>" required>

            <p>Harga Satuan</p>
            <div class="input-group">
                <span class="input-prefix">Rp</span>
                <input type="number" name="unit_price" placeholder="Harga" value="<?php echo $expenseData ? $expenseData['unit_price'] : ''; ?>" required>
            </div>

            <p>Struk (Kosongkan jika tidak diganti)</p>
            <div class="input-group">
                <label class="upload-btn">
                    Upload
                    <input type="file" name="proof" style="display: none;" onchange="this.nextElementSibling.value = this.files[0].name">
                </label>
                <!-- Menampilkan nama file struk lama sebagai placeholder awal -->
                <input type="text" placeholder="<?php echo ($expenseData && !empty($expenseData['proof'])) ? htmlspecialchars($expenseData['proof']) : 'No file chosen'; ?>" readonly>
            </div>

            <p>Deskripsi</p>
            <textarea name="description" rows="4"><?php echo $expenseData ? htmlspecialchars($expenseData['description']) : ''; ?></textarea>

            <!-- Mengubah name="item_id" menjadi name="id" agar sinkron dengan controller POST Anda -->
            <input type="hidden" name="id" value="<?php echo $expenseData ? $expenseData['id'] : ''; ?>">
            <input type="hidden" name="type" value="edit">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
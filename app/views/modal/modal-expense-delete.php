<div class="modal modal-delete">
    <div class="modal-content">
        <div class="modal-header">KONFIRMASI</div>

        <form action="record-expense" class="input-container" method="POST">
            <i class="fa-solid fa-circle-exclamation"></i>
            <p class="confirmation-text">Apakah anda yakin untuk menghapus catatan belanja?</p>

            <input type="hidden" name="item_id" value="<?php echo $_GET["item_id"] ?>">
            <input type="hidden" name="type" value="delete">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" name="delete_button" type="submit">Hapus</button>
            </div>
        </form>
    </div>
</div>

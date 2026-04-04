<div class="modal modal-delete">
    <div class="modal-content">
        <div class="modal-header">KONFIRMASI</div>

        <form action="budget-account?action=delete&item_id=<?php echo $_GET["item_id"] ?>" class="input-container" method="POST">
            <i class="fa-solid fa-circle-exclamation"></i>
            <p class="confirmation-text">Apakah anda yakin untuk menghapus?</p>

            <input type="hidden" name="id">

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" name="delete_button" type="submit">Hapus</button>
            </div>
        </form>
    </div>
</div>

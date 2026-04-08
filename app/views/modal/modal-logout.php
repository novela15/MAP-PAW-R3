<div class="modal modal-logout">
    <div class="modal-content">
        <div class="modal-header">KONFIRMASI</div>

        <form action="logout" class="input-container" method="POST">
            <i class="fa-solid fa-circle-exclamation"></i>
            <p class="confirmation-text">Apakah anda yakin untuk keluar?</p>

            <div class="horizontal-buttons">
                <button class="cancel modal-closer" onclick="closeModal();" type="button">Batal</button>
                <div class="filler"></div>
                <button class="ok" type="submit">Keluar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal modal-close-book">
    <div class="modal-content">
        <div class="modal-header">KONFIRMASI</div>

        <form action="close-book" class="input-container" method="POST">
            <i class="fa-solid fa-circle-exclamation"></i>

            <p class="confirmation-text">
                Apakah anda yakin untuk menutup buku?
            </p>

            <div class="horizontal-buttons">
                <button 
                    class="cancel modal-closer"
                    onclick="closeModal();"
                    type="button">

                    Batal
                </button>

                <div class="filler"></div>

                <button class="ok" type="submit">
                    Tutup Buku
                </button>
            </div>
        </form>
    </div>
</div>

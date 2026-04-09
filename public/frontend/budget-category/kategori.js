document.addEventListener("DOMContentLoaded", () => {
    const btnTambah = document.getElementById('btn-tambah');
    const tableBody = document.querySelector('#table-kategori tbody');

    // Fungsi Tambah Baris
    btnTambah.addEventListener('click', () => {
        openModal("modal-category-add");
    });

    // Event Delegation untuk tombol Hapus & Edit
    tableBody.addEventListener('click', (e) => {
        // Logika Hapus
        if (e.target.closest('.btn-hapus')) {
            openModal("modal-category-delete");
        }

        // Logika Edit (Bisa diarahkan ke fungsi lain)
        if (e.target.closest('.btn-edit')) {
            openModal("modal-category-edit");
        }
    });

    // Tombol Hapus Massal (Contoh)
    document.getElementById('btn-hapus-massal').addEventListener('click', () => {
        if (confirm('Hapus semua data di tabel?')) {
            openModal("modal-category-delete");
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const btnTambah = document.getElementById('btn-tambah');
    const tableBody = document.querySelector('#table-kategori tbody');

    // Fungsi Tambah Baris
    btnTambah.addEventListener('click', () => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td contenteditable="true">Nama Kategori...</td>
            <td contenteditable="true">Keterangan...</td>
            <td class="action-cell">
                <div class="btn-mini-action bg-red btn-hapus"><i class="fa-solid fa-trash"></i></div>
                <div class="btn-mini-action bg-teal btn-edit"><i class="fa-solid fa-pencil"></i></div>
            </td>
        `;
        tableBody.appendChild(row);
    });

    // Event Delegation untuk tombol Hapus & Edit
    tableBody.addEventListener('click', (e) => {
        // Logika Hapus
        if (e.target.closest('.btn-hapus')) {
            const baris = e.target.closest('tr');
            if (confirm('Yakin ingin menghapus baris ini?')) {
                baris.remove();
            }
        }

        // Logika Edit (Bisa diarahkan ke fungsi lain)
        if (e.target.closest('.btn-edit')) {
            alert('Silahkan edit langsung pada kolom tabel!');
        }
    });

    // Tombol Hapus Massal (Contoh)
    document.getElementById('btn-hapus-massal').addEventListener('click', () => {
        if (confirm('Hapus semua data di tabel?')) {
            tableBody.innerHTML = '';
        }
    });
});
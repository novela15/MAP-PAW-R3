
<link rel="stylesheet" href="frontend/kategori/kategori.css?v=<?php echo time();?>">

<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@600;700&family=Inter:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<p class="container-header">Kategori Anggaran</p>

<div class="subcontainer">

        <div class="table-card">
            <div class="table-header-row">
                <h3 class="table-title">Daftar Kategori Anggaran</h3>
                <div class="buat-wrapper" id="btn-tambah">
                    <div class="icon-plus-box"><i class="fa-solid fa-plus"></i></div>
                    <span class="text-buat">Buat</span>
                </div>
            </div>

            <table class="custom-table" id="table-kategori">
                <thead>
                    <tr>
                        <th>Nama Kategori Akun</th>
                        <th>Keterangan</th>
                        <th class="action-header">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="action-cell">
                            <div class="btn-mini-action bg-red btn-hapus"><i class="fa-solid fa-trash"></i></div>
                            <div class="btn-mini-action bg-teal btn-edit"><i class="fa-solid fa-pencil"></i></div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="bottom-actions">
                <div class="btn-large bg-red" id="btn-hapus-massal"><i class="fa-solid fa-trash"></i></div>
            </div>
        </div>

    <script src="frontend/kategori/kategori.js?v=<?php echo time();?>"></script>
</body>
</div>
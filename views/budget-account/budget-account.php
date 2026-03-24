            <link rel="stylesheet" href="<?php echo VIEWS_PATH; ?>budget-account/budget-account.css">

            <p class="container-header">Akun Anggaran <?php echo $_SESSION["user_name"] ?? "[Unknown]"; ?></p>
            <div class="subcontainer">
                <div class="horizontal-flex">
                    <p class="container-header">Daftar Akun Anggaran</p>
                    <div class="add-container horizontal-flex">
                        <button class="add-button">+</button>
                        <div>Buat</div>
                    </div>
                </div>
                <table class="budget-account-table">
                    <tr>
                        <th>Nama Akun Anggaran</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><div class="table-action"><button class="delete-button trash-can-button"><i class="fa-regular fa-trash-can"></i></button><button class="write-button pen-button"><i class="fa-solid fa-pen"></i></i></button></div></th>
                    </tr>
                </table>
                <div class="bottom-action"><button class="delete-button trash-can-button"><i class="fa-regular fa-trash-can"></i></button><button class="write-button pen-button"><i class="fa-solid fa-pen"></i></i></button></div>
            </div>

<link rel="stylesheet" href="<?php echo FRONTED_PATH; ?>budget-book/budget-book.css">

<p class="container header">Buku Anggaran <?php echo $_SESSION["budgetBookName"] ?? "[Unknown]"; ?></p>
<div class="subcontainer"> 
    <div class="horizontal-flex">
        <p class="container-header">Daftar Anggaran</p>
    <div class="card">
        Total Anggaran <br>
        <b>IDR <?= number_format($total_anggaran,2,',','.') ?></b>
    </div>

    <div class="card">
        Sisa <br>
        <b>IDR <?= number_format($sisa_total,2,',','.') ?></b>
    </div>

    <br><br>

    <div class="horizontal-flex">
        <p class="container-header">Daftar Akun Anggaran</p>
        <div class="add-container horizontal-flex">
            <button class="add-button">+</button>
            <div>Buat</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Akun</th>
                <th>Anggaran</th>
                <th>Pengeluaran</th>
                <th>Sisa</th>
                <th>Realisasi</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['nama_akun'] ?></td>
                <td>IDR <?= number_format($row['anggaran'],2,',','.') ?></td>
                <td>IDR <?= number_format($row['pengeluaran'],2,',','.') ?></td>
                <td>IDR <?= number_format($row['sisa'],2,',','.') ?></td>
                <td><?= number_format($row['realisasi'],2) ?>%</td>

                <td class="
                    <?=
                        ($row['status'] == 'Aman') ? 'status-hijau' :
                        (($row['status'] == 'Waspada') ? 'status-kuning' : 'status-merah')
                    ?>
                ">
                    <?= $row['status'] ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="horizontal-flex">
        <div class="catat-belanja-container horizontal-flex">
            <button class="catat-belanja-btn">Catat Belanja</button></b>
        </div>



<?php include 'koneksi.php'; ?>

<h2>Tambah Data</h2>

<form method="POST">
    Tanggal: <input type="date" name="tanggal"><br>
    Akun: <input type="text" name="akun"><br>
    Volume: <input type="number" name="volume"><br>
    Satuan: <input type="text" name="satuan"><br>
    Total: <input type="number" name="total"><br>
    Keterangan: <input type="text" name="keterangan"><br>
    <button type="submit" name="simpan">Simpan</button>
</form>

<?php
if(isset($_POST['simpan'])){
    mysqli_query($conn, "INSERT INTO belanja VALUES(
        '',
        '$_POST[tanggal]',
        '$_POST[akun]',
        '$_POST[volume]',
        '$_POST[satuan]',
        '$_POST[total]',
        '$_POST[keterangan]'
    )");

    header("location:index.php");
}
?>
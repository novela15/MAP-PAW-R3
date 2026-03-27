<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM belanja WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<form method="POST">
    Tanggal: <input type="date" name="tanggal" value="<?= $d['tanggal']; ?>"><br>
    Akun: <input type="text" name="akun" value="<?= $d['akun']; ?>"><br>
    Volume: <input type="number" name="volume" value="<?= $d['volume']; ?>"><br>
    Satuan: <input type="text" name="satuan" value="<?= $d['satuan']; ?>"><br>
    Total: <input type="number" name="total" value="<?= $d['total']; ?>"><br>
    Keterangan: <input type="text" name="keterangan" value="<?= $d['keterangan']; ?>"><br>
    <button type="submit" name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE belanja SET
        tanggal='$_POST[tanggal]',
        akun='$_POST[akun]',
        volume='$_POST[volume]',
        satuan='$_POST[satuan]',
        total='$_POST[total]',
        keterangan='$_POST[keterangan]'
        WHERE id='$id'
    ");

    header("location:index.php");
}
?>
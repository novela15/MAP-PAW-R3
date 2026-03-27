<<<<<<< HEAD
<?php include 'koneksi.php'; ?>

<h2>Catatan Belanja</h2>

<a href="tambah.php">+ Tambah Data</a>

<table border="1" cellpadding="10">
<tr>
    <th>Tanggal</th>
    <th>Akun</th>
    <th>Volume</th>
    <th>Satuan</th>
    <th>Total</th>
    <th>Keterangan</th>
    <th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM belanja");

while($d = mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $d['tanggal']; ?></td>
    <td><?= $d['akun']; ?></td>
    <td><?= $d['volume']; ?></td>
    <td><?= $d['satuan']; ?></td>
    <td><?= $d['total']; ?></td>
    <td><?= $d['keterangan']; ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id']; ?>">Edit</a> |
        <a href="hapus.php?id=<?= $d['id']; ?>">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>
=======
<?php

session_start();

// Core
require_once __DIR__ . "/core/config.php";
require_once __DIR__ . "/core/Database.php";

// Controllers
require_once CONTROLLERS_PATH . "FrontController.php";
require_once CONTROLLERS_PATH . "AuthController.php";

// Replace backslash with slash (if the server runs on Windows)
$script_directory = str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"]));

$page = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$page = str_replace($script_directory, "", $page);
$page = trim($page, "/");

try {
    $front_controller = new FrontController();

    if (isset($_SESSION["user_id"]) && ($page === "login" || $page === "signup")) {
        header("Location: " . DEFAULT_PAGE);
    } else {
        $front_controller->switchPage($page);
    }
} catch (Exception $exception) {
    echo "Something went wrong.";
}

?>
>>>>>>> b06710df0e0586238e10b10d9b07985b8ecc61b1

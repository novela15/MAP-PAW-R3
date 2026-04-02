<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MAP - Error 404</title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/error-pages/error.css?v=<?php echo time();?>">
    </head>

    <body>
        <p class="error-header">404</p>
        <p class="error-subheader">Halaman tidak ditemukan</p>
        <a href="javascript:history.back()">Kembali ke halaman sebelumnya</a>
<?php
if (ENVIRONMENT === "dev" && isset($exception)) {
    require_once ERROR_PAGES_PATH . "exception.php";
}
?>
    </body>
</html>


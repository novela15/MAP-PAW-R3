<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php
        if (isset($exception) && http_response_code() === 404) {
            echo "<title>MAP - Error 404</title>";
        } else {
            echo "<title>MAP - Error 500</title>";
        }
        ?>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/error-pages/error.css?v=<?php echo time();?>">
    </head>

    <body>
        <?php
        if (isset($exception) && http_response_code() === 404) {
            echo '<p class="error-header">404</p>';
            echo '<p class="error-subheader">Halaman tidak ditemukan</p>';
        } else {
            echo '<p class="error-header">500</p>';
            echo '<p class="error-subheader">Masalah internal server</p>';
        }
        ?>

        <a href="javascript:history.back()">Kembali ke halaman sebelumnya</a>

        <?php
        if (ENVIRONMENT === "dev" && isset($exception)) {
            require_once ERROR_PAGES_PATH . "message.php";
        }
        ?>
    </body>
</html>


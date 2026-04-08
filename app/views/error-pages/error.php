<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php if (isset($exception) && http_response_code() === 404): ?>
            <title>MAP - Error 404</title>
        <?php else: ?>
            <title>MAP - Error 500</title>
        <?php endif; ?>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/error-pages/error.css?v=<?php echo time();?>">
    </head>

    <body>
        <?php if (isset($exception) && http_response_code() === 404): ?>
            <p class="error-header">404</p>
            <p class="error-subheader">Halaman tidak ditemukan</p>
        <?php else: ?>
            <p class="error-header">500</p>
            <p class="error-subheader">Masalah internal server</p>
        <?php endif; ?>

        <a href="javascript:history.back()">Kembali ke halaman sebelumnya</a>

        <?php if (ENVIRONMENT === "dev" && isset($exception)): ?>
            <?php require_once ERROR_PAGES_PATH . "message.php"; ?>
        <?php endif; ?>
    </body>
</html>


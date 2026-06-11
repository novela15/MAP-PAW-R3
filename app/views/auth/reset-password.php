<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MAP - Reset Password</title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/auth/auth.css?v=<?php echo time(); ?>">
    </head>

    <body>
        <div class="registration-container">
            <img class="logo" src="assets/map_icon_256.png">

            <?php if(isset($_SESSION["messages"]) && isset($_SESSION["messages"]["password_reset_error"])): ?>
                <?php echo '<div class="header error-message">' . $_SESSION["messages"]["password_reset_error"] . '</div>'; ?>
            <?php endif; ?>

            <form action="reset-password?token=<?php echo $_GET["token"] . '&email=' . $_GET["email"]; ?>" method="POST">
		        <div class="input-container">
		            <p class="input-label">Password</p>
		            <input
                        class="input password-input"
                        name="password_input"
                        type="password"
                        placeholder="Password (minimal 6 karakter)"
                    >
		            <p class="input-label">Konfirmasi Password</p>
		            <input
                        class="input password-confirm-input"
                        name="password_confirm_input"
                        type="password"
                        placeholder="Konfirmasi Password"
                    >
		        </div>

		        <div class="input-container button-container">
		            <button class="reset-button" name="login_email">Reset password</button>
		        </div>
            </form>
        </div>
    </body>
</html>

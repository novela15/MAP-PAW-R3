<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MAP - Sign Up</title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/auth/auth.css?v=<?php echo time();?>">
    </head>

    <body>
        <div class="registration-container">
            <img class="logo" src="assets/map_icon_256.png">
            <p class="header">Daftar</p>

            <form action="signup" method="POST">
		        <div class="input-container">
		            <p class="input-label">Username</p>
		            <input
                        class="input username-input"
                        name="username_input"
                        type="text"
                        placeholder="Username"
                    >
                    <?php if(isset($_SESSION["messages"]) && isset($_SESSION["messages"]["username_error"])): ?>
                        <?php echo '<div class="error-message">' . $_SESSION["messages"]["username_error"] . '</div>'; ?>
                    <?php endif; ?>
		            <p class="input-label">Email</p>
		            <input
                        class="input email-input"
                        name="email_input"
                        type="email"
                        placeholder="Email"
                    >
                    <?php if(isset($_SESSION["messages"]) && isset($_SESSION["messages"]["email_error"])): ?>
                        <?php echo '<div class="error-message">' . $_SESSION["messages"]["email_error"] . '</div>'; ?>
                    <?php endif; ?>
		            <p class="input-label">Password</p>
		            <input
                        class="input password-input"
                        name="password_input"
                        type="password"
                        placeholder="Password (minimal 6 karakter)"
                    >
                    <?php if(isset($_SESSION["messages"]) && isset($_SESSION["messages"]["password_error"])): ?>
                        <?php echo '<div class="error-message">' . $_SESSION["messages"]["password_error"] . '</div>'; ?>
                    <?php endif; ?>
		            <p class="input-label">Konfirmasi Password</p>
		            <input
                        class="input password-confirm-input"
                        name="password_confirm_input"
                        type="password"
                        placeholder="Konfirmasi Password"
                    >
                    <?php if(isset($_SESSION["messages"]) && isset($_SESSION["messages"]["password_error"])): ?>
                        <?php echo '<div class="error-message">' . $_SESSION["messages"]["password_error"] . '</div>'; ?>
                    <?php endif; ?>
		        </div>

		        <div class="input-container button-container">
		            <button class="signup-email" name="signup_email" type="submit">Daftar</button>
		            <div>atau</div>
		            <button class="signup-google" name="signup_google" type="submit">Daftar dengan<img src="https://www.google.com/favicon.ico" loading="lazy"></button>
		        </div>
            </form>

            <div class="link">Sudah punya akun? <a href="login">Masuk</a></div>
        </div>
    </body>
</html>

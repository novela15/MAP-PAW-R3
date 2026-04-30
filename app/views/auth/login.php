<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MAP - Login</title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/auth/auth.css?v=<?php echo time();?>">
    </head>

    <body>
        <div class="registration-container">
            <img class="logo" src="assets/map_icon_256.png">
            <p class="header">Masuk</p>

            <form action="login" method="POST">
		        <div class="input-container">
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
                        placeholder="Password"
                    >
                    <?php if(isset($_SESSION["messages"]) && isset($_SESSION["messages"]["password_error"])): ?>
                        <?php echo '<div class="error-message">' . $_SESSION["messages"]["password_error"] . '</div>'; ?>
                    <?php endif; ?>
		            <a href="" class="forgot-password">Lupa password?</a>
		        </div>

		        <div class="input-container button-container">
		            <button class="login-email" name="login_email">Masuk</button>
		            <div>atau</div>
		            <button class="login-google" name="login_google">Masuk dengan<img src="https://www.google.com/favicon.ico" loading="lazy"></button>
		        </div>
            </form>

            <div class="link">Belum punya akun? <a href="signup">Daftar</a></div>
        </div>
    </body>
</html>

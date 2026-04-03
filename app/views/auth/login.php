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
                        placeholder="<?php echo $messages["email_error"] ?? "Email"; ?>"
                    >
		            <p class="input-label">Password</p>
		            <input
                        class="input password-input"
                        name="password_input"
                        type="password"
                        placeholder="<?php echo $messages["password_error"] ?? "Password"; ?>"
                    >
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

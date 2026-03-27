<!DOCTYPE html>

<?php
// TODO: Add a blurred MAP logo as the background.
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MAP - Login</title>

        <link rel="stylesheet" href="<?php echo VIEWS_PATH; ?>auth/auth.css">
    </head>

    <body>
        <div class="registration-container">
            <p class="header">Login</p>

            <form action="login" method="POST">
		        <div class="input-container">
		            <p class="input-label">Email</p>
		            <input class="input email-input" name="email_input" type="email" placeholder="<?php echo $email_error ?? "Email"; ?>">
		            <p class="input-label">Password</p>
		            <input class="input password-input" name="password_input" type="password" placeholder="<?php echo $password_error ?? "Password"; ?>">
		            <a href="" class="forgot-password">Lupa password?</a>
		        </div>

		        <div class="input-container button-container">
		            <button class="login-email" name="login_email">Login</button>
		            <div>atau</div>
		            <button class="login-google" name="login_google">Login dengan<img src="https://www.google.com/favicon.ico" loading="lazy"></button>
		        </div>
            </form>

            <div class="sign-in-link">
                <a href="signup">Belum punya akun? Sign up.</a>
            </div>
        </div>
    </body>
</html>

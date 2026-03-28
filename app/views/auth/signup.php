<!DOCTYPE html>

<?php
// TODO: Add a blurred MAP logo as the background.
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MAP - Sign Up</title>

        <link rel="stylesheet" href="<?php echo FRONTEND_PATH; ?>auth/auth.css">
    </head>

    <body>
        <div class="registration-container">
            <p class="header">Sign Up</p>

            <form action="signup" method="POST">
		        <div class="input-container">
		            <p class="input-label">Username</p>
		            <input class="input username-input" name="username_input" type="text" placeholder="<?php echo $username_error ?? "Username"; ?>">
		            <p class="input-label">Email</p>
		            <input class="input email-input" name="email_input" type="email" placeholder="<?php echo $email_error ?? "Email"; ?>">
		            <p class="input-label">Password</p>
		            <input class="input password-input" name="password_input" type="password" placeholder="<?php echo $password_error ?? "Password (minimal 6 karakter)"; ?>">
		            <p class="input-label">Konfirmasi Password</p>
		            <input class="input password-confirm-input" name="password_confirm_input" type="password" placeholder="<?php echo $password_error ?? "Konfirmasi Password"; ?>">
		        </div>

		        <div class="input-container button-container">
		            <button class="signup-email" name="signup_email" type="submit">Sign Up</button>
		            <div>atau</div>
		            <button class="signup-google" name="signup_google" type="submit">Sign up dengan<img src="https://www.google.com/favicon.ico" loading="lazy"></button>
		        </div>
            </form>

            <div class="sign-in-link">
                <a href="login">Sudah punya akun? Login.</a>
            </div>
        </div>
    </body>
</html>

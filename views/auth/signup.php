<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo VIEWS_PATH; ?>auth/auth.css">
    </head>

    <body>
        <div class="registration-container">
            <p class="header">Sign Up</p>

            <form action="signup" method="POST">
		        <div class="input-container">
		            <p class="input-label">Username</p>
		            <input class="input username-input" name="username_input" type="text" placeholder="Username" autocomplete="off">
		            <p class="input-label">Email</p>
		            <input class="input email-input" name="email_input" type="email" placeholder="Email" autocomplete="off">
		            <p class="input-label">Password</p>
		            <input class="input password-input" name="password_input" type="password" placeholder="Password">
		            <p class="input-label">Confirm Password</p>
		            <input class="input password-confirm-input" name="password_confirm_input" type="password" placeholder="Confirm Password">
		        </div>

		        <div class="input-container button-container">
		            <button class="signup-email" name="signup_email" type="submit">Sign Up</button>
		            <div>or</div>
		            <button class="signup-google" name="signup_google" type="submit">Sign up with<img src="https://www.google.com/favicon.ico" loading="lazy"></button>
		        </div>
            </form>

            <div class="sign-in-link">
                <a href="login">Have an account? Sign in.</a>
            </div>
        </div>

        <!--<script src="registration.js"></script>-->
    </body>
</html>

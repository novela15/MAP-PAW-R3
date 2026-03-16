<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo VIEWS_PATH; ?>auth/auth.css">
    </head>

    <body>
        <div class="registration-container">
            <p class="header">Sign In</p>

            <form action="index.php?page=login" method="POST">
		        <div class="input-container">
		            <p class="input-label">Email</p>
		            <input class="input email-input" name="email_input" type="email" placeholder="Email" autocomplete="off">
		            <p class="input-label">Password</p>
		            <input class="input password-input" name="password_input" type="password" placeholder="Password">
		            <a href="" class="forgot-password">Forgot password?</a>
		        </div>

		        <div class="input-container button-container">
		            <button class="login-email">Sign In</button>
		            <div>or</div>
		            <button class="login-google">Sign in with<img src="https://www.google.com/favicon.ico" loading="lazy"></button>
		        </div>
            </form>

            <div class="sign-in-link">
                <a href="index.php?page=signup">No account? Sign up.</a>
            </div>
        </div>

        <!--<script src="registration.js"></script>-->
    </body>
</html>

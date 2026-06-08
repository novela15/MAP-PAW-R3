<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MAP - Request Password Reset</title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="frontend/auth/auth.css?v=<?php echo time(); ?>">
    </head>

    <body>
        <div class="registration-container">
            <img class="logo" src="assets/map_icon_256.png">
            <p class="header">Reset Password</p>

            <form action="request-password-reset" method="POST">
		        <div class="input-container">
		            <p class="input-label">Email</p>
		            <input
                        class="input email-input"
                        name="email_input"
                        type="email"
                        placeholder="Email"
                    >
		        </div>

		        <div class="input-container button-container">
		            <button class="reset-button" name="login_email">Kirim email</button>
		        </div>

                <p class="footer">Pastikan email yang anda gunakan aktif!</p>
            </form>
        </div>
    </body>
</html>

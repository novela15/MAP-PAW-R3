<link rel="stylesheet" href="frontend/settings/settings.css?v=<?php echo time();?>">

<p class="container-header">Setelan Akun</p>

<div class="subcontainer">
    <form class="account-form" action="settings" method="POST">
        <div class="input-container">
            <p class="input-label">Username</p>
            <input
                class="input username-input"
                name="username_input"
                type="text"
                placeholder="<?php echo $messages["username_error"] ?? "Username"; ?>"
                value="<?php echo $userData["username"] ?? ""; ?>"
            >
            <p class="input-label">Email</p>
            <input
                class="input email-input"
                name="email_input" type="email"
                placeholder="<?php echo $messages["email_error"] ?? "Email"; ?>"
                value="<?php echo $userData["email"] ?? ""; ?>"
            >
            <p class="input-label">Password</p>
            <input
                class="input password-input"
                name="password_input"
                type="password"
                placeholder="<?php echo $messages["password_error"] ?? "Password (minimal 6 karakter)"; ?>"
            >
            <p class="input-label">Konfirmasi Password</p>
            <input
                class="input password-confirm-input"
                name="password_confirm_input"
                type="password"
                placeholder="<?php echo $messages["password_error"] ?? "Konfirmasi Password"; ?>"
            >
        </div>

        <div class="input-container button-container">
            <button class="confirm-button" name="confirm_user_settings" type="submit">Konfirmasi Perubahan</button>
        </div>
    </form>
</div>

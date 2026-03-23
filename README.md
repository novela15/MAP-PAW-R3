# MAP-PAW-R3

### Attention to Group Members

This web app uses the MVC architecture pattern. Please put HTML, CSS, JS, or PHP files that are used as the frontend in a directory named `views` that is a **direct child** of `MAP-PAW-R3`. The project structure roughly look like this:
```
/MAP-PAW-R3
├── controllers
│   ├── AuthController.php
│   └── FrontController.php
├── models
└── views
    ├── auth
    │   ├── html
    │   ├── css
    │   └── js
    ├── budget-account
    │   ├── html
    │   ├── css
    │   └── js
    └── more-pages-here :D
        ├── html
        ├── css
        └── js
```

To make the UI between pages consistent, a skeleton branch is made to develop the page skeleton HTML structure, which consists of the **main style, container, and sidebar**. The skeleton is separated into a top and bottom part. To use the skeleton, make the page file as PHP and structure it like this:
```php
<?php require SKELETON_PATH . "skeleton-top.php"; ?>

<!--
Your HTML here, everything between the skeleton-top and skeleton-bottom
is INSIDE the container div (<div class="container">).
-->

<?php require_once SKELETON_PATH . "skeleton-bottom.php"; ?>
```

Or for a real example, look at [this file](https://github.com/novela15/MAP-PAW-R3/blob/skeleton/views/budget-account/budget-account.php).

---

Run the project in a server, it's possible to use either XAMPP or Docker/Podman. Docker and Podman should be very similar to use.

### XAMPP
1. Start Apache and MySQL from the XAMPP Control Panel.
2. Put the entire server directory inside `C:\xampp\htdocs` (for Windows), `/opt/xampp/htdocs` (for Linux), or wherever else the XAMPP installation is.
3. Access the website from `http://localhost/server_dir`.<br>Access phpMyAdmin from `http://localhost/phpmyadmin/`.

### Docker
1. Pull [the Docker image](https://hub.docker.com/r/tomsik68/xampp/).
```bash
docker pull tomsik68/xampp
```
2. Run the image.
```bash
docker run --name myXampp -p 41061:22 -p 41062:80 -d -v ~/server_dir:/www tomsik68/xampp
```
3. Access the website from `http://localhost:41062/www`.<br>Access the XAMPP interface from `http://localhost:41062/`.<br>Access phpMyAdmin from `http://localhost:41062/phpmyadmin/`.

### Podman
1. Pull [the Docker image](https://hub.docker.com/r/tomsik68/xampp/).
```bash
podman pull docker.io/tomsik68/xampp
```
2. Run the image.
```bash
podman run --name myXampp -p 41061:22 -p 41062:80 -d -v ~/server_dir:/www tomsik68/xampp
```
3. Access the website from `http://localhost:41062/www`.<br>Access the XAMPP interface from `http://localhost:41062/`.<br>Access phpMyAdmin from `http://localhost:41062/phpmyadmin/`.

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

---

To run the project in a server, use either XAMPP or Docker/Podman. Docker and Podman should be very similar to use.

### XAMPP
1. Start Apache and MySQL from the XAMPP Control Panel.
2. Put the entire server directory inside `C:\xampp\htdocs` (for Windows), `/opt/xampp` (for Linux), or wherever else the XAMPP installation is.
3. Access the website from `https://localhost/server_dir`.

### Docker
1. Pull [the Docker image](https://hub.docker.com/r/tomsik68/xampp/).
```
docker pull tomsik68/xampp
```
2. Run the image.
```
docker run --name myXampp -p 41061:22 -p 41062:80 -d -v ~/server_dir:/www tomsik68/xampp
```
3. Access the website from `http://localhost:41062/www`.<br>Access the XAMPP interface from `http://localhost:41062/`.<br>Access the phpMyAdmin from `http://localhost:41062/phpmyadmin/`.

### Podman
1. Pull [the Docker image](https://hub.docker.com/r/tomsik68/xampp/).
```
podman pull docker.io/tomsik68/xampp
```
2. Run the image.
```
podman run --name myXampp -p 41061:22 -p 41062:80 -d -v ~/server_dir:/www tomsik68/xampp
```
3. Access the website from `http://localhost:41062/www`.<br>Access the XAMPP interface from `http://localhost:41062/`.<br>Access the phpMyAdmin from `http://localhost:41062/phpmyadmin/`.

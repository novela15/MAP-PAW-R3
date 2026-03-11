function toggleSidebar(){

    document.getElementById("sidebar")
    .classList.toggle("close");

}

function toggleDropdown() {

    const menu = document.getElementById("laporanMenu");

    if(menu.style.display === "flex"){
        menu.style.display = "none";
    } else {
        menu.style.display = "flex";
    }

}

function loadPage(page){

    fetch(page)
    .then(response => response.text())
    .then(data => {

        document.getElementById("content-area").innerHTML = data;

    })
    .catch(error => {

        document.getElementById("content-area").innerHTML =
        "<h3>Halaman tidak ditemukan</h3>";

    });

}

function toggleDropdown() {

    const menu = document.getElementById("laporanMenu");

    if(menu.style.display === "flex"){
        menu.style.display = "none";
    } else {
        menu.style.display = "flex";
    }

}
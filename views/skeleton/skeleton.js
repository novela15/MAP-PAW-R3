let buttons = document.querySelectorAll(".sidebar-button.has-submenu");

function replace_chevron(button, chevron) {
    const old_icon = button.querySelector(".submenu-icon");
    const new_icon = document.createElement("i");
    new_icon.className = `fas ${chevron} submenu-icon`;
    old_icon.replaceWith(new_icon);
}

for (const button of buttons) {
    button.addEventListener("click", function() {
        let submenu = button.nextElementSibling;

        submenu.classList.toggle("hidden");

        if (submenu.classList.contains("hidden")) {
            replace_chevron(button, "fa-chevron-right");
        } else {
            replace_chevron(button, "fa-chevron-down");
        }
    });
}

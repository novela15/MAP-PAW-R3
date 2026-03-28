// Runtime variables
let is_sidebar_collapsed = false;
let pathname = window.location.pathname;

// Single elements
let container = document.querySelector(".container");
let current_page_anchor = document.querySelector('a.sidebar-button[href="' + pathname.substring(pathname.lastIndexOf("/") + 1) + '"]');
let sidebar = document.querySelector(".sidebar");
let sidebar_toggle_button = document.querySelector(".sidebar-toggle-button");

// Elements list
let sidebar_anchors = document.querySelectorAll("a.sidebar-button");
let sidebar_buttons = document.querySelectorAll("button.sidebar-button");


function replace_chevron(button, chevron) {
    const old_icon = button.querySelector(".submenu-icon");
    const new_icon = document.createElement("i");
    new_icon.className = `fas ${chevron} submenu-icon`;
    old_icon.replaceWith(new_icon);
}


function set_tooltips(current_state) {
    for (const button of sidebar_buttons) {
        if (current_state === "true") {
            button.title = button.querySelector(".text").textContent;
        } else {
            button.removeAttribute("title");
        }
    }
}


for (const button of sidebar_buttons) {
    if (!button.classList.contains("has-submenu")) { continue; }

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


sidebar_toggle_button.addEventListener("click", function() {
    document.documentElement.classList.toggle("sidebar-collapsed");

    const current_state = document.documentElement.classList.contains("sidebar-collapsed").toString();

    localStorage.setItem("is_sidebar_collapsed", current_state);
    set_tooltips(current_state);
});


// Initializer
requestAnimationFrame(() => {
    container.classList.remove("no-transition");
    sidebar.classList.remove("no-transition");
});

current_page_anchor.classList.add("selected-sidebar-button");

if (current_page_anchor.parentElement.classList.contains("submenu")) {
    current_page_anchor.parentElement.previousElementSibling.click();
}

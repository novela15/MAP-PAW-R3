// Runtime variables
let isSidebarCollapsed = false;
let pathname = window.location.pathname;

// Single elements
const CLOSE_BOOK_BUTTON = document.querySelector(".close-book-button");
const LOGOUT_BUTTON = document.querySelector(".sidebar-logout-button");
let container = document.querySelector(".container");
let currentPageAnchor = document.querySelector('a.sidebar-button[href="' + pathname.substring(pathname.lastIndexOf("/") + 1) + '"]');
let sidebar = document.querySelector(".sidebar");
let sidebarToggleButton = document.querySelector(".sidebar-toggle-button");

// Elements list
let sidebarAnchors = document.querySelectorAll("a.sidebar-button");
let sidebarButtons = document.querySelectorAll("button.sidebar-button");
let searchBars = document.querySelectorAll(".container .search-bar");


function replaceChevron(button, chevron) {
    const old_icon = button.querySelector(".submenu-icon");
    const new_icon = document.createElement("i");
    new_icon.className = `fas ${chevron} submenu-icon`;
    old_icon.replaceWith(new_icon);
}


function setTooltips(current_state) {
    for (const array of [sidebarAnchors, sidebarButtons]) {
        for (const button of array) {
            if (current_state === "true") {
                button.title = button.querySelector(".text").textContent;
            } else {
                button.removeAttribute("title");
            }
        }
    }
}


for (const button of sidebarButtons) {
    if (!button.classList.contains("has-submenu")) { continue; }

    button.addEventListener("click", function() {
        let submenu = button.nextElementSibling;

        submenu.classList.toggle("hidden");

        if (submenu.classList.contains("hidden")) {
            replaceChevron(button, "fa-chevron-right");
        } else {
            replaceChevron(button, "fa-chevron-down");
        }
    });
}


CLOSE_BOOK_BUTTON.addEventListener("click", function() {
    openModal("modal-close-book");
});


LOGOUT_BUTTON.addEventListener("click", function() {
    openModal("modal-logout");
});


sidebarToggleButton.addEventListener("click", function() {
    document.documentElement.classList.toggle("sidebar-collapsed");

    const current_state = document.documentElement.classList.contains("sidebar-collapsed").toString();

    localStorage.setItem("is_sidebar_collapsed", current_state);
    setTooltips(current_state);
});


for (let i = 0; i < searchBars.length; i++) {
  let searchBar = searchBars[i];
  
  searchBar.addEventListener("input", function (e) {
    let cards = document.querySelectorAll("." + searchBar.getAttribute("search-class"));
    
    for (let j = 0; j < cards.length; j++) {
      let card = cards[j];
      let nameElement = card.querySelector("." + searchBar.getAttribute("search-class-filter"));
      
      if (nameElement) {
        if (nameElement.textContent.toLowerCase().includes(e.target.value.toLowerCase())) {
          card.classList.remove("hidden");
        } else {
          card.classList.add("hidden");
        }
      }
    }
  });
}


// Initializer
requestAnimationFrame(() => {
    container.classList.remove("no-transition");
    sidebar.classList.remove("no-transition");
});

currentPageAnchor.classList.add("selected-sidebar-button");

if (currentPageAnchor.parentElement.classList.contains("submenu")) {
    currentPageAnchor.parentElement.previousElementSibling.click();
}

setTooltips(document.documentElement.classList.contains("sidebar-collapsed").toString());

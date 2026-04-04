const DELETE_BUTTONS = document.querySelectorAll(".table-action .delete-button");
const WRITE_BUTTONS = document.querySelectorAll(".table-action .write-button");

for (const BUTTON of DELETE_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        openModal("modal-delete", BUTTON.getAttribute("item-id"));
    });
}

for (const BUTTON of WRITE_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        openModal("modal-account", BUTTON.getAttribute("item-id"));
    });
}

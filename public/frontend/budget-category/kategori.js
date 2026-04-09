const ADD_BUTTON = document.querySelector(".add-button");

const DELETE_BUTTONS = document.querySelectorAll(".table-action .delete-button");
const EDIT_BUTTONS = document.querySelectorAll(".table-action .write-button");

for (const BUTTON of DELETE_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        openModal("modal-category-delete", BUTTON.getAttribute("item-id"));
    });
}

for (const BUTTON of EDIT_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        openModal("modal-category-edit", BUTTON.getAttribute("item-id"));
    });
}

ADD_BUTTON.addEventListener("click", function() {
    openModal("modal-category-add");
});

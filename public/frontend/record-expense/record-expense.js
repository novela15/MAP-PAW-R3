const ADD_BUTTON = document.querySelector(".add-button");

const DELETE_BUTTONS = document.querySelectorAll(".action .delete-button");
const EDIT_BUTTONS = document.querySelectorAll(".action .write-button");

for (const BUTTON of DELETE_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        openModal("modal-expense-delete", BUTTON.getAttribute("item-id"));
    });
}

for (const BUTTON of EDIT_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        openModal("modal-expense-edit", BUTTON.getAttribute("item-id"));
    });
}

for (const element of document.querySelectorAll(".datetime")) {
    const utcDateStr = element.getAttribute("utc");
    if (!utcDateStr) continue;

    const localDate = new Date(utcDateStr);

    element.textContent = localDate.toLocaleString("en-GB", {
        weekday: "short",
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        hour12: false,
    });
}

ADD_BUTTON.addEventListener("click", function() {
    openModal("modal-expense-add");
});

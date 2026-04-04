const MODAL =  document.querySelector(".modal-account");
const MODAL_OVERLAY =  document.querySelector(".modal-overlay");
const MODAL_BUTTONS = document.querySelectorAll(".table-action button");
const MODAL_CLOSER_BUTTONS = document.querySelectorAll("button.modal-closer");

for (const BUTTON of MODAL_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        MODAL.classList.remove("hidden");
        MODAL_OVERLAY.classList.remove("hidden");
    });
}

for (const BUTTON of MODAL_CLOSER_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        MODAL.classList.add("hidden");
        MODAL_OVERLAY.classList.add("hidden");
    });
}

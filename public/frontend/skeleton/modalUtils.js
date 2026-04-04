const MODAL = document.querySelector(".modal-overlay");
const MODAL_CLOSER_BUTTONS = document.querySelectorAll("button.modal-closer");

export function closeModal() {
    MODAL.classList.add("hidden");
    MODAL.innerHTML = "";
}

export async function openModal() {
    const RESPONSE = await fetch(`modal?type=${arguments[0] ?? ""}&item_id=${arguments[1] ?? 0}`);
    const HTML = await RESPONSE.text();

    const PARSER = new DOMParser();
    const MODAL_DOC = PARSER.parseFromString(HTML, "text/html");

    MODAL.appendChild(MODAL_DOC.querySelector(".modal"));
    MODAL.classList.remove("hidden");
}

for (const BUTTON of MODAL_CLOSER_BUTTONS) {
    BUTTON.addEventListener("click", function() {
        closeModal();
    });
}

window.closeModal = closeModal;
window.openModal = openModal;

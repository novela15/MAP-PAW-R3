const SEARCH_BAR = document.querySelector(".category-search-input");

function search() {
    const ITEMS = document.querySelectorAll(".category-grid .box-url");

    for (const item of ITEMS) {
        const text = item.textContent || item.innerText;

        if (text.toLowerCase().includes(SEARCH_BAR.value.toLowerCase())) {
            item.classList.remove("invisible");
        } else {
            item.classList.add("invisible");
        }
    }
}

SEARCH_BAR.addEventListener("input", search);

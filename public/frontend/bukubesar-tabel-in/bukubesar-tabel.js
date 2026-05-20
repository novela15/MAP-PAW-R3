document.addEventListener("DOMContentLoaded", () => {
    const btnUnduh = document.getElementById("btnUnduhBukuBesar");
    if (btnUnduh) {
        btnUnduh.addEventListener("click", () => {
            alert("Mengunduh Laporan Buku Besar...");
        });
    }
});
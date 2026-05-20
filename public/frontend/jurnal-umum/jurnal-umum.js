document.addEventListener("DOMContentLoaded", () => {
    const btnUnduh = document.getElementById("btnUnduhJurnal");
    const btnInvoices = document.querySelectorAll(".btn-invoice");

    if (btnUnduh) {
        btnUnduh.addEventListener("click", () => {
            alert("Mengunduh Laporan Jurnal Umum...");
        });
    }

    btnInvoices.forEach((btn, index) => {
        btn.addEventListener("click", () => {
            alert(`Membuka bukti pengeluaran untuk baris ke-${index + 1}`);
        });
    });
});
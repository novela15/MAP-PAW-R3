document.addEventListener("DOMContentLoaded", () => {

    const btnUnduh = document.getElementById("btnUnduhJurnal");
    const btnInvoices = document.querySelectorAll(".btn-invoice");

    // Tombol unduh
    if (btnUnduh) {
        btnUnduh.addEventListener(
            "click",
            () => {
                exportTableToExcel(
                    "table-excel-jurnal",
                    "Jurnal_Umum"
                );
            }
        );
    }

    // Tombol bukti pengeluaran
    btnInvoices.forEach((btn, index) => {
        btn.addEventListener("click", () => {
            alert(`Membuka bukti pengeluaran untuk baris ke-${index + 1}`);
        });
    });

});
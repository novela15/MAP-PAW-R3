document.addEventListener("DOMContentLoaded", () => {

    const btn = document.querySelector(".btn-unduh");

    if (btn) {
        btn.addEventListener("click", () => {
            exportTableToExcel(
                "table-excel",
                "Laporan_Realisasi_Anggaran"
            );
        });
    }

});
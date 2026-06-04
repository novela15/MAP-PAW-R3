document.addEventListener("DOMContentLoaded", () => {

    const btn =
        document.getElementById(
            "btnUnduhBukuBesar"
        );

    if (!btn) return;

    btn.addEventListener(
        "click",
        () => {

            exportTableToExcel(
                "table-excel-buku-besar",
                "Buku_Besar"
            );

        }
    );

});
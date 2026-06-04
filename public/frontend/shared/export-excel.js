function exportTableToExcel(tableId, fileName) {

    const table = document.getElementById(tableId);

    if (!table) {
        console.error(`Table ${tableId} tidak ditemukan`);
        return;
    }

    const workbook = XLSX.utils.table_to_book(
        table,
        {
            sheet: "Laporan"
        }
    );

    const today = new Date()
        .toISOString()
        .slice(0, 10);

    XLSX.writeFile(
        workbook,
        `${fileName}_${today}.xlsx`
    );
}
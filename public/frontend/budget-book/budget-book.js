// Documentations can be seen here:
// https://developers-dot-devsite-v2-prod.appspot.com/chart/interactive/docs/gallery

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawCategoriesChart);
google.charts.setOnLoadCallback(drawMonthlySpendingDataChart);

function drawCategoriesChart() {
    if (!window.budgetData || window.budgetData.length === 0) { return; }

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Kategori');
    data.addColumn('number', 'Anggaran');
    data.addColumn('number', 'Pengeluaran');
    data.addColumn('number', 'Sisa/Kurang');

    data.addRows(window.budgetData);

    var options = {
        chartArea: {
            width: '60%',
            height: '75%',
        },
        vAxis: {
            title: 'Nilai (Rp)',
            format: 'Rp#,###',
        },
        title: "Status Anggaran per Kategori",
    };

    var chart = new google.visualization.ColumnChart(document.querySelector('.categories-chart'));
    chart.draw(data, options);
}

function drawMonthlySpendingDataChart() {
    if (!window.monthlySpendingData || window.monthlySpendingData.length === 0) { return; }

    var data = new google.visualization.arrayToDataTable(window.monthlySpendingData);
    data.addColumn('string', 'Bulan');
    data.addColumn('string', 'Kategori');
    data.addColumn('number', 'Pengeluaran');

    var options = {
        title: 'Pengeluaran Bulanan Per Kategori',
        isStacked: true,
        height: 500,
        legend: { position: 'top', maxLines: 3 },
        vAxis: { title: 'Pengeluaran', minValue: 0 },
        hAxis: { title: 'Bulan' }
    };

    var chart = new google.visualization.ColumnChart(document.querySelector('.monthly-spending-chart'));
    chart.draw(data, options);
}

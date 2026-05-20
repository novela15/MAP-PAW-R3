<link rel="stylesheet" href="frontend/general-ledger/bukubesar-tabel.css?v=<?php echo time();?>">

<div class="app-container">
    <main class="main-content">
        <div class="content-wrapper">
            <h1 class="page-title">Laporan</h1>
            
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Buku Besar <span class="category-placeholder">[namaKategori]</span></h2>
                </div>

                <div class="table-container">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="total-row">
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button class="btn-unduh" id="btnUnduhBukuBesar">Unduh</button>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="frontend/sidebar/sidebar.js?v=<?php echo time();?>"></script>
<script src="frontend/general-ledger/buku-besar.js?v=<?php echo time();?>"></script>
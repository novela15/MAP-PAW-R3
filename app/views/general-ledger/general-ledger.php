    <link rel="stylesheet" href="frontend/general-ledger/buku-besar.css?v=<?php echo time();?>">

    <p class="container-header">Laporan</p>

    <div class="subcontainer">
        <!-- Main Content -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Buku Besar</h2>
                    <div class="search-category">
                        <input type="text" placeholder="Cari Kategori" class="category-search-input" id="categorySearch">
                        <svg class="category-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </div>
                </div>

                <div class="category-grid" id="categoryGrid">
                    <!-- Default: 12 kotak placeholder -->
                </div>
            </div>
    </div>

    <script src="frontend/general-ledger/buku-besar.js?v=<?php echo time();?>"></script>

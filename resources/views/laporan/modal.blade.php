<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content" id="print-content">
            <div class="modal-header">
                <div type="button" class="btn btn-success" onclick="print()">
                    <span>
                        <i data-feather="printer"></i>
                        Print
                    </span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">INVOICE Pembelian</h3>
                    <p class="text-muted">Detail pembelian barang</p>
                </div>
                <div class="row mb-1">
                    <div class="col-md-6"><strong>Kode Pembelian:</strong> <span id="modal-kode"></span></div>
                    <div class="col-md-6"><strong>User:</strong> <span id="modal-user"></span></div>
                    <div class="col-md-6"><strong>Pemasok:</strong> <span id="modal-pemasok"></span></div>
                    <div class="col-md-6"><strong>Total:</strong> <span id="modal-total"></span></div>
                    <div class="col-md-6"><strong>Tanggal Pembelian:</strong> <span id="modal-tanggal_terima"></span>
                    </div>
                    <div class="col-md-6"><strong>Tanggal Masuk:</strong> <span id="modal-tanggal_masuk"></span></div>
                    <div class="col-md-6"><strong>Keterangan:</strong> <span id="modal-keterangan"></span></div>
                </div>
                <table class="table table-bordered" id="modal-detail-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode Detail</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi dengan JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

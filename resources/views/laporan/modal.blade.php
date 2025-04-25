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

<div class="modal fade" id="modalDetailPenjualan" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content" id="print-content-penjualan">
            <div class="modal-header">
                <div type="button" class="btn btn-success" onclick="printPenjualan()">
                    <span>
                        <i data-feather="printer"></i>
                        Print
                    </span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">STUK PENJUALAN</h3>
                    <p class="text-muted">No Faktur: <span id="modal-no-faktur"></span></p>
                </div>
                <div class="row mb-1">
                    <div class="col-12"><strong>Tanggal:</strong> <span id="modal-tanggal"></span></div>
                    <div class="col-12"><strong>Pelanggan:</strong> <span id="modal-pelanggan"></span></div>
                    <div class="col-12"><strong>Kasir:</strong> <span id="modal-kasir"></span></div>
                </div>
                <table style="width: 100%; " id="modal-detail-table-penjualan">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi dengan JavaScript -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="#ddd; padding: 8px; text-align: right;">
                                <strong>Total:</strong>
                            </td>
                            <td>
                                <span id="modal-total-penjualan"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="#ddd; padding: 8px; text-align: right;">
                                <strong>Dibayar:</strong>
                            </td>
                            <td>
                                <span id="modal-dibayar"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="#ddd; padding: 8px; text-align: right;">
                                <strong>Kembali:</strong>
                            </td>
                            <td>
                                <span id="modal-kembali"></span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

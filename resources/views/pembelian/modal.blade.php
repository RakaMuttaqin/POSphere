<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Transaksi Pembelian</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('pembelian.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="mb-1">
                        <label class="form-label" for="pemasok_id">Pemasok</label>
                        <select class="select2 form-select" id="pemasok_id" name="pemasok_id" required>
                            @foreach ($pemasok as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="tanggal_terima">Tanggal Pembelian</label>
                        <input type="date" id="tanggal_terima" class="form-control" name="tanggal_terima" required>
                    </div>

                    {{-- <div class="mb-1">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <input type="text" id="keterangan" class="form-control" name="keterangan">
                    </div> --}}

                    <div class="mb-1">
                        <label class="form-label" for="searchBarang">Cari Barang</label>
                        <select class="form-select select2" id="searchBarang"></select>
                    </div>

                    <table class="table" id="detailPembelian">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Expired</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

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
                            <th>Margin</th>
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

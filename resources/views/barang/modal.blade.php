<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('barang.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="row g-1">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="kode_jenis_barang">Jenis Barang</label>
                            <select id="kode_jenis_barang" class="form-control" name="kode_jenis_barang" required>
                                <option value="" disabled selected>Pilih Jenis Barang</option>
                                @foreach ($jenisBarang as $jenis)
                                    <option value="{{ $jenis->kode }}">{{ $jenis->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="barcode">Barcode</label>
                            <input type="number" id="barcode" class="form-control" placeholder="Barcode"
                                name="barcode" required autocomplete="off" />
                        </div>
                    </div>

                    <div class="row g-1">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="nama">Nama Barang</label>
                            <input type="text" id="nama" class="form-control" placeholder="Nama Barang"
                                name="nama" required autocomplete="off" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="satuan_id">Satuan</label>
                            <select id="satuan_id" class="form-control" name="satuan_id" required>
                                <option value="" disabled selected>Pilih Satuan</option>
                                @foreach ($satuan as $items)
                                    <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="harga" class="row g-1" hidden>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="harga_beli">Harga Beli</label>
                            <input type="number" id="harga_beli" class="form-control" placeholder="Harga Beli"
                                name="harga_beli" value="0" required autocomplete="off" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="harga_jual">Harga Jual</label>
                            <input type="number" id="harga_jual" class="form-control" placeholder="Harga Jual"
                                name="harga_jual" value="0" required autocomplete="off" />
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="gambar">Gambar</label>
                        <input type="file" id="gambar" class="form-control" name="gambar" accept="image/*" />
                    </div>

                    <div class="d-flex justify-content-center mb-1">
                        <img id="gambarPreview" src="" alt="" class="img-preview" width="100">
                    </div>

                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

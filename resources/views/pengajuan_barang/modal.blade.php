<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('pengajuan-barang.store') }}" method="POST">
                    @csrf
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="mb-1">
                        <label class="form-label" for="kode_member">Nama Pengajuan</label>
                        <select name="kode_member" id="kode_member" class="form-select select2"></select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="nama_barang">Nama Barang</label>
                        <input type="nama_barang" id="nama_barang" class="form-control" placeholder="Nama Barang"
                            name="nama_barang" required autocomplete="off" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="qty">Jumlah</label>
                        <input type="number" id="qty" class="form-control" placeholder="Jumlah" name="qty"
                            required autocomplete="off" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

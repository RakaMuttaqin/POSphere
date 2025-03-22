<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('jenis-member.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="mb-1">
                        <label class="form-label" for="nama">Jenis Member</label>

                        <input type="text" id="nama" class="form-control" placeholder="Jenis Member"
                            aria-label="Jenis Member" aria-describedby="nama" name="nama" required
                            autocomplete="off" />
                    </div>

                    {{-- <div class="mb-1">
                        <label class="form-label" for="nama">Min. Pembelian</label>

                        <input type="number" id="min_pembelian" class="form-control" placeholder="Min. Pembelian"
                            aria-label="Min. Pembelian" aria-describedby="min_pembelian" name="min_pembelian" required
                            autocomplete="off" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="diskon">Diskon</label>

                        <div class="input-group">
                            <input type="number" id="diskon" class="form-control" placeholder="Diskon"
                                aria-label="Diskon" aria-describedby="diskon" name="diskon" required
                                autocomplete="off" />
                            <span class="input-group-text">%</span>
                        </div>
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

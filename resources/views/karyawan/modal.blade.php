<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('karyawan.store') }}" method="POST">
                    @csrf
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="row g-1">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="nama_depan">Nama Depan</label>
                            <input type="text" id="nama_depan" class="form-control" placeholder="Nama Depan"
                                name="nama_depan" required autocomplete="off" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="nama_belakang">Nama Belakang</label>
                            <input type="text" id="nama_belakang" class="form-control" placeholder="Nama Belakang"
                                name="nama_belakang" required autocomplete="off" />
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Email" name="email"
                            required autocomplete="off" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="no_hp">No HP</label>
                        <input type="tel" id="no_hp" class="form-control" placeholder="No HP" name="no_hp"
                            required autocomplete="off" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" class="form-control" placeholder="Alamat" name="alamat" required autocomplete="off"></textarea>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" required
                            autocomplete="off" />
                    </div>

                    <button type="submit" class="btn btn-primary col-md-12">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

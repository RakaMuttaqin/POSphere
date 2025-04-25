<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('absensi-kerja.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="mb-1">
                        <label class="form-label" for="karyawan_id">Nama Keryawan</label>

                        <select class="select2 form-select" id="karyawan_id" name="karyawan_id" required>
                            <option value="" disabled selected>Pilih Nama Karyawan</option>
                            @foreach ($karyawan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_depan }} {{ $item->nama_belakang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="tanggal_masuk">Tanggal Masuk</label>

                        <input type="date" id="tanggal_masuk" class="form-control" placeholder="Tanggal Masuk"
                            aria-label="Tanggal Masuk" aria-describedby="tanggal_masuk" name="tanggal_masuk" required
                            autocomplete="off" />
                    </div>

                    {{-- <div class="mb-1">
                        <label class="form-label" for="waktu_masuk">Waktu Masuk</label>

                        <input type="time" id="waktu_masuk" class="form-control" placeholder="Jam Masuk"
                            aria-label="Jam Masuk" aria-describedby="waktu_masuk" name="waktu_masuk" required
                            autocomplete="off" />
                    </div> --}}

                    <div class="mb-1">
                        <label for="status" class="form-label">Status</label>

                        <select class="form-select form-control" id="status" name="status" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="masuk">Masuk</option>
                            <option value="sakit">Sakit</option>
                            <option value="cuti">Cuti</option>
                        </select>
                    </div>

                    {{-- <div class="mb-1">
                        <label class="form-label" for="waktu_selesai_kerja">Waktu Selesai Kerja</label>

                        <input type="time" id="waktu_selesai_kerja" class="form-control"
                            placeholder="Waktu Selesai Kerja" aria-label="Waktu Selesai Kerja"
                            aria-describedby="waktu_selesai_kerja" name="waktu_selesai_kerja" required
                            autocomplete="off" />
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImportLabel">Import Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('absensi-kerja.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-1">
                        <label class="form-label" for="file">File Excel</label>

                        <input type="file" id="file" class="form-control" name="file" required
                            accept=".xlsx" />
                    </div>

                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>

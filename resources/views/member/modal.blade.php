<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('member.store') }}" method="POST">
                    @csrf
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="mb-1">
                        <label class="form-label" for="nama">Nama Member</label>
                        <input type="text" id="nama" class="form-control" placeholder="Nama Member"
                            name="nama" required autocomplete="off" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="jenis_member">Jenis Member</label>
                        <select id="jenis_member" class="form-control" name="jenis_member" required>
                            <option value="" disabled selected>Pilih Jenis Member</option>
                            @foreach ($jenisMember as $items)
                                <option value="{{ $items->kode }}">{{ $items->nama }}</option>
                            @endforeach
                        </select>
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

                    <button type="submit" class="btn btn-primary col-md-12">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

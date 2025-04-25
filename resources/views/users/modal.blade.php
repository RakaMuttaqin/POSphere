<!-- Modal -->
<div class="modal fade text-start" id="modalForm" tabindex="-1" aria-labelledby="modalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <input id="formMethod" type="hidden" name="_method" value="POST">

                    <div class="mb-1">
                        <label class="form-label" for="name">Nama</label>
                        <input type="text" id="name" class="form-control" placeholder="Nama" name="name"
                            required autocomplete="off" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Email" name="email"
                            required autocomplete="off" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="role">Role</label>
                        <select id="role" class="form-select" name="role" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Owner">Owner</option>
                            <option value="Kasir">Kasir</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" id="password" class="form-control" placeholder="Password"
                                name="password" required autocomplete="off" />
                            <span class="input-group-text cursor-pointer" id="toggle-password"><i
                                    data-feather="eye"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary col-md-12">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

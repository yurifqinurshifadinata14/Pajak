<!-- Modal Tambah -->
<div x-data="formTambah" class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel"><b>Tambah Data Admin</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dataadminStore') }}" method="POST" onsubmit="handleSubmit(event)">
                @csrf <!-- Laravel CSRF Protection -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="examplenama" placeholder="Name"
                            name="name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                            placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                placeholder="Password" name="password" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                placeholder="Repeat Password" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="role" id="exampleInputRole" class="form-select" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-navy">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

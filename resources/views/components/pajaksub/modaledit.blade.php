@props(['p'])

<div class="modal fade" id="edit{{ $p->id_pajak }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    x-data="formEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel"><b>Edit Data Pajak</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pajakUpdate', $p->id_pajak) }}" method="post">
                    @csrf
                    @method('PUT')
                    <!--input data-->
                    <div class="form-group">
                        <label for="nama">Nama WP</label>
                        <input type="text" class="form-control" id="nama_wp" name="nama_wp"
                            value="{{ $p->nama_wp }}" placeholder="Nama WP">
                    </div>
                    <label for="jenis">Jenis WP</label>
                    <select name="jenis" id="editjenis" class="form-select" value="{{ $p->jenis }}"
                        onchange="showEditInput(this)">
                        <option disabled>--Select--</option>
                        <option value="Badan">Badan</option>
                        <option value="Pribadi">Pribadi</option>
                    </select>
                    <div id="editjenisBadan" style="display:none;">
                        <h6>-- Bagian Badan --</h6>
                        <div class="form-group">
                            <label for="alamatBadan">Alamat</label>
                            <input type="text" class="form-control" id="alamatBadan" name="alamatBadan"
                                value="{{ $p->alamatBadan }}"placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                value="{{ $p->jabatan }}" placeholder="Jabatan">
                        </div>
                        <div class="form-group">
                            <label for="npwpBadan">NPWP</label>
                            <input type="number" class="form-control" id="npwpBadan" name="npwpBadan"
                                value="{{ $p->npwpBadan }}" placeholder="NPWP">
                        </div>
                        <div class="form-group">
                            <label for="saham">Saham</label>
                            <input type="text" class="form-control" id="saham" name="saham"
                                value="{{ $p->saham }}" placeholder="Saham">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status WP</label>
                        <select name="status" id="editstatus" class="form-select" value="{{ $p->status }}"
                            onchange="showEditInput(this)">
                            <option disabled>--Select--</option>
                            <option value="PKP" id="editPKP">PKP</option>
                            <option value="Non PKP">Non PKP</option>
                        </select>
                    </div>
                    <div id="editstatusPkp" style="display:none;">
                        <h6>-- Bagian PKP --</h6>
                        <div class="form-group">
                            <label for="enofa_password">Enofa Password</label>
                            <input type="password" class="form-control" id="enofa_password" name="enofa_password"
                                value="{{ $p->enofa_password }}" placeholder="Enofa password">
                        </div>
                        <div class="form-group">
                            <label for="passphrese">Passphrese</label>
                            <input type="text" class="form-control" id="passphrese" name="passphrese"
                                value="{{ $p->passphrese }}"placeholder="Passphrese">
                        </div>
                        <div class="form-group">
                            <label for="user_efaktur">User Efaktur</label>
                            <input type="text" class="form-control" id="user_efaktur" name="user_efaktur"
                                value="{{ $p->user_efaktur }}" placeholder="User efaktur">
                        </div>
                        <div class="form-group">
                            <label for="password_efaktur">Password Efaktur</label>
                            <input type="password" class="form-control" id="password_efaktur"
                                name="password_efaktur" value="{{ $p->password_efaktur }}"
                                placeholder="Password efaktur">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp"
                            value="{{ $p->npwp }}" placeholder="NPWP">
                    </div>
                    <div class="mb-3 row">
                        <label for="no_hp">No Hp</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                            value="{{ $p->no_hp }}" placeholder="No Hp">
                    </div>
                    <div class="mb-3 row">
                        <label for="no_efin">No EFIN</label>
                        <input type="text" class="form-control" id="no_efin" name="no_efin"
                            value="{{ $p->no_efin }}" placeholder="No EFIN">
                    </div>
                    <div class="mb-3 row">
                        <label for="gmail">Gmail</label>
                        <input type="email" class="form-control" id="gmail" name="gmail"
                            value="{{ $p->gmail }}" placeholder="Gmail">
                    </div>
                    <div class="mb-3 row">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            value="{{ $p->password }}" placeholder="Password">
                    </div>
                    <div class="mb-3 row">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            value="{{ $p->nik }}" placeholder="NIK">
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            value="{{ $p->alamat }}" placeholder="Alamat">
                    </div>
                    <div class="mb-3 row">
                        <label for="merk_dagang">Merk Dagang</label>
                        <input type="text" class="form-control" id="merk_dagang" name="merk_dagang"
                            value="{{ $p->merk_dagang }}" placeholder="Merk Dagang">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        console.log('ini modal edit')
    </script>
@endpush

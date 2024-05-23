<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true" x-data="formTambah">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahModalLabel"><b>Tambah Data Pajak</b></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <!-- <form action="{{ route('pajakStore') }}" method="post"> -->
        <form @submit.prevent="handleSubmit">
            <div class="modal-body">
                @csrf
                <!-- Input Data -->
                <div class="form-group">
                    <label for="nama">Nama WP</label>
                    <input type="text" class="form-control" id="nama_wp" name="nama_wp"
                        placeholder="Nama WP" x-model="formData.nama_wp" required>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis WP</label>
                    <select name="jenis" id="jenis" class="form-select"
                        onchange="showInput(this)"  x-model="formData.jenis">
                        <option selected>--Select--</option>
                        <option value="Badan" @click="showJenis=!showJenis">Badan</option>
                        <option value="Pribadi">Pribadi</option>
                    </select>
                </div>
                <div id="jenisBadan" x-show="showJenis">
                    <h6>-- Bagian Badan --</h6>
                    <div class="form-group">
                        <label for="alamatBadan">Alamat</label>
                        <input type="text" class="form-control" id="alamatBadan"
                            name="alamatBadan" placeholder="Alamat"  x-model="formData.alamatBadan">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan"
                            name="jabatanBadan" placeholder="Jabatan"  x-model="formData.jabatan">
                    </div>
                    <div class="form-group">
                        <label for="npwpBadan">NPWP</label>
                        <input type="number" class="form-control" id="npwpBadan" name="npwpBadan"
                            placeholder="NPWP" x-model="formData.npwpBadan">
                    </div>
                    <div class="form-group">
                        <label for="saham">Saham</label>
                        <input type="text" class="form-control" id="saham" name="saham"
                            placeholder="Saham" x-model="formData.saham">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status WP</label>
                    <select name="status" id="status" class="form-select"
                        onchange="showInput(this)" x-model="formData.status">
                        <option selected>--Select--</option>
                        <option value="PKP" @click="showStatus=!showStatus">PKP</option>
                        <option value="Non PKP">Non PKP</option>
                    </select>
                </div>
                <div id="statusPkp" x-show="showStatus">
                    <h6>-- Bagian PKP --</h6>
                    <div class="form-group">
                        <label for="enofa_password">Enofa Password</label>
                        <input type="password" class="form-control" id="enofa_password"
                            name="enofa_password" placeholder="Enofa password" x-model="formData.enofa_password">
                    </div>
                    <div class="form-group">
                        <label for="passphrese">Passphrese</label>
                        <input type="text" class="form-control" id="passphrese" name="passphrese"
                            placeholder="Passphrese" x-model="formData.passphrese">
                    </div>
                    <div class="form-group">
                        <label for="user_efaktur">User Efaktur</label>
                        <input type="text" class="form-control" id="user_efaktur"
                            name="user_efaktur" placeholder="User efaktur" x-model="formData.user_efaktur">
                    </div>
                    <div class="form-group">
                        <label for="password_efaktur">Password Efaktur</label>
                        <input type="password" class="form-control" id="password_efaktur"
                            name="password_efaktur" placeholder="Password efaktur" x-model="formData.password_efaktur">
                    </div>
                </div>
                <div class="form-group">
                    <label for="npwp">NPWP</label>
                    <input type="number" class="form-control" id="npwp" name="npwp"
                        placeholder="NPWP" x-model="formData.npwp"required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No Hp</label>
                    <input type="number" class="form-control" id="no_hp" name="no_hp"
                        placeholder="No Hp" x-model="formData.no_hp"required>
                </div>
                <div class="form-group">
                    <label for="no_efin">No EFIN</label>
                    <input type="number" class="form-control" id="no_efin" name="no_efin"
                        placeholder="No EFIN" x-model="formData.no_efin"required>
                </div>
                <div class="form-group">
                    <label for="gmail">Gmail</label>
                    <input type="email" class="form-control" id="gmail" name="gmail"
                        placeholder="Gmail" x-model="formData.gmail"required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Password" x-model="formData.password"required>
                </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control" id="nik" name="nik"
                        placeholder="NIK" x-model="formData.nik"required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        placeholder="Alamat" x-model="formData.alamat"required>
                </div>
                <div class="form-group">
                    <label for="merk_dagang">Merk Dagang</label>
                    <input type="text" class="form-control" id="merk_dagang"
                        name="merk_dagang" placeholder="Merk Dagang" x-model="formData.merk_dagang"required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    x-data="formEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel"><b>Edit Data Pajak</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form {{-- action="{{ route('pajakUpdate', $p->id_pajak) }}" method="post" --}} @submit.prevent="editSubmit">
                    @csrf
                    @method('PUT')
                    <!--input data-->
                    <div class="form-group">
                        <label for="nama">Nama WP</label>
                        <input type="text" class="form-control" id="nama_wp" name="nama_wp" :value="data.nama_wp"
                            placeholder="Nama WP" x-model="data.nama_wp">
                    </div>


                    <div class="form-group">
                        <label for="jenis">Jenis WP</label>
                        <select name="jenis" id="editjenis" class="form-select" :value="data.jenis"
                            onchange="showEditInput(this)" x-model="data.jenis">
                            <option disabled>--Select--</option>
                            <option value="Badan">Badan</option>
                            <option value="Pribadi">Pribadi</option>
                        </select>
                    </div>
                    <div id="editjenisBadan" style="display:none;">
                        <h6>-- Bagian Badan --</h6>
                        <div class="form-group">
                            <label for="alamatBadan">Alamat</label>
                            <input type="text" class="form-control" id="alamatBadan" name="alamatBadan"
                                :value="data.alamatBadan" placeholder="Alamat" x-model="data.alamatBadan">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                :value="data.jabatan" placeholder="Jabatan" x-model="data.jabatan">
                        </div>
                        <div class="form-group">
                            <label for="npwpBadan">NPWP</label>
                            <input type="number" class="form-control" id="npwpBadan" name="npwpBadan"
                                :value="data.npwpBadan" placeholder="NPWP" x-model="data.npwpBadan">
                        </div>
                        <div class="form-group">
                            <label for="saham">Saham</label>
                            <input type="text" class="form-control" id="saham" name="saham"
                                :value="data.saham" placeholder="Saham" x-model="data.saham">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status WP</label>
                        <select name="status" id="editstatus" class="form-select" :value="data.status"
                            onchange="showEditInput(this)" x-model="data.status">
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
                                :value="data.enofa_password" placeholder="Enofa password" x-model="data.enofa_password">
                        </div>
                        <div class="form-group">
                            <label for="passphrese">Passphrese</label>
                            <input type="text" class="form-control" id="passphrese" name="passphrese"
                                :value="data.passphrese" placeholder="Passphrese" x-model="data.passphrese">
                        </div>
                        <div class="form-group">
                            <label for="user_efaktur">User Efaktur</label>
                            <input type="text" class="form-control" id="user_efaktur" name="user_efaktur"
                                :value="data.user_efaktur" placeholder="User efaktur" x-model="data.user_efaktur">
                        </div>
                        <div class="form-group">
                            <label for="password_efaktur">Password Efaktur</label>
                            <input type="password" class="form-control" id="password_efaktur"
                                name="password_efaktur" :value="data.password_efaktur" placeholder="Password efaktur"
                                x-model="data.password_efaktur">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp"
                            :value="data.npwp" placeholder="NPWP" x-model="data.npwp">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Hp</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                            :value="data.no_hp" placeholder="No Hp" x-model="data.no_hp">
                    </div>
                    <div class="form-group">
                        <label for="no_efin">No EFIN</label>
                        <input type="text" class="form-control" id="no_efin" name="no_efin"
                            :value="data.no_efin" placeholder="No EFIN" x-model="data.no_efin">
                    </div>
                    <div class="form-group">
                        <label for="gmail">Gmail</label>
                        <input type="email" class="form-control" id="gmail" name="gmail"
                            :value="data.gmail" placeholder="Gmail" x-model="data.gmail">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            :value="data.password" placeholder="Password" x-model="data.password">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            :value="data.nik" placeholder="NIK" x-model="data.nik">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            :value="data.alamat" placeholder="Alamat" x-model="data.alamat">
                    </div>
                    <div class="form-group">
                        <label for="merk_dagang">Merk Dagang</label>
                        <input type="text" class="form-control" id="merk_dagang" name="merk_dagang"
                            :value="data.merk_dagang" placeholder="Merk Dagang" x-model="data.merk_dagang">
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

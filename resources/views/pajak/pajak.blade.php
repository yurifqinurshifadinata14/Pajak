@extends ('main')
@section('konten')
    <main>

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Formulir</h1>
            <p class="mb-4">Isi formulir di bawah ini :</p>

            <!-- Formulir Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold font-color">Formulir Data Diri</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pajakStore') }}" method="post">
                        @csrf <!-- Laravel CSRF Protection -->
                        <div class="form-group">
                            <label for="nama">Nama WP</label>
                            <input type="text" class="form-control" id="nama_wp" name="nama_wp" placeholder="Nama WP">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis WP</label>
                            <select name="jenis" id="jenis" class="form-select" onchange="showInput(this)">
                                <option selected disabled>--Select--</option>
                                <option value="badan">Badan</option>
                                <option value="pribadi">Pribadi</option>
                            </select>
                        </div>
                        <div id="jenisBadan" style="display:none;">
                            <h6>Bagian Badan</h6>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamatBadan"
                                placeholder="alamat">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatanBadan"
                                    placeholder="jabatan">
                            </div>
                            <div class="form-group">
                                <label for="npwp">NPWP</label>
                                <input type="number" class="form-control" id="npwp" name="npwpBadan"
                                    placeholder="npwp">
                            </div>
                            <div class="form-group">
                                <label for="saham">Saham</label>
                                <input type="text" class="form-control" id="saham" name="sahamBadan"
                                    placeholder="saham">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status WP</label>
                            <select name="status" id="" class="form-select" onchange="showInput(this)">
                                <option selected disabled>--Select--</option>
                                <option value="pkp">PKP</option>
                                <option value="non_pkp">Non_PKP</option>
                            </select>
                        </div>
                        <div id="statusPkp" style="display:none;">
                            <h6>Bagian PKP</h6>
                            <div class="form-group">
                                <label for="enofa_password">Enofa Password</label>
                                <input type="password" class="form-control" id="enofa_password" name="enofa_password"
                                placeholder="enofa password">
                            </div>
                            <div class="form-group">
                                <label for="passphrese">Passphrese</label>
                                <input type="text" class="form-control" id="passphrese" name="passphrese"
                                placeholder="passphrese">
                            </div>
                        </div>
                        <div id="statusNonPkp" style="display:none;">
                            <h6>Bagian Non PKP</h6>
                            <div class="form-group">
                                <label for="user_efaktur">User Efaktur</label>
                                <input type="text" class="form-control" id="user_efaktur" name="user_efaktur"
                                    placeholder="user efaktur">
                            </div>
                            <div class="form-group">
                                <label for="password_efaktur">Password Efaktur</label>
                                <input type="password" class="form-control" id="password_efaktur" name="password_efaktur"
                                    placeholder="password efaktur">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP</label>
                            <input type="number" class="form-control" id="npwp" name="npwp" placeholder="NPWP">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp"
                                placeholder="No Hp">
                        </div>
                        <div class="form-group">
                            <label for="no_efin">No EFIN</label>
                            <input type="number" class="form-control" id="no_efin" name="no_efin"
                                placeholder="No EFIN">
                        </div>
                        <div class="form-group">
                            <label for="gmail">Gmail</label>
                            <input type="email" class="form-control" id="gmail" name="gmail"
                                placeholder="Gmail">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="merk_dagang">Merk Dagang</label>
                            <input type="text" class="form-control" id="merk_dagang" name="merk_dagang"
                                placeholder="Merk Dagang">
                        </div>
                        <button type="submit" class="btn btn-navy">Submit</button>
                    </form>
                </div>
            </div>

        </div>

    </main>


    <script>
        function showInput(selectObject) {
            var value = selectObject.value;
            if (value == 'badan') {
                document.getElementById('jenisBadan').style.display = 'block';
            } else {
                document.getElementById('jenisBadan').style.display = 'none';
            }
            if (value == 'pkp') {
                document.getElementById('statusPkp').style.display = 'block';
            } else {
                document.getElementById('statusPkp').style.display = 'none';
            }
            if (value == 'non_pkp') {
                document.getElementById('statusNonPkp').style.display = 'block';
            } else {
                document.getElementById('statusNonPkp').style.display = 'none';
            }
        }
    </script>
@endsection

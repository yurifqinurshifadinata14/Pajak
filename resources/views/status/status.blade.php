@extends ('main')
@section('konten')
    <main>
        <!-- <div class="container-fluid px-4">
            <h1 class="mt-4">Status Wajib Pajak</h1>
            <br>
            <div class="card mb-4 mt-2">
                        <div class="card-header">
                            Status Wajib Pajak
                        </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="floatingInput" class="col-sm-2 col-form-label">Status</label>
                            <blockquote class="blockquote mb-0">
                                <select class="form-select" aria-label="Default select example">
                                    <option value="">--pilih salah satu--</option>
                                    <option value="1">PKP </option>
                                    <option value="2">Non PKP</option>
                                </select>
                            </blockquote>
                    </div>
                    <div class="row mt-3">
                        <label for="enofa_password" class="col-sm-2 col-form-label">ENOFA Password</label>
                            <input type="text" class="form-control" id="enofa_password" placeholder="Masukkan enofa password" name="enofa_pas">
                    </div>
                    <div class="row mt-3">
                        <label for="passphrese" class="col-sm-2 col-form-label">PassPhrese</label>
                            <input type="text" class="form-control" id="passphrese" placeholder="Masukkan passphrese" name="passphrese">
                    </div>
                    <div class="row mt-3">
                        <label for="user_efaktur" class="col-sm-2 col-form-label">User Efaktur</label>
                            <input type="text" class="form-control" id="user_efaktur" placeholder="Masukkan user efaktur" name="user_efaktur">
                    </div>
                    <div class="row mt-3">
                        <label for="pass_efaktur" class="col-sm-2 col-form-label">Password Efaktur</label>
                            <input type="text" class="form-control" id="pass_efaktur" placeholder="Masukkan password efaktur" name="pass_efaktur">
                    </div>
                    <div class="row mt-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" >Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="container-fluid px-4">
            <h1 class="mt-4">Status Wajib Pajak</h1>
            <br>
            <div class="card mb-4 mt-2">
                        <div class="card-header">
                            Formulir Wajib Pajak
                        </div>
                <div class="card-body">
                    <form action="{{ route('statusStore') }}" method="POST">
                        @csrf
                        <label for="status">Pilih Status:</label>
                        <select id="status" name="status">
                            <option value="">--Pilih Salah Satu--</option>
                            <option value="pkp">PKP</option>
                            <option value="nonpkp">Non-PKP</option>
                        </select>

                        <div id="pkpInputs" style="display:none;">
                            <label for="enofaPassword">ENoFA Password:</label>
                            <input type="password" class="form-control" id="enofaPassword" name="enofaPassword"><br>

                            <label for="passphrasePassword">Passphrase E-Faktur:</label>
                            <input type="text" class="form-control" id="passphrasePassword" name="passphrasePassword"><br>

                            <label for="userEfaktur">User E-Faktur:</label>
                            <input type="text" class="form-control" id="userEfaktur" name="userEfaktur"><br>

                            <label for="passwordEfaktur">Password E-Faktur:</label>
                            <input type="text" class="form-control" id="passwordEfaktur" name="passwordEfaktur"><br>

                            
                        </div>

                        <script>
                            document.getElementById('status').addEventListener('change', function() {
                                var value = this.value;
                                var pkpInputs = document.getElementById('pkpInputs');
                                
                                if (value === 'pkp') {
                                    pkpInputs.style.display = 'block';
                                } else {
                                    pkpInputs.style.display = 'none';
                                }
                            });
                        </script>
                        <div class="row mt-3">
                            <label for="inputEmail3" class="col-sm-0 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" href="/statussub" class="btn btn-primary" >Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

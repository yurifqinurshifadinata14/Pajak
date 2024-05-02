@extends ('main')
@section('konten')
    <main>

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Formulir</h1>
            <p class="mb-4">Isi Formulir di bawah ini: <a target="_blank"
                    href="https://datatables.net"></a>.
            </p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Form Data Status Pajak</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('statusUpdate', $status->id) }}" method="POST">
                        @csrf <!-- Laravel CSRF Protection -->
                        @method('PUT')
                        <label for="status">status</label>
                        <select class="form-select" id="status" name="status" value="{{ $status->status }}">
                            <option selected disabled>--- Select Status ---</option>
                            <option value="badan" @if ($status->badan == 'badan') @endif>Badan</option>
                            <option value="pribadi" @if ($status->pribadi == 'pribadi') @endif>Pribadi</option>
                        </select>

                        <div id="Status" style="display:none;" class="mt-3">
                            <div class="form-group">
                                <label for="ENoFA Password">ENoFA Password</label>
                                <input type="text" class="form-control" id="ENoFA Password" name="ENoFA Password" value="{{ $status->ENoFA_Password }}" placeholder="Masukkan ENoFA Password">
                            </div>
                            <div class="form-group">
                                <label for="passphrasePassword">passphrasePassword</label>
                                <input type="text" class="form-control" id="passphrasePassword" name="passphrasePassword" value="{{ $status->passphrase_Password }}" placeholder="Masukkan passphrasePassword">
                            </div>
                            <div class="form-group">
                                <label for="userEfaktur">userEfaktur</label>
                                <input type="number" class="form-control" id="userEfaktur" name="userEfaktur" value="{{ $status->user_Efaktur }}" placeholder="Masukkan userEfaktur">
                            </div>
                            <div class="form-group">
                                <label for="passwordEfaktur">passwordEfaktur</label>
                                <input type="text" class="form-control" id="passwordEfaktur" name="passwordEfaktur" value="{{ $status->password_Efaktur }}" placeholder="Masukkan passwordEfaktur">
                            </div>
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
                        {{-- <button style="height:10px;width:150px" type="submit" class="btn btn-sm btn-navy mt-3">Simpan</button> --}}
                        <button type="submit" class="btn btn-navy">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection


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
                    <h6 class="m-0 font-weight-bold text-dark">Form Data Jenis Pajak</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenisStore') }}" method="POST">
                        @csrf
                        <label for="jenis">Jenis</label>
                        <select class="form-select" id="jenis" name="jenis">
                            <option selected disabled>--- Select Jenis ---</option>
                            <option value="badan">Badan</option>
                            <option value="pribadi">Pribadi</option>
                        </select>

                        <div id="badanInputs" style="display:none;" class="mt-2">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan">
                            </div>
                            <div class="form-group">
                                <label for="npwp">NPWP</label>
                                <input type="number" class="form-control" id="npwp" name="npwp" placeholder="Masukkan NPWP">
                            </div>
                            <div class="form-group">
                                <label for="saham">Saham</label>
                                <input type="text" class="form-control" id="saham" name="saham" placeholder="Masukkan Saham">
                            </div>
                        </div>

                        <script>
                            document.getElementById('jenis').addEventListener('change', function() {
                                var value = this.value;
                                var badanInputs = document.getElementById('badanInputs');

                                if (value === 'badan') {
                                    badanInputs.style.display = 'block';
                                } else {
                                    badanInputs.style.display = 'none';
                                }
                                // if (value === 'badan') {
                                //     document.getElementById('badanInputs').style.display = 'block';
                                // }else {
                                //     document.getElementById('badanInputs').style.display = 'none';
                                // }
                            });
                        </script>
                        <button style="height:10px;width:150px" type="submit" class="btn btn-sm btn-navy mt-3">Simpan</button>
                        </div>
                    </form>
            </div>
        </div>
    </main>
@endsection


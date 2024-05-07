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
                    <h6 class="m-0 font-weight-bold text-dark">Form Data Karyawan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('karyawanStore') }}" method="POST">
                        @csrf
                        <label for="karyawan">Karyawan</label>
                        <select class="form-select" id="karyawan" name="karyawan">
                            <option selected disabled>--- Karyawan ---</option>
                            <option value="karyawan">Karyawan</option>
                        </select>

                        <div id="karyawanInputs" style="display:none;" class="mt-2">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK">
                            </div>
                            <div class="form-group">
                                <label for="npwp_karyawan">NPWP</label>
                                <input type="text" class="form-control" id="npwp_karyawan" name="npwp_karyawan" placeholder="Masukkan NPWP">
                            </div>
                        </div>

                        <script>
                            document.getElementById('karyawan').addEventListener('change', function() {
                                var value = this.value;
                                var karyawanInputs = document.getElementById('karyawanInputs');

                                if (value === 'karyawan') {
                                    karyawanInputs.style.display = 'block';
                                } else {
                                    karyawanInputs.style.display = 'none';
                                }
                                // if (value === 'karyawan') {
                                //     document.getElementById('karyawanInputs').style.display = 'block';
                                // }else {
                                //     document.getElementById('karyawanInputs').style.display = 'none';
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


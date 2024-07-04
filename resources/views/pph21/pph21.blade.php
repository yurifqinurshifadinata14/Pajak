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
                    <h6 class="m-0 font-weight-bold font-color">Pph21</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pph21Store') }}" method="post">
                        @csrf <!-- Laravel CSRF Protection -->
                        <div class="form-group">
                            <label for="nama">Jumlah Bayar</label>
                            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar"
                                placeholder="jumlah bayar">
                        </div>
                        <div class="form-group">
                            <label for="nama">BPE</label>
                            <input type="text" class="form-control" id="bpe" name="bpe" placeholder="BPE">
                        </div>
                        <div class="form-group">
                            <label for="nama">Biaya Bulan</label>
                            <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan"
                                placeholder="Biaya Bulan">
                        </div>
                        {{-- <div class="form-group">
                            <label for="nama">Daftar Karyawan</label>
                            <input type="text" class="form-control" id="daftar_karyawan" name="daftar_karyawan" placeholder="Daftar Karyawan">
                        </div> --}}
                        <div class="form-group">
                            <label for="karyawan">Karyawan</label>
                            <select name="karyawan" id="karyawan" class="form-select" onchange="showKaryawanInput(this)">
                                <option selected disabled>--Select--</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
                        </div>
                        <div id="Karyawan" style="display:none;">
                            <h6>-- Karyawan --</h6>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nikKaryawan"
                                    placeholder="NIK"><br>
                            </div>
                            <div class="form-group">
                                <label for="npwp">NPWP</label>
                                <input type="number" class="form-control" id="npwp" name="npwpKaryawan"
                                    placeholder="NPWP"><br>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-navy">Submit</button>
                    </form>
                </div>
            </div>

        </div>

    </main>


    <script>
        function showKaryawanInput(selectObject) {
            var value = selectObject.value;
            if (value == 'Karyawan') {
                document.getElementById('Karyawan').style.display = 'block';
            } else {
                document.getElementById('Karyawan').style.display = 'none';
            }
        }
    </script>
@endsection

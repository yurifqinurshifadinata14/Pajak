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
                    <form action="{{ route('jenisUpdate', $jenis->id) }}" method="POST">
                        @csrf <!-- Laravel CSRF Protection -->
                        @method('PUT')
                        <label for="jenis">Jenis</label>
                        <select class="form-select" id="jenis" name="jenis" value="{{ $jenis->jenis }}">
                            <option selected disabled>--- Select Jenis ---</option>
                            <option value="badan" @if ($jenis->badan == 'badan') @endif>Badan</option>
                            <option value="pribadi" @if ($jenis->pribadi == 'pribadi') @endif>Pribadi</option>
                        </select>

                        <div id="jenisBadan" style="display:none;" class="mt-3">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $jenis->alamat }}" placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $jenis->jabatan }}" placeholder="Masukkan Jabatan">
                            </div>
                            <div class="form-group">
                                <label for="npwp">NPWP</label>
                                <input type="number" class="form-control" id="npwp" name="npwp" value="{{ $jenis->npwp }}" placeholder="Masukkan NPWP">
                            </div>
                            <div class="form-group">
                                <label for="saham">Saham</label>
                                <input type="text" class="form-control" id="saham" name="saham" value="{{ $jenis->saham }}" placeholder="Masukkan Saham">
                            </div>
                        </div>

                        <script>
                            document.getElementById('jenis').addEventListener('change', function() {
                                var value = this.value;
                                var badanInputs = document.getElementById('jenisBadan');

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
                        {{-- <button style="height:10px;width:150px" type="submit" class="btn btn-sm btn-navy mt-3">Simpan</button> --}}
                        <button type="submit" class="btn btn-navy">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection


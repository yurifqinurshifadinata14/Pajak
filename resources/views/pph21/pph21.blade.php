@extends ('main')
@section('konten')
    <main>
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Formulir</h1>
            <p class="mb-4">Isi formulir di bawah ini :</p>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold font-color">PPH 21</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pph21Store') }}" method="post">
                        @csrf 
                        <div class="form-group">
                            <label for="nama">Jumlah Bayar</label>
                            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="jumlah bayar">
                        </div>
                        <div class="form-group">
                            <label for="nama">BPF</label>
                            <input type="text" class="form-control" id="bpf" name="bpf" placeholder="BPF">
                        </div>
                        <div class="form-group">
                            <label for="nama">Biaya Bulan</label>
                            <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan" placeholder="Biaya Bulan">
                        </div>
                        <div class="form-group">
                            <label for="nama">Daftar Karyawan</label>
                            <input type="text" class="form-control" id="daftar_karyawan" name="daftar_karyawan" placeholder="Daftar Karyawan">
                        </div>
                        <button type="submit" class="btn btn-navy">Submit</button>
                    </form>
                 </div>
            </div>
        </div>
    </main>
@endsection 
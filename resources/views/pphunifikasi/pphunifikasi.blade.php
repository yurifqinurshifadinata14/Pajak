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
                    <h6 class="m-0 font-weight-bold text-dark">Form Data Pph Unifikasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pphunifikasiStore') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="ntpn">NTPN</label>
                            <input type="text" class="form-control" id="ntpn" name="ntpn" placeholder="NTPN">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_bayar">Jumlah Bayar</label>
                            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Jumlah Bayar">
                        </div>
                        <div class="form-group">
                            <label for="biaya_bulan">Biaya Bulan</label>
                            <input type="number" class="form-control" id="biaya_bulan" name="biaya_bulan" placeholder="Biaya Bulan">
                        </div>
                        <div class="form-group">
                            <label for="bpe">BPE</label>
                            <input type="text" class="form-control" id="bpe" name="bpe" placeholder="BPE">
                        </div>

                        <button type="submit" class="btn btn-navy">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection


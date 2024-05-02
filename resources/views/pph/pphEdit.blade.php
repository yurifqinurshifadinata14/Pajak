@extends ('main')
@section('konten')
    <main>

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Formulir PPH</h1>
            <p class="mb-4">Isi formulir PPH di bawah ini :</p>

            <!-- Formulir Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir PPH</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pphUpdate', $pph->id) }}" method="POST">
                        @csrf <!-- Laravel CSRF Protection -->
                        @method('PUT')
                        <div class="form-group">
                            <label for="ntpn">NTPN</label>
                            <input type="number" class="form-control" id="ntpn" name="ntpn" value="{{ $pph->ntpn }}" placeholder="NTPN">
                        </div>
                        <div class="form-group">
                            <label for="biaya_bulan">Biaya Bulan</label>
                            <input type="number" class="form-control" id="biaya_bulan" name="biaya_bulan" value="{{ $pph->biaya_bulan }}" placeholder="Biaya Bulan">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_bayar">Jumlah Bayar</label>
                            <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="{{ $pph->jumlah_bayar }}" placeholder="Jumlah Bayar">
                        </div>

                        <button type="submit" href="/pphsub" class="btn btn-navy">Submit</button>
                    </form>
                </div>
            </div>

        </div>

    </main>
@endsection
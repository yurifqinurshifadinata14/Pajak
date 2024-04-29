@extends('main')
@section('konten')
<main>

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Formulir</h1>
        <p class="mb-4">Isi formulir di bawah ini :</p>

        <!-- Formulir Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold font-color">Formulir Data Diri Pembayar</h6>
            </div>
            <div class="card-body">
                <form action="{{url('pajakSub/pajaked' . $pajak->id . '/update')}}" method="post">
                    @csrf <!-- Laravel CSRF Protection -->
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama WP</label>
                        <input type="text" class="form-control" id="nama_wp" name="nama_wp" value="{{ $pajak->nama_wp }}" placeholder="Nama WP">
                    </div>
                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="number" class="form-control" id="npwp" name="npwp" value="{{ $pajak->npwp }}" placeholder="NPWP">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Hp</label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ $pajak->no_hp }}" placeholder="No Hp">
                    </div>
                    <div class="form-group">        
                        <label for="no_efin">No EFIN</label>
                        <input type="number" class="form-control" id="no_efin" name="no_efin" value="{{ $pajak->no_efin }}" placeholder="No EFIN">
                    </div>
                    <div class="form-group">
                        <label for="gmail">Gmail</label>
                        <input type="email" class="form-control" id="gmail" name="gmail" value="{{ $pajak->gmail }}" placeholder="Gmail">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ $pajak->password }}" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik" value="{{ $pajak->nik }}" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pajak->alamat }}" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="merk_dagang">Merk Dagang</label>    
                        <input type="text" class="form-control" id="merk_dagang" name="merk_dagang" value="{{ $pajak->merk_dagang }}" placeholder="Merk Dagang">
                    </div>
                    <button type="submit" href="/pajaksub" class="btn btn-navy">Submit</button>
                </form>
            </div>
        </div>

</main>
@endsection
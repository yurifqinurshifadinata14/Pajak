@extends('main')
@section('konten')
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4">Detail Status Dan Jenis</h3>
            <div class="card">
                <div class="card-body">
                    <h5>Jenis Pajak</h5>
                    <p>{{ $pajak->jenis }}</p>
                    @if ($pajak->jenis == 'Badan')
                        <h5>Jabatan</h5>
                        <p>{{ $pajak->jabatan }}</p>
                        <h5>Alamat Badan</h5>
                        <p>{{ $pajak->alamatBadan }}</p>
                        <h5>NPWP Badan</h5>
                        <p>{{ $pajak->npwpBadan }}</p>
                        <h5>Saham</h5>
                        <p>{{ $pajak->saham }}</p>
                    @endif
                    <h5>Status Pajak</h5>
                    <p>{{ $pajak->status }}</p>
                    @if ($pajak->status == 'PKP')
                        <h5>User Efaktur</h5>
                        <p>{{ $pajak->user_efaktur }}</p>
                        <h5>Password Efaktur</h5>
                        <p>{{ $pajak->password_efaktur }}</p>
                        <h5>Enofa Password</h5>
                        <p>{{ $pajak->enofa_password }}</p>
                        <h5>Passphrese</h5>
                        <p>{{ $pajak->passphrese }}</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
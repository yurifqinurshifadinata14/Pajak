@extends ('main')
@section('konten')
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4">Detail Jenis dan Status</h3>
            <div class="card">
                <div class="card-body">
                    <h6><b>=> Detail Jenis</b></h6>
                    <div class="table-responsive">
                        <table class="table" cellspacing="0" cellpading="2px">
                            <thead>
                                <tr>
                                    <th style="border: 2px solid #dee2e6;">Jenis</th>
                                    @if ($pajak->jenis == 'Badan')
                                        <th style="border: 2px solid #dee2e6;">Jabatan</th>
                                        <th style="border: 2px solid #dee2e6;">Alamat Badan</th>
                                        <th style="border: 2px solid #dee2e6;">NPWP Badan</th>
                                        <th style="border: 2px solid #dee2e6;">Saham</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: 2px solid #dee2e6;">{{ $pajak->jenis }}</td>
                                    @if ($pajak->jenis == 'Badan')
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->jabatan }}</td>
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->alamatBadan }}</td>
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->npwpBadan }}</td>
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->saham }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <h6><b>=> Detail Status</b></h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="border: 2px solid #dee2e6;">Status</th>
                                    @if ($pajak->status == 'PKP')
                                        <th style="border: 2px solid #dee2e6;">User Efaktur</th>
                                        <th style="border: 2px solid #dee2e6;">Password Efaktur</th>
                                        <th style="border: 2px solid #dee2e6;">Enofa Password</th>
                                        <th style="border: 2px solid #dee2e6;">Passphrase</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: 2px solid #dee2e6;">{{ $pajak->status }}</td>
                                    @if ($pajak->status == 'PKP')
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->user_efaktur }}</td>
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->password_efaktur }}</td>
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->enofa_password }}</td>
                                        <td style="border: 2px solid #dee2e6;">{{ $pajak->passphrese }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

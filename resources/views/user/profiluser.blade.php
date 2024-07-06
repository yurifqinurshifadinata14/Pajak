@extends ('user.main')
@section('konten')
<div class="row">
    <div class="col-md-6 stretch-card grid-margin">
        <h4>PROFIL PERUSAHAAN</h4>
        <div class="card">
            <div class="card-body">
                <form class="form-sample">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">Nama WP</label>:
                                <div class="col-sm-9">
                                {{$pajak->nama_wp}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">Jenis WP</label>:
                                <div class="col-sm-9">
                                {{$pajak->jenis}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">Status WP</label>:
                                <div class="col-sm-9">
                                {{$pajak->status}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">NPWP</label>:
                                <div class="col-sm-9">
                                {{$pajak->npwp}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">NO HP</label>:
                                <div class="col-sm-9">
                                {{$pajak->no_hp}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">Gmail</label>:
                                <div class="col-sm-9">
                                {{$pajak->gmail}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">NIK</label>:
                                <div class="col-sm-9">
                                {{$pajak->nik}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">ALAMAT</label>:
                                <div class="col-sm-9">
                                {{$pajak->alamat}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">MERK DAGANG</label>:
                                <div class="col-sm-9">
                                {{$pajak->merk_dagang}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary ml-md-auto" data-bs-toggle="modal" data-bs-target="#detailModal">
                         Detail
                    </button>

                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 stretch-card grid-margin">
    <h4>FOTO PERUSAHAAN</h4>
        <div class="card">
            <div class="card-body">
                <center>
                    <img src="assets/images/profil.jpg" alt="image"
                        style="width: 300px; height: 300px;" class="mx-auto">
                </center>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Jenis dan Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
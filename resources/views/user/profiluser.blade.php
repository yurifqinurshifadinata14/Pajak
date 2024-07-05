@extends ('main')
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
                                    Mitra ABC
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">Jenis WP</label>:
                                <div class="col-sm-9">
                                    mitra@example.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">Status WP</label>:
                                <div class="col-sm-9">
                                    +123-456-789
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">NPWP</label>:
                                <div class="col-sm-9">
                                    1234567890
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">NO HP</label>:
                                <div class="col-sm-9">
                                    1234567890
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">Gmail</label>:
                                <div class="col-sm-9">
                                    111
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">NIK</label>:
                                <div class="col-sm-9">
                                    111
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">ALAMAT</label>:
                                <div class="col-sm-9">
                                    111
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2">MERK DAGANG</label>:
                                <div class="col-sm-9">
                                    111
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
                    <table class="table" cellspacing="0" cellpadding="2px">
                        <thead>
                            <tr>
                                <th style="border: 2px solid #dee2e6;">Jenis</th>
                                <th style="border: 2px solid #dee2e6;">Jabatan</th>
                                <th style="border: 2px solid #dee2e6;">Alamat Badan</th>
                                <th style="border: 2px solid #dee2e6;">NPWP Badan</th>
                                <th style="border: 2px solid #dee2e6;">Saham</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 2px solid #dee2e6;">Badan</td>
                                <td style="border: 2px solid #dee2e6;">Direktur Utama</td>
                                <td style="border: 2px solid #dee2e6;">Jalan Badan No. 123</td>
                                <td style="border: 2px solid #dee2e6;">1234567890</td>
                                <td style="border: 2px solid #dee2e6;">50%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <h6><b>=> Detail Status</b></h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="border: 2px solid #dee2e6;">Status</th>
                            <th style="border: 2px solid #dee2e6;">User Efaktur</th>
                            <th style="border: 2px solid #dee2e6;">Password Efaktur</th>
                            <th style="border: 2px solid #dee2e6;">Enofa Password</th>
                            <th style="border: 2px solid #dee2e6;">Passphrase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 2px solid #dee2e6;">PKP</td>
                            <td style="border: 2px solid #dee2e6;">user_efaktur123</td>
                            <td style="border: 2px solid #dee2e6;">password_efaktur123</td>
                            <td style="border: 2px solid #dee2e6;">enofa_password123</td>
                            <td style="border: 2px solid #dee2e6;">passphrase123</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
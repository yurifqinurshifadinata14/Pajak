@extends ('main')
@section('konten')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> Data Diri</h1>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Diri Pembayar
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
                        <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                    </button>
                    <!-- Modal Button Tambah -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="tambahModalLabel"><b>Tambah Data Pajak</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('pajakStore') }}" method="post">
                                    <div class="modal-body">
                                        @csrf
                                        <!-- Input Data -->
                                        <div class="form-group">
                                            <label for="nama"><b>Nama WP</b></label>
                                            <input type="text" class="form-control" id="nama_wp" name="nama_wp" placeholder="Nama WP">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis">Jenis WP</label>
                                            <select name="jenis" id="jenis" class="form-select" onchange="showInput(this)">
                                                <option selected disabled>--Select--</option>
                                                <option value="Badan">Badan</option>
                                                <option value="Pribadi">Pribadi</option>
                                            </select>
                                        </div>
                                        <div id="jenisBadan" style="display:none;">
                                            <h6>-- Bagian Badan --</h6>
                                            <div class="form-group">
                                                <label for="alamatBadan">Alamat</label>
                                                <input type="text" class="form-control" id="alamatBadan" name="alamatBadan"
                                                placeholder="Alamat">
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <input type="text" class="form-control" id="jabatan" name="jabatanBadan"
                                                    placeholder="Jabatan">
                                            </div>
                                            <div class="form-group">
                                                <label for="npwpBadan">NPWP</label>
                                                <input type="number" class="form-control" id="npwpBadan" name="npwpBadan"
                                                    placeholder="NPWP">
                                            </div>
                                            <div class="form-group">
                                                <label for="saham">Saham</label>
                                                <input type="text" class="form-control" id="saham" name="sahamBadan"
                                                    placeholder="Saham">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status WP</label>
                                            <select name="status" id="status" class="form-select" onchange="showInput(this)">
                                                <option selected disabled>--Select--</option>
                                                <option value="PKP">PKP</option>
                                                <option value="Non PKP">Non PKP</option>
                                            </select>
                                        </div>
                                        <div id="statusPkp" style="display:none;">
                                            <h6>-- Bagian PKP --</h6>
                                            <div class="form-group">
                                                <label for="enofa_password">Enofa Password</label>
                                                <input type="password" class="form-control" id="enofa_password" name="enofa_password"
                                                placeholder="Enofa password">
                                            </div>
                                            <div class="form-group">
                                                <label for="passphrese">Passphrese</label>
                                                <input type="text" class="form-control" id="passphrese" name="passphrese"
                                                placeholder="Passphrese">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_efaktur">User Efaktur</label>
                                                <input type="text" class="form-control" id="user_efaktur" name="user_efaktur"
                                                    placeholder="User efaktur">
                                            </div>
                                            <div class="form-group">
                                                <label for="password_efaktur">Password Efaktur</label>
                                                <input type="password" class="form-control" id="password_efaktur" name="password_efaktur"
                                                    placeholder="Password efaktur">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="npwp">NPWP</label>
                                            <input type="number" class="form-control" id="npwp" name="npwp" placeholder="NPWP">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">No Hp</label>
                                            <input type="number" class="form-control" id="no_hp" name="no_hp"
                                                placeholder="No Hp">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_efin">No EFIN</label>
                                            <input type="number" class="form-control" id="no_efin" name="no_efin"
                                                placeholder="No EFIN">
                                        </div>
                                        <div class="form-group">
                                            <label for="gmail">Gmail</label>
                                            <input type="email" class="form-control" id="gmail" name="gmail"
                                                placeholder="Gmail">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                placeholder="Alamat">
                                        </div>
                                        <div class="form-group">
                                            <label for="merk_dagang">Merk Dagang</label>
                                            <input type="text" class="form-control" id="merk_dagang" name="merk_dagang"
                                                placeholder="Merk Dagang">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama WP</th>
                                    <th>Jenis WP</th>
                                    <th>Status WP</th>
                                    <th>NPWP</th>
                                    <th>No Hp</th>
                                    <th>No EFIN</th>
                                    <th>Gmail</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Merk Dagang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pajak as $p)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $p->nama_wp }}</td>
                                        <td>{{ $p->jenis }}</td>
                                        <td>{{ $p->status }}</td>
                                        <td>{{ $p->npwp }}</td>
                                        <td>{{ $p->no_hp }}</td>
                                        <td>{{ $p->no_efin }}</td>
                                        <td>{{ $p->gmail }}</td>
                                        <td>{{ $p->nik }}</td>
                                        <td>{{ $p->alamat }}</td>
                                        <td>{{ $p->merk_dagang }}</td>
                                        <td>
                                            <div class="button-container">
                                                <div class="dropdown">
                                                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-fw fa-solid fa-search"></i> </button>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ route('jenisSub') }}" >Detail Jenis</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('statusSub') }}">Detail Status</a></li>
                                                    </ul>
                                                </div>
                                                <a href="{{ route('pajakEdit', $p->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                <form method="POST" action="{{ route('pajakDestroy', $p->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin mau hapus???')"><i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function showInput(selectObject) {
                var value = selectObject.value;
                if (value == 'Badan') {
                    document.getElementById('jenisBadan').style.display = 'block';
                } else {
                    document.getElementById('jenisBadan').style.display = 'none';
                }
                if (value == 'PKP') {
                    document.getElementById('statusPkp').style.display = 'block';
                } else {
                    document.getElementById('statusPkp').style.display = 'none';
                }
            }
        </script>
    </main>
@endsection

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
                            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar"
                                placeholder="jumlah bayar">
                        </div>
                        <div class="form-group">
                            <label for="nama">BPF</label>
                            <input type="text" class="form-control" id="bpf" name="bpf" placeholder="BPF">
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
                        <button type="submit" class="btn btn-navy">Simpan</button>
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

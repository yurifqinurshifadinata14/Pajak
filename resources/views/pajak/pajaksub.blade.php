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
                    <!-- Modal Button Edit -->
                    @foreach ($pajak as $p)
                    <div class="modal fade" id="edit{{$p->id_pajak}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel"><b>Edit Data Pajak</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pajakUpdate', $p->id_pajak) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <!--input data-->
                                        <div class="form-group">
                                            <label for="nama">Nama WP</label>
                                            <input type="text" class="form-control" id="nama_wp" name="nama_wp" value="{{ $p->nama_wp }}" placeholder="Nama WP">
                                        </div>
                                        <label for="jenis">Jenis WP</label>
                                        <select name="jenis" id="jenis" class="form-select" value="{{$p->jenis}}" onchange="showEditInput(this)">
                                            <option selected disabled>--Select--</option>
                                            <option value="editBadan">Badan</option>
                                            <option value="Pribadi" >Pribadi</option>    
                                        </select>
                                        <div id="editjenisBadan" style="display:none;">
                                            <h6>-- Bagian Badan --</h6>
                                            <div class="form-group">
                                                <label for="alamatBadan">Alamat</label>
                                                <input type="text" class="form-control" id="alamatBadan" name="alamatBadan"
                                                value="{{ $p->alamatBadan }}"placeholder="Alamat">
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <input type="text" class="form-control" id="jabatan" name="jabatan"
                                                value="{{ $p->jabatan}}"  placeholder="Jabatan">
                                            </div>
                                            <div class="form-group">
                                                <label for="npwpBadan">NPWP</label>
                                                <input type="number" class="form-control" id="npwpBadan" name="npwpBadan"
                                                value="{{ $p->npwpBadan }}"   placeholder="NPWP">
                                            </div>
                                            <div class="form-group">
                                                <label for="saham">Saham</label>
                                                <input type="text" class="form-control" id="saham" name="saham"
                                                value="{{ $p->saham }}"   placeholder="Saham">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status WP</label>
                                            <select name="status" id="editstatus" class="form-select" value="{{$p->status}}" onchange="showEditInput(this)">
                                                <option selected disabled>--Select--</option>
                                                <option value="editPKP">PKP</option>
                                                <option value="Non PKP">Non PKP</option>
                                                <!-- @if($p->PKP == 'PKP') checked @endif -->
                                            </select>
                                        </div>
                                        <div id="editstatusPkp" style="display:none;">
                                            <h6>-- Bagian PKP --</h6>
                                            <div class="form-group">
                                                <label for="enofa_password">Enofa Password</label>
                                                <input type="password" class="form-control" id="enofa_password" name="enofa_password"
                                                value="{{ $p->enofa_password }}" placeholder="Enofa password">
                                            </div>
                                            <div class="form-group">
                                                <label for="passphrese">Passphrese</label>
                                                <input type="text" class="form-control" id="passphrese" name="passphrese"
                                                value="{{ $p->passphrese }}"placeholder="Passphrese">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_efaktur">User Efaktur</label>
                                                <input type="text" class="form-control" id="user_efaktur" name="user_efaktur"
                                                value="{{ $p->user_efaktur }}" placeholder="User efaktur">
                                            </div>
                                            <div class="form-group">
                                                <label for="password_efaktur">Password Efaktur</label>
                                                <input type="password" class="form-control" id="password_efaktur" name="password_efaktur"
                                                value="{{ $p->password_efaktur }}" placeholder="Password efaktur">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="npwp">NPWP</label>
                                            <input type="text" class="form-control" id="npwp" name="npwp" value="{{ $p->npwp }}" placeholder="NPWP">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="no_hp">No Hp</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $p->no_hp }}" placeholder="No Hp">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="no_efin">No EFIN</label>
                                            <input type="text" class="form-control" id="no_efin" name="no_efin" value="{{ $p->no_efin }}" placeholder="No EFIN">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="gmail">Gmail</label>
                                            <input type="email" class="form-control" id="gmail" name="gmail" value="{{ $p->gmail }}" placeholder="Gmail">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" value="{{ $p->password }}"
                                                placeholder="Password">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" value="{{ $p->nik }}" placeholder="NIK">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $p->alamat }}" placeholder="Alamat">
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="merk_dagang">Merk Dagang</label>
                                            <input type="text" class="form-control" id="merk_dagang" name="merk_dagang" value="{{ $p->merk_dagang }}"
                                                placeholder="Merk Dagang">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="card-body">
                    <style>
                        .button-container {
                            display: flex;
                        }

                        .my-table {
                            width: 100%;
                        }

                        .my-table th,
                        .my-table td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }

                        .my-table th {
                            background-color: #12094a;
                            color: rgb(255, 255, 255);
                        }

                        .my-table tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }
                    </style>
                    <div class="table-responsive">

                        <table id="pajakTable" class="my-table">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
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
                            {{-- <tbody>
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
                            </tbody> --}}
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
            function showEditInput(selectObject) {
                var value = selectObject.value;
                if (value == 'editBadan') {
                    document.getElementById('editjenisBadan').style.display = 'block';
                } else {
                    document.getElementById('editjenisBadan').style.display = 'none';
                }
                if (value == 'editPKP') {
                    document.getElementById('editstatusPkp').style.display = 'block';
                } else {
                    document.getElementById('editstatusPkp').style.display = 'none';
                }
                console.log(document.getElementById('editjenisBadan'))
            }

            
            </script>
        @push('script')
        <script>
            let pajak ={!! json_encode($pajak) !!}
            console.log('ini pajak:',pajak)

           $('#click').on('click',()=>{
            alert('test')
           })

  

           
            $(document).ready( function () {
                 const table = new DataTable('#pajakTable',{
                        data:pajak,
                        columns:[
                            {
                           data:'id'
                        },
                            {
                            data:'nama_wp'
                        },
                            {
                            data:'jenis'
                        },
                            {
                            data:'status'
                        },
                            {
                            data:'npwp'
                        },
                            {
                            data:'no_hp'
                        },
                            {
                            data:'no_efin'
                        },
                            {
                            data:'gmail'
                        },
                            {
                            data:'nik'
                        },
                            {
                            data:'alamat'
                        },
                            {
                            data:'merk_dagang'
                        },
                            {
                                data:'id_pajak',
                            render:(data)=>{
                                return /*html*/`<div class="button-container">
                                                <div class="dropdown">
                                                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-fw fa-solid fa-search"></i> </button>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                      <li><a class="dropdown-item" href="{{ route('pajak.Detail', '') }}/${data}" >Detail Jenis & Status</a></li>
                                                    </ul>
                                                </div>
                                                <a href="{{ route('pajakEdit', '') }}/${data}" data-bs-toggle="modal" data-bs-target="#edit${data}" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                
                                                <form method="POST" action="{{ route('pajakDestroy', '') }}/${data}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus???')"> 
                                                        <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                                </form>
                                            </div>`
                            }
                        },
                    ]
                    });

                    let i = 1;
 
 table
     .cells(null, 0, { search: 'applied', order: 'applied' })
     .every(function (cell) {
         this.data(i++);
     });
        } );

      
        </script>
        
        @endpush
    </main>
@endsection

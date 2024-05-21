@extends('main')

@section('konten')
<main x-data="{ pilih: '' }">
    <div class="container-fluid px-4" x-data="app">
        <h1 class="mt-4"> DATA ADMIN </h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Admin Rekap
                <!-- Import Button -->
                

                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#tambah">
                    <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                </button> &nbsp;

                <button type="button" class="btn btn-sm btn-success float-end me-2" data-bs-toggle="modal"
                    data-bs-target="#import">
                    <i class="fas fa-fw fa-file-excel"></i> Import Excel
                </button>

                <!-- Modal Button Tambah -->
                <x-dataadmin.modaltambahdataadmin />

                <!-- Modal Button Edit -->
                <x-dataadmin.modaleditdataadmin />

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
                    <table id="dataadminTable" class="my-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataadmins as $dataadmin)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Incremental number -->
                                <td>{{ $dataadmin->name }}</td>
                                <td>{{ $dataadmin->email }}</td>
                                <td>{{ $dataadmin->role }}</td>
                                <td>
                                    <!-- Buttons for actions -->
                                    <div class="button-container">
                                        <button type="button" class="btn btn-warning float-end ms-2"
                                            @click="select('{{ $dataadmin->id }}')" data-bs-toggle="modal"
                                            :data-bs-target="'#edit' + '{{ $dataadmin->id }}'">
                                            <i class="fas fa-fw fa-solid fa-pen"></i>
                                        </button> &nbsp; &nbsp;

                                        <a href="/dataadminDelete/{{$dataadmin->id}}" class="btn btn-danger "
                                            onclick="return confirm('Yakin ingin menghapus data ?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
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

    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="importLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importLabel">Import Data Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dataadmin.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload File Excel</label>
                            <input class="form-control" type="file" id="formFile" name="file" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal Edit -->
    @foreach($dataadmins as $dataadmin)
    <div class="modal fade" id="edit{{ $dataadmin->id }}" tabindex="-1" aria-labelledby="edit{{ $dataadmin->id }}Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit{{ $dataadmin->id }}Label">Edit Data Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dataadminUpdate/{{ $dataadmin->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="examplenama"
                                placeholder="Name" name="name" value="{{ $dataadmin->name }}">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Email" name="email" value="{{ $dataadmin->email }}">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                    placeholder="Password" name="password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                    placeholder="Repeat Password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <select name="role" id="exampleInputRole" class="form-select">
                                <option value="" disabled>Pilih Role</option>
                                <option value="admin" {{ $dataadmin->role == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="staff" {{ $dataadmin->role == 'staff' ? 'selected' : '' }}>
                                    Staff</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Modal Import -->

    @push('script')
    <script>
        let dataadmins = {
            !!json_encode($dataadmins) !!
        };

        document.addEventListener('alpine:init', function () {
            Alpine.data('app', () => ({
                select(id) {
                    this.pilih = id;
                }
            }));

            initTable(dataadmins);
        });

        function initTable(data) {
            $('#dataadminTable').DataTable({
                dom: 'Bfrtip',

                buttons: [
                    //'copy', 'excel', 'pdf'
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"> </i> Copy',
                        className: 'btn-sm btn-secondary', // Menambahkan kelas 'btn-success' untuk tombol Excel
                        titleAttr: 'Salin ke Clipboard', // Keterangan tambahan untuk tooltip
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"> </i> Excel',
                        className: 'btn-sm btn-success', // Menambahkan kelas 'btn-success' untuk tombol Excel
                        titleAttr: 'Ekspor ke Excel', // Keterangan tambahan untuk tooltip
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"> </i> PDF',
                        className: 'btn-sm btn-danger', // Menambahkan kelas 'btn-danger' untuk tombol PDF
                        titleAttr: 'Unduh sebagai PDF', // Keterangan tambahan untuk tooltip
                    }
                ],
                destroy: true,
                data: data,
                columns: [{
                        data: null,
                        render: (data, type, row, meta) => {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return `
                            <div class="button-container">
                                        <button type="button" class="btn btn-warning"
                                            @click="select('${data}')"
                                            data-bs-toggle="modal"
                                            :data-bs-target="'#edit' + '${data}'">
                                            <i class="fas fa-fw fa-solid fa-pen"></i>
                                        </button>   &nbsp;  &nbsp;
                                        <a href="/dataadminDelete/${data}"
                                            class="btn btn-danger "
                                            onclick="return confirm('Yakin ingin menghapus data ?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                            `;
                        }
                    }
                ]
            });
        }

    </script>
    @endpush
</main>
@endsection

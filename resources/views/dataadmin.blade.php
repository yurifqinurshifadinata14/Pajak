@extends('main')

@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-0" x-data="app">
            <h5 class="d-inline d-md-none mt-4"> DATA ADMIN </h5>
            <h1 class="d-none d-md-block mt-4"> DATA ADMIN </h1>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        <span class="d-inline d-md-none">Rekap</span>
                        <span class="d-none d-md-inline">Data Admin Rekap</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Button Import -->
                        <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                            data-bs-target="#import">
                            <i class="fas fa-fw fa-file-excel d-inline d-md-none"></i>
                            <span class="d-none d-md-inline">Import Excel</span>
                        </button>
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#tambah">
                            <i class="fas fa-fw fa-solid fa-plus d-inline d-md-none"></i>
                            <span class="d-none d-md-inline">Tambah</span>
                        </button>
                        <!-- Modal Button Tambah -->
                        <x-dataadmin.modaltambahdataadmin />

                        <!-- Modal Button Edit -->
                        <x-dataadmin.modaleditdataadmin />

                        <!-- Modal Import -->
                        <div class="modal fade" id="import" tabindex="-1" aria-labelledby="importLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importLabel">Import Data Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('dataadmin.import') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Upload File Excel</label>
                                                <input class="form-control" type="file" id="formFile" name="file"
                                                    required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Export Button (Hidden on Desktop) -->
                        <div class="d-sm-none">
                            <button id="exportBtn" type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#exportModal">
                                <i class="fas fa-fw fa-file-export"></i>
                            </button>
                            <!-- Modal Export Mobile -->
                            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel">Export Data Admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="{{ route('export.excel') }}" class="btn btn-success">Export to
                                                Excel</a>
                                            <button class="btn btn-danger" onclick="exportPDF()">Export to PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

                        @media (max-width: 768px) {
                            #exportButtons {
                                float: none;
                                text-align: left;
                            }

                            #exportDropdown {
                                width: 100%;
                                margin-bottom: 5px;
                            }
                        }
                    </style>
                    <div class="table-responsive">
                        <table id="dataadminTable" class="my-table responsive" style="width: 100px">
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
                                @foreach ($dataadmins as $dataadmin)
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
                                                    :data-bs-target="'{{ route('dataadminEdit', ['id' => $dataadmin->id]) }}'">
                                                    <i class="fas fa-fw fa-solid fa-pen"></i>
                                                </button> &nbsp; &nbsp;

                                                <a href="{{ route('dataadminDelete', ['id' => $dataadmin->id]) }}"
                                                    class="btn btn-danger"
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

        <!-- Modal Edit -->
        @foreach ($dataadmins as $dataadmin)
            <div class="modal fade" id="edit{{ $dataadmin->id }}" tabindex="-1"
                aria-labelledby="edit{{ $dataadmin->id }}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit{{ $dataadmin->id }}Label">Edit Data Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                                    <div class="col-sm-6 mb-sm-0 mb-3">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password"
                                            name="password_confirmation">
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
        @push('script')
            <script>
                let dataadmins = {!! json_encode($dataadmins) !!};

                document.addEventListener('alpine:init', function() {
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
                        buttons: [{
                                extend: 'copy',
                                text: '<i class="fas fa-copy"> </i> Copy',
                                className: 'btn-sm btn-secondary d-none d-md-block', // Menambahkan kelas 'btn-success' untuk tombol Excel
                                titleAttr: 'Salin ke Clipboard', // Keterangan tambahan untuk tooltip
                                responsive: true,
                                responsivePriority: 1,
                            },
                            {
                                extend: 'excel',
                                text: '<i class="fas fa-file-excel"> </i> Excel',
                                className: 'btn-sm btn-success d-none d-md-block', // Menambahkan kelas 'btn-success' untuk tombol Excel
                                titleAttr: 'Ekspor ke Excel', // Keterangan tambahan untuk tooltip
                                responsive: true,
                                responsivePriority: 2,
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="fas fa-file-pdf"> </i> PDF',
                                className: 'btn-sm btn-danger d-none d-md-block', // Menambahkan kelas 'btn-danger' untuk tombol PDF
                                titleAttr: 'Unduh sebagai PDF', // Keterangan tambahan untuk tooltip
                                responsive: true,
                                responsivePriority: 3,
                            }
                        ],
                        initComplete: function() {
                            // Menambahkan event listener untuk tombol "Export Excel"
                            $('#exportExcelBtn').on('click', function(event) {
                                event.preventDefault();
                                window.location.href = '{{ route('export.excel') }}';
                            });

                            // Menambahkan event listener untuk tombol "Export PDF"
                            $('#exportPdfBtn').on('click', function(event) {
                                event.preventDefault();
                                // Tambahkan logika untuk mengarahkan ke halaman export PDF jika diperlukan
                            });
                        },
                        responsive: {
                            details: {
                                renderer: (api, rowIdx, columns) => {
                                    let data = columns
                                        .map((col, i) => {
                                            return col.hidden ? /*html*/ `
                                                <tr data-dt-row="${col.rowIndex}" data-dt-column="${i}">
                                                    <th>${col.title}</th>
                                                    <td style="width: 100%;">${col.data}</td>
                                                </tr>
                                            ` : ``;
                                        })
                                        .join('');

                                    let table = document.createElement('table');
                                    table.innerHTML = data;

                                    return data ? table : false;
                                }
                            }
                        },
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
                                render: function(data, type, row, meta) {
                                    return `
                            <div class="button-container">
                                <button type="button"
                                    class="btn btn-warning float-end ms-2"
                                    @click="select(${data})"
                                    data-bs-toggle="modal" :data-bs-target="'#edit' + ${data}">
                                    <i class="fas fa-fw fa-solid fa-pen"></i>
                                </button> &nbsp;  &nbsp;

                                <a href="/dataadminDelete/${data}" class="btn btn-danger "
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

                function exportPDF() {
                    const element = document.getElementById('dataadminTable');
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();
                    doc.text('Data Admin', 14, 20);
                    doc.autoTable({
                        head: [
                            ['No', 'Nama', 'Email', 'Role']
                        ],
                        body: [...element.querySelectorAll('tbody tr')].map(row => [
                            row.cells[0].textContent,
                            row.cells[1].textContent,
                            row.cells[2].textContent,
                            row.cells[3].textContent
                        ]),
                        styles: {
                            fontSize: 12,
                            overflow: 'linebreak'
                        }
                    });
                    doc.save('dataadmin.pdf');
                }
            </script>
        @endpush

    </main>
@endsection

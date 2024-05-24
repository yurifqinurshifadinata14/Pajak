@extends ('main')
@section('konten')
{{-- <style>
    @media (max-width: 767px) {
        #accordionSidebar {
        display: none;
    }


        #content-wrapper {
            margin-left: 0;
        }

        /* .sidebar-card {
            display: none;
        } */
    }
</style> --}}

    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-2" x-data="app">
            <h1 class="mt-4"> Data Diri</h1>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Data Diri Pembayar
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2 align-items-center align-items-sm-end justify-content-between">
                        <!-- Button trigger modal Import-->
                        <button type="button" class="btn btn-sm btn-success mb-0 mb-sm-0" title="Import Excel" data-bs-toggle="modal" data-bs-target="#importExcel">
                            <span class="d-none d-sm-inline ">Import Excel</span>
                            <i class="fas fa-file-excel"></i>
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" title="Tambah Data Pajak" data-bs-toggle="modal" data-bs-target="#tambah">
                            <span class="d-none d-sm-inline">Tambah</span>
                            <i class="fas fa-fw fa-solid fa-plus"></i>
                        </button>
                    </div>



                    <!-- Modal Button Tambah -->
                    <x-pajaksub.modaltambah />
                    <!-- Modal Button Edit -->
                    <x-pajaksub.modaledit />
                    <!-- Modal Button import -->
                    <x-pajaksub.modalimportpajak />

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
                        <table id="pajakTable" class="my-table" style="width: 100%">
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
                var id = selectObject.id;
                var value = selectObject.value;

                if (id == 'editjenis') {
                    if (value == 'Badan') {
                        document.getElementById('editjenisBadan').style.display = 'block';
                    } else {
                        document.getElementById('editjenisBadan').style.display = 'none';
                    }
                }

                if (id == 'editstatus') {
                    if (value == 'PKP') {
                        document.getElementById('editstatusPkp').style.display = 'block';
                    } else {
                        document.getElementById('editstatusPkp').style.display = 'none';
                    }
                }
            }
        </script>
        @push('script')
            <script>
                let pajak = {!! json_encode($pajak) !!}

                var getPajak = async () => {
                    await fetch("{{ route('getpajaksub') }}", {
                        method: 'GET',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => res.json()).then(res => {
                        i = 1
                        pajak = res.pajak
                        initTable(pajak)
                    })
                };

                var deleteData = async (id) => {
                    if (confirm('Apakah anda ingin menghapus?') == true) {
                        await fetch(`{{ route('pajakDestroy', '') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(res => getPajak()).catch(err => console.log(err));
                    }
                }

                let i = 1;

                var initTable = (pajak) => {
                    $('#pajakTable').DataTable({
                            dom: 'Bfrtip',
                            //lengthMenu: [10, 25, 50, 100], // Menentukan daftar jumlah entri yang ingin ditampilkan
                            //lengthChange: true,
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
                            destroy: true,
                            data: pajak,
                            columns: [{
                                    data: 'id'
                                },
                                {
                                    data: 'nama_wp'
                                },
                                {
                                    data: 'jenis'
                                },
                                {
                                    data: 'status'
                                },
                                {
                                    data: 'npwp'
                                },
                                {
                                    data: 'no_hp'
                                },
                                {
                                    data: 'no_efin'
                                },
                                {
                                    data: 'gmail'
                                },
                                {
                                    data: 'nik'
                                },
                                {
                                    data: 'alamat'
                                },
                                {
                                    data: 'merk_dagang'
                                },
                                {
                                    data: 'id_pajak',
                                    render: (data) => {
                                        return /*html*/ `<div class="button-container gap-2">
                                               <a class="btn btn-sm btn-info" title="Detail Jenis & Status" href="{{ route('pajak.Detail', '') }}/${data}" ><i class="fas fa-fw fa-solid fa-search"></i></a>
                                                    <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning" title="Edit Data" @click="select('${data}')">
                                                        <i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                        @if (auth()->user()->role == 'admin')
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="deleteData('${data}')">
                                                            <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                                        @endif
                                                </div>`
                                    }
                                },
                            ]
                        }).cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });;
                }

                initTable(pajak)





                document.addEventListener('alpine:init', () => {
                    Alpine.data('formTambah', () => ({
                        formData: {
                            nama_wp: '',
                            jenis: '',
                            status: '',
                            npwp: '',
                            no_hp: '',
                            no_efin: '',
                            gmail: '',
                            nik: '',
                            alamat: '',
                            merk_dagang: ''
                        },
                        showJenis: false,
                        showStatus: false,

                        handleSubmit() {
                            fetch("{{ route('pajakStore') }}", {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(this.formData)
                            }).then(res => {
                                $('#tambah').modal('hide');
                                this.formData = {
                                    nama_wp: '',
                                    jenis: '',
                                    status: '',
                                    npwp: '',
                                    no_hp: '',
                                    no_efin: '',
                                    gmail: '',
                                    nik: '',
                                    alamat: '',
                                    merk_dagang: ''
                                }
                                getPajak()
                            }).catch(err => console.log(err))
                        },


                    }))


                    Alpine.data('app', () => ({
                        data: [],
                        editId: '',
                        file: null,


                        select(id) {
                            this.data = pajak.filter(item => item.id_pajak == id)
                            this.data = this.data[0]
                        },

                        editSubmit() {
                            fetch(`{{ route('pajakUpdate', '') }}/${this.data.id_pajak}`, {
                                method: 'PUT',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(this.data)
                            }).then(res => {
                                $('#edit').modal('hide');
                                getPajak()
                            }).catch(err => console.log(err))
                        },

                        handleImport() {
                            let formData = new FormData();
                            formData.append('file', this.file[0]);

                            fetch("{{ route('pajak.import_excel') }}", {
                                method: 'POST',
                                headers: {
                                    /*  "Content-Type": "application/json", */
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            }).then(res => {
                                getPajak()
                                $('#importExcel').modal('hide')
                            })
                        },


                        init() {
                            console.log('data:', this.data)
                        },
                    }))
                })
            </script>

        @endpush
    </main>
@endsection

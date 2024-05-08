@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-4" x-data="app">
            <h1 class="mt-4"> Data Diri</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Diri Pembayar
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                    </button>
                    <!-- Modal Button Tambah -->
                    <x-pajaksub.modalTambah />

                    <!-- Modal Button Edit -->
                    {{--  @foreach ($pajak as $p)
                        <x-pajaksub.modaledit :p="$p" />
                    @endforeach --}}
                    <x-pajaksub.modaledit />

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
                    await fetch(`{{ route('pajakDestroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => getPajak()).catch(err => console.log(err));
                }

                let i = 1;

                var initTable = (pajak) => {
                    $('#pajakTable').DataTable({
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
                                        return /*html*/ `<div class="button-container">
                                               <a class="btn btn-sm btn-info" href="{{ route('pajak.Detail', '') }}/${data}" ><i class="fas fa-fw fa-solid fa-search"></i></a>
                                                    <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning" @click="select('${data}')"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData('${data}')">
                                                                <i class="fas fa-fw fa-solid fa-trash"></i> </button>
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

                        init() {
                            console.log('data:', this.data)
                        },
                    }))
                })
            </script>
        @endpush
    </main>
@endsection

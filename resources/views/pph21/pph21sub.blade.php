@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-4" x-data="app">
            <h1 class="mt-4">Data Pph21</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Pph21
                    <button type="button" class="btn btn-sm btn-primary float-end mb-2" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                    </button>

                    <!-- modal button tambah-->
                    <x-pph21sub.modalTambah :pajaks="$pajaks" />

                    <!-- modal button edit-->
                    <x-pph21sub.modaledit />

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
                        <table id="pph21Table" class="my-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jumlah Bayar</th>
                                    <th>BPF</th>
                                    <th>Biaya Bulan</th>
                                    <th>Daftar Karyawan</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                        </table>
                    </div>

                    <<<<<<< HEAD=======<div class="card-body">
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
                            <table id="pph21Table" class="my-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama WP</th>
                                        <th>Jumlah Bayar</th>
                                        <th>BPF</th>
                                        <th>Biaya Bulan</th>
                                        <th>Daftar Karyawan</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>

                </div>
                >>>>>>> 15e1abb62b46434ea97c2b9402c9ff25be59e64a
            </div>
        </div>
        </div>

        <script>
            function showInput(selectObject) {
                var value = selectObject.value;
                if (value == 'NIK') {
                    document.getElementById('nik').style.display = 'block';
                } else {
                    document.getElementById('nik').style.display = 'none';
                }
                if (value == 'NPWP') {
                    document.getElementById('npwp').style.display = 'block';
                } else {
                    document.getElementById('npwp').style.display = 'none';
                }
            }

            function showEditInput(selectObject) {
                var value = selectObject.value;
                if (value == 'NIK') {
                    document.getElementById('nik').style.display = 'block';
                } else {
                    document.getElementById('nik').style.display = 'none';
                }
                if (value == 'NPWP') {
                    document.getElementById('npwp').style.display = 'block';
                } else {
                    document.getElementById('npwp').style.display = 'none';
                }
            }
        </script>
        @push('script')
            <script>
                let pph21 = {
                    !!json_encode($pph21) !!
                }

                var getpph21 = async () => {
                    await fetch("{{ route('getpph21sub') }}", {
                        method: 'GET',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => res.json()).then(res => {
                        i = 1
                        pph21 = res.pph21
                        initTable(pph21)
                        console.log(pph21)
                    })
                };
                var deleteData = async (id) => {
                    await fetch(`{{ route('pph21Destroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => getpph21()).catch(err => console.log(err));
                }

                let i = 1;

                var initTable = (pph21) => {
                    $('#pph21Table').DataTable({
                            destroy: true,
                            data: pph21,
                            columns: [{
                                    data: 'id'
                                },
                                {
                                    data: 'jumlah_bayar'
                                },
                                {
                                    data: 'bpf'
                                },
                                {
                                    data: 'biaya_bulan'
                                },
                                {
                                    data: 'nik'
                                },
                                {
                                    data: 'id_pph21',
                                    render: (data) => {
                                        return /*html*/ `<div class="button-container">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning" @click="select('${data}')"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                    @if (auth()->user()->role == 'admin')
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteData('${data}')">
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
                initTable(pph21)
                document.addEventListener('alpine:init', () => {
                        Alpine.data('formTambah', () => ({
                            formData: {
                                id_pajak: '',
                                jumlah_bayar: '',
                                bpf: '',
                                biaya_bulan: '',
                                nik: '',
                                npwp: ''
                            },


                            handleSubmit() {
                                console.log(this.formData)
                                fetch("{{ route('pph21Store') }}", {
                                    method: 'POST',
                                    headers: {
                                        "Content-Type": "application/json",
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify(this.formData)
                                }).then(res => {
                                    console.log(res.json)
                                    $('#tambah').modal('hide');
                                    this.formData = {
                                        id_pajak: '',
                                        jumlah_bayar: '',
                                        bpf: '',
                                        biaya_bulan: '',
                                        nik: '',
                                        npwp: ''
                                    }
                                    getpph21()
                                }).catch(err => console.log(err))
                            },

                        }))


                        Alpine.data('app', () => ({
                            data: [],
                            editId: '',
                            select(id) {
                                this.data = pph21.filter(item => item.id_pph21 == id)
                                this.data = this.data[0]
                                console.log(this.data)
                                /*  this.data = pph21[id] */
                            },

                            editSubmit() {
                                console.log(this.data)
                                fetch(`{{ route('pph21Update', '') }}/${this.data.id_pph21}`, {
                                    method: 'PUT',
                                    headers: {
                                        "Content-Type": "application/json",
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify(this.data)
                                }).then(res => {
                                    $('#edit').modal('hide');
                                    getpph21()
                                }).catch(err => console.log(err))
                            },

                            init() {
                                console.log('data:', this.data)
                            },
                        }))
                    })

                    <<
                    <<
                    <<
                    <
                    HEAD
            </script>
        @endpush
    </main>
    =======
    handleSubmit() {
    const data = {
    id_pajak: this.formData.id_pajak,
    jumlah_bayar: this.formData.jumlah_bayar.replaceAll('.', ''),
    bpf: this.formData.bpf,
    biaya_bulan: this.formData.biaya_bulan.replaceAll('.', ''),
    nik: this.formData.nik,
    npwp: this.formData.npwp
    }
    fetch("{{ route('pph21Store') }}", {
    method: 'POST',
    headers: {
    "Content-Type": "application/json",
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify(data)
    }).then(res => {
    console.log(res.json)
    $('#tambah').modal('hide');
    this.formData = {
    id_pajak: '',
    jumlah_bayar: '',
    bpf: '',
    biaya_bulan: '',
    nik: '',
    npwp: ''
    }
    getpph21()
    }).catch(err => console.log(err))
    },

    }))


    Alpine.data('app', () => ({
    data: [],
    editId: '',
    select(id) {
    this.data = pph21.filter(item => item.id_pph21 == id)
    this.data = this.data[0]
    console.log(this.data)
    /* this.data = pph21[id] */
    },

    editSubmit() {
    console.log(this.data)
    fetch(`{{ route('pph21Update', '') }}/${this.data.id_pph21}`, {
    method: 'PUT',
    headers: {
    "Content-Type": "application/json",
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify(this.data)
    }).then(res => {
    $('#edit').modal('hide');
    getpph21()
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
>>>>>>> 15e1abb62b46434ea97c2b9402c9ff25be59e64a
@endsection

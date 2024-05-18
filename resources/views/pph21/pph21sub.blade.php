@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-4" x-data="app">
            <h1 class="mt-4">Pph21</h1>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Data Pph21
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-success float-end mb-2" title="Import Excel" data-bs-toggle="modal" data-bs-target="#importExcel">
                            <i class="fas fa-file-excel"></i> Import Excel
                        </button>
                        <button type="button" class="btn btn-sm btn-primary float-end mb-2" title="Tambah Data Karyawan" data-bs-toggle="modal"
                            data-bs-target="#tambahkaryawan" onclick="setTimeout(()=>tableKaryawan(karyawan),200)">
                            <i class="fas fa-fw fa-solid fa-plus"></i> Karyawan
                        </button>
                        <button type="button" class="btn btn-sm btn-primary float-end mb-2" title="Tambah Data Pph 21" data-bs-toggle="modal"
                            data-bs-target="#tambah" @click="getDataKaryawan">
                            <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                        </button>
                    </div>

                    <!-- modal button tambah-->
                    <x-pph21sub.modalTambah :pajaks="$pajaks" />

                    <!-- modal button edit-->
                    <x-pph21sub.modaledit />

                    <x-pph21sub.modalkaryawan :karyawan="$karyawan" />
                     <!-- Modal Button import -->
                    <x-pph21sub.modalimportpph21/>

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
                let pph21 = {!! json_encode($pph21) !!}

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
                    if (confirm('Apakah anda ingin menghapus?')==true){
                        await fetch(`{{ route('pph21Destroy', '') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(res => getpph21()).catch(err => console.log(err));
                    }
                }

                /* let i = 1; */



                let rupiah = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0
                })
                var initTable = (pph21) => {
                    $('#pph21Table').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'excel', 'pdf'
                        ],
                        destroy: true,
                        data: pph21,
                        columns: [{
                                data: 'null',
                                render: (data, type, row, meta) => {
                                    return meta.row + 1
                                }
                            },

                            {
                                data: 'nama_wp'
                            },
                            {
                                data: 'jumlah_bayar',
                                render: (data) => {
                                    return rupiah.format(data)
                                }
                            },
                            {
                                data: 'bpf'
                            },
                            {
                                data: 'biaya_bulan',
                                render: (data) => {
                                    return rupiah.format(data)
                                }
                            },
                            {
                                data: 'nik',
                                render: (data) => {
                                    const findKaryawan = karyawan.find(item => item.nik === data)
                                    return /* html */ `<span>${data} - ${findKaryawan.nama}</span>`
                                }
                            },
                            {
                                data: 'id',
                                render: (data) => {
                                    return /*html*/ `<div class="button-container gap-2">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning" title="Edit Data" @click="select('${data}')"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                        @if (auth()->user()->role == 'admin')
                                                            <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="deleteData('${data}')">
                                                                <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                                            @endif

                                                </div>`
                                }
                            },
                        ]
                    })
                }

                initTable(pph21)

                const getDataKaryawan = async () => {
                    await fetch("{{ route('getKaryawan') }}", {
                        method: 'GET',
                    }).then(res => res.json()).then(res => {
                        return res
                    })
                }

                document.addEventListener('alpine:init', () => {
                    Alpine.data('formTambah', () => ({

                        formData: {
                            id_pajak: '',
                            jumlah_bayar: '',
                            bpf: '',
                            biaya_bulan: '',
                            nik: '',
                        },

                        karyawan: [],

                        getKaryawan() {
                            console.log('get karyawan')
                            fetch("{{ route('getKaryawan') }}", {
                                method: 'GET',
                            }).then(res => res.json()).then(res => {
                                console.log('get karyawan')
                                this.karyawan = res
                            })
                        },
                        handleSubmit() {
                            const data = {
                                id_pajak: this.formData.id_pajak,
                                jumlah_bayar: this.formData.jumlah_bayar.replaceAll('.', ''),
                                bpf: this.formData.bpf,
                                biaya_bulan: this.formData.biaya_bulan.replaceAll('.', ''),
                                nik: this.formData.nik,
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
                                }
                                getpph21()
                            }).catch(err => console.log(err))
                        },

                    }))


                    Alpine.data('app', () => ({
                        pajaks: {!! json_encode($pajaks) !!},
                        data: {},
                        editId: '',
                        dataKaryawan: [],
                        file: null,

                        select(id) {
                            const findData = pph21.find(item => item.id == id)
                            this.data = {
                                id: findData.id,
                                id_pajak: findData.id_pajak,
                                nama_wp: findData.nama_wp,
                                jumlah_bayar: rupiah.format(findData.jumlah_bayar),
                                bpf: findData.bpf,
                                biaya_bulan: rupiah.format(findData.biaya_bulan),
                                nik: findData.nik,
                            }
                            this.dataKaryawan = karyawan
                            /*  this.data = pph21[id] */
                        },

                        getDataKaryawan() {
                            this.dataKaryawan = karyawan
                        },

                        editSubmit() {
                            const dataSubmit = {
                                id_pajak: this.data.id_pajak,
                                nama_wp: this.data.nama_wp,
                                jumlah_bayar: Number(this.data.jumlah_bayar.replaceAll(/[.Rp_]/g, '')
                                    .trim()),
                                bpf: this.data.bpf,
                                biaya_bulan: Number(this.data.biaya_bulan.replaceAll(/[.Rp_]/g, '').trim()),
                                nik: this.data.nik,
                            }
                            fetch(`{{ route('pph21Update', '') }}/${this.data.id}`, {
                                method: 'PUT',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(dataSubmit)
                            }).then(res => {
                                $('#edit').modal('hide');
                                getpph21()
                            }).catch(err => console.log(err))
                        },

                        handleImport() {
                            let formData = new FormData();
                            formData.append('file', this.file[0]);

                            fetch("{{ route('pph21.import_excel') }}", {
                                method: 'POST',
                                headers: {
                                    /*  "Content-Type": "application/json", */
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            }).then(res => {
                                getpph21()
                                $('#importExcel').modal('hide')
                            })
                        },


                    }))
                })
            </script>
        @endpush
    </main>
@endsection

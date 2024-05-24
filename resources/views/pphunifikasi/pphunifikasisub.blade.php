@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-4" x-data="app">
            <h1 class="mt-4"> Pph Unifikasi</h1>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Data Pph Unifikasi
                    </div>
                    <div class="d-flex gap-2">
                        <!-- Button trigger modal Import-->
                        <button type="button" class="btn btn-sm btn-success" title="Import Excel" data-bs-toggle="modal"
                            data-bs-target="#importExcel">
                            <i class="fas fa-file-excel"></i> Import Excel
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary float-end" title="Tambah Data Pph Unifikasi"
                            data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                        </button>
                    </div>
                    <!-- Modal Button Tambah -->
                    <x-pphunifikasisub.modaltambahuni :pajaks="$pajaks" />
                    <!-- Modal Button edit -->
                    <x-pphunifikasisub.modaledituni />
                    <!-- Modal Button import -->
                    <x-pphunifikasisub.modalimportpphu />
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
                        <table id="pphuniTable" class="my-table responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama WP</th>
                                    <th>NTPN</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Biaya Bulan</th>
                                    <th>BPF</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        @push('script')
            <script>
                let pphunifikasi = {!! json_encode($pphunifikasi) !!}
                console.log('pphunifikasi: ', pphunifikasi)

                let i = 1;
                var getPphunifikasi = async () => {
                    await fetch("{{ route('getPphunifikasi') }}", {
                        method: 'GET',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => res.json()).then(res => {
                        i = 1
                        pphunifikasi = res.pphunifikasi
                        initTable(pphunifikasi)
                    })
                };

                var deleteData = async (id) => {
                    if (confirm('Apakah anda ingin menghapus?') == true) {
                        await fetch(`{{ route('pphunifikasiDestroy', '') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(res => getPphunifikasi()).catch(err => console.log(err));
                    }
                }

                let rupiah = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0
                })

                var initTable = (pphunifikasi) => {
                    $('#pphuniTable').DataTable({
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
                        // responsive: true,
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
                        data: pphunifikasi,
                        columns: [{
                                data: 'id_pphuni',
                                render: (data, type, row, meta) => {
                                    return meta.row + 1
                                }
                            },
                            {
                                data: 'nama_wp'
                            },
                            {
                                data: 'ntpn'
                            },
                            {
                                data: 'jumlah_bayar',
                                render: (data, type, full, meta) => {
                                    return rupiah.format(data)
                                }
                            },
                            {
                                data: 'biaya_bulan',
                                render: (data, type, full, meta) => {
                                    return rupiah.format(data)
                                }
                            },
                            {
                                data: 'bpf'
                            },
                            {
                                data: 'id_pphuni',
                                render: (data, type, full, meta) => {
                                    return /*html*/ `<div class="button-container gap-2">
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
                    })

                }

                initTable(pphunifikasi)

                document.addEventListener('alpine:init', () => {
                    Alpine.data('formTambah', () => ({
                        formData: {
                            id_pajak: '',
                            ntpn: '',
                            jumlah_bayar: '',
                            biaya_bulan: '',
                            bpf: '',
                        },

                        handleSubmit() {
                            const data = {
                                id_pajak: this.formData.id_pajak,
                                ntpn: this.formData.ntpn,
                                jumlah_bayar: this.formData.jumlah_bayar.replaceAll('.', ''),
                                biaya_bulan: this.formData.biaya_bulan.replaceAll('.', ''),
                                bpf: this.formData.bpf,
                            }
                            console.log(data)
                            console.log(this.formData)
                            fetch("{{ route('pphunifikasiStore') }}", {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(data)
                            }).then(res => {
                                $('#tambah').modal('hide');
                                this.formData = {
                                    id_pajak: '',
                                    ntpn: '',
                                    jumlah_bayar: '',
                                    biaya_bulan: '',
                                    bpf: '',
                                }
                                getPphunifikasi()
                            }).catch(err => console.log(err))
                        },

                    }))


                    Alpine.data('app', () => ({
                        //pajaks: {!! json_encode($pajaks) !!},
                        //data: [],
                        data: {},
                        editId: '',
                        file: null,

                        select(id) {
                            //this.data = pphunifikasi.filter(item => item.id_pajak == id)
                            //this.data = this.data[0]
                            const findData = pphunifikasi.find(item => item.id_pphuni == id)
                            this.data = {
                                //id: findData.id,
                                id_pphuni: findData.id_pphuni,
                                id_pajak: findData.id_pajak,
                                //nama_wp: findData.nama_wp,
                                ntpn: findData.ntpn,
                                jumlah_bayar: rupiah.format(findData.jumlah_bayar),
                                biaya_bulan: rupiah.format(findData.biaya_bulan),
                                bpf: findData.bpf,
                            }
                            //this.data = pphunifikasi[id]
                        },

                        editSubmit() {
                            const Data = {
                                id_pajak: this.data.id_pphuni,
                                //nama_wp: this.data.nama_wp,
                                ntpn: this.data.ntpn,
                                jumlah_bayar: Number(this.data.jumlah_bayar.replaceAll(/[.Rp_]/g, '')
                                    .trim()),
                                biaya_bulan: Number(this.data.biaya_bulan.replaceAll(/[.Rp_]/g, '').trim()),
                                bpf: this.data.bpf,
                            }
                            console.log(this.data.id_pphuni)
                            fetch(`{{ route('pphunifikasiUpdate', '') }}/${this.data.id_pphuni}`, {
                                method: 'PUT',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(Data)
                            }).then(res => {
                                $('#edit').modal('hide');
                                getPphunifikasi()
                            }).catch(err => console.log(err))
                        },

                        handleImport() {
                            let formData = new FormData();
                            formData.append('file', this.file[0]);

                            fetch("{{ route('pphunifikasi.import_excel') }}", {
                                method: 'POST',
                                headers: {
                                    /*  "Content-Type": "application/json", */
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            }).then(res => {
                                getPphunifikasi()
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

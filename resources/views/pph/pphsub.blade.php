@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-4" x-data="app">
            <h1 class="mt-4"> PPH </h1>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Data Pph
                    </div>

                    <div class="d-flex gap-2">
                        <!-- Button trigger modal Import-->
                        <button type="button" class="btn btn-sm btn-success" title="Import Excel" data-bs-toggle="modal"
                            data-bs-target="#importExcel">
                            <i class="fas fa-file-excel"></i>
                            <span class="d-none d-md-inline">
                                Import Excel
                            </span>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary float-end" title="Tambah Data Pph"
                            data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fas fa-fw fa-solid fa-plus"></i>
                            <span class="d-none d-md-inline">
                                Tambah
                            </span>
                        </button>
                    </div>

                    <!-- Modal Button Tambah -->
                    <x-pphsub.modaltambahpph :pajaks="$pajaks" />
                    <!-- Modal Button Edit -->
                    <x-pphsub.modaleditpph />
                    <!-- Modal Button import -->
                    <x-pphsub.modalimportpph />

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
                        <table id="pphTable" class="my-table nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama WP</th>
                                    <th>NTPN</th>
                                    <th>Biaya Bulan</th>
                                    <th>Jumlah Bayar</th>
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
                let rupiah = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0
                })

                let pph = {!! json_encode($pph) !!}
                console.log('pph: ', pph)


                let i = 1;

                var initTable = (pph) => {
                    $('#pphTable').DataTable({
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
                        data: pph,
                        columns: [{
                                data: 'id_pph',
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
                                data: 'biaya_bulan',
                                render: (data, type, full, meta) => {
                                    return rupiah.format(data)
                                }
                            },
                            {
                                data: 'jumlah_bayar',
                                render: (data, type, full, meta) => {
                                    return rupiah.format(data)
                                }
                            },

                            {
                                data: 'id_pph',
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

                initTable(pph)

                async function deleteData(id) {
                    if (confirm('Apakah anda yakin ingin menghapus data ini?') == true) {
                        await fetch(`{{ route('pphDestroy', '') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(res => getData()).catch(err => console.log(err))
                    }
                };

                async function getData() {
                    await fetch(`{{ route('getPph') }}`).then(res => res.json()).then(data => {
                        i = 1
                        initTable(data)
                    })
                }

                document.addEventListener('alpine:init', () => {
                    Alpine.data('formTambah', () => ({
                        formData: {
                            id_pajak: '',
                            ntpn: '',
                            biaya_bulan: '',
                            jumlah_bayar: '',
                        },

                        handleSubmit() {
                            const data = {
                                id_pajak: this.formData.id_pajak,
                                ntpn: this.formData.ntpn,
                                biaya_bulan: this.formData.biaya_bulan.replaceAll('.', ''),
                                jumlah_bayar: this.formData.jumlah_bayar.replaceAll('.', ''),
                            }
                            console.log(this.formData)
                            fetch("{{ route('pphStore') }}", {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(data)
                            }).then(res => {
                                $('#tambah').modal('hide');
                                console.log(res)
                                this.formData = {
                                    id_pajak: '',
                                    ntpn: '',
                                    biaya_bulan: '',
                                    jumlah_bayar: '',
                                }
                                getData()
                            }).catch(err => console.log(err))
                        },

                    }))


                    Alpine.data('app', () => ({
                        data: {},
                        editId: '',
                        file: null,

                        select(id) {
                            const findData = pph.find(item => item.id_pph == id)
                            this.data = {
                                //id: findData.id,
                                id_pph: findData.id_pph,
                                id_pajak: findData.id_pajak,
                                //nama_wp: findData.nama_wp,
                                ntpn: findData.ntpn,
                                jumlah_bayar: rupiah.format(findData.jumlah_bayar),
                                biaya_bulan: rupiah.format(findData.biaya_bulan),
                            }
                            //this.data = pph[id]
                        },

                        editSubmit() {
                            const Data = {
                                id_pajak: this.data.id_pph,
                                //nama_wp: this.data.nama_wp,
                                ntpn: this.data.ntpn,
                                biaya_bulan: Number(this.data.biaya_bulan.replaceAll(/[.Rp_]/g, '').trim()),
                                jumlah_bayar: Number(this.data.jumlah_bayar.replaceAll(/[.Rp_]/g, '')
                                    .trim()),
                            }
                            console.log(this.data.id_pph)
                            fetch(`{{ route('pphUpdate', '') }}/${this.data.id_pph}`, {
                                method: 'PUT',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(Data)
                            }).then(res => {
                                $('#edit').modal('hide');
                                getData()
                            }).catch(err => console.log(err))
                        },

                        handleImport() {
                            let formData = new FormData();
                            formData.append('file', this.file[0]);

                            fetch("{{ route('pph.import_excel') }}", {
                                method: 'POST',
                                headers: {
                                    /*  "Content-Type": "application/json", */
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            }).then(res => {
                                getData()
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

@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-0" x-data="app">
            <h5 class="mt-4 d-inline d-md-none"> Pph Unifikasi</h5>
            <h1 class="mt-4 d-none d-md-block"> Pph Unifikasi</h1>

            <div class="card mb-4 mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        <span class="d-inline d-md-none">PphU</span>
                        <span class="d-none d-md-inline">Data Pph Unifikasi</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Button trigger modal Import-->
                        <button type="button" class="btn btn-sm btn-success me-2" title="Import Excel" data-bs-toggle="modal"
                            data-bs-target="#importExcel">
                            <i class="fas fa-file-excel"></i>
                            <span class="d-none d-md-inline">Import Excel</span>
                        </button>
                        <!-- Button trigger modal Export-->
                        <button id="exportBtn" type="button" class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal"
                            data-bs-target="#exportModal">
                            <i class="fas fa-fw fa-file-export"></i>
                            <span class="d-none d-md-inline">Export</span>
                        </button>
                        <!-- Button trigger modal tambah-->
                        <button type="button" class="btn btn-sm btn-primary me-2" title="Tambah Data Pph Unifikasi"
                            data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fas fa-fw fa-solid fa-plus"></i>
                            <span class="d-none d-md-inline">Tambah</span>
                        </button>

                        <!-- Modal Button Tambah -->
                        <x-pphunifikasisub.modaltambahuni :pajaks="$pajaks" />
                        <!-- Modal Button edit -->
                        <x-pphunifikasisub.modaledituni />
                        <!-- Modal Button import -->
                        <x-pphunifikasisub.modalimportpphu />

                        <!-- Export Button -->
                        <div class="d-sm-flex">
                            <!-- Modal Export Mobile -->
                            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel">Export Data PPH Unifikasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <a href="{{ route('export.excel') }}" class="btn btn-success btn-sm">Export to Excel</a>
                                            <button class="btn btn-danger btn-sm" x-on:click="exportPDF()">Export to PDF</button>
                                            <button class="btn btn-secondary text-light btn-sm" x-on:click="copyToClipboard('#pphuniTable')">Copy Data</button>
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
                        // dom: 'Bfrtip',
                        // buttons: [
                        //     //'copy', 'excel', 'pdf'
                        //     {
                        //         extend: 'copy',
                        //         text: '<i class="fas fa-copy"> </i> Copy',
                        //         className: 'btn-sm btn-secondary', // Menambahkan kelas 'btn-success' untuk tombol Excel
                        //         titleAttr: 'Salin ke Clipboard', // Keterangan tambahan untuk tooltip
                        //     },
                        //     {
                        //         extend: 'excel',
                        //         text: '<i class="fas fa-file-excel"> </i> Excel',
                        //         className: 'btn-sm btn-success', // Menambahkan kelas 'btn-success' untuk tombol Excel
                        //         titleAttr: 'Ekspor ke Excel', // Keterangan tambahan untuk tooltip
                        //     },
                        //     {
                        //         extend: 'pdf',
                        //         text: '<i class="fas fa-file-pdf"> </i> PDF',
                        //         className: 'btn-sm btn-danger', // Menambahkan kelas 'btn-danger' untuk tombol PDF
                        //         titleAttr: 'Unduh sebagai PDF', // Keterangan tambahan untuk tooltip
                        //     }
                        // ],
                        initComplete: function () {
                            // Menambahkan event listener untuk tombol "Export Excel"
                            $('#exportExcelBtn').on('click', function (event) {
                                event.preventDefault();
                                window.location.href = '{{ route("export.excel") }}';
                            });

                            // Menambahkan event listener untuk tombol "Export PDF"
                            $('#exportPdfBtn').on('click', function (event) {
                                event.preventDefault();
                                // Tambahkan logika untuk mengarahkan ke halaman export PDF jika diperlukan
                            });
                        },
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

                        exportPDF() {
                            const element = document.getElementById('pphuniTable');
                            const { jsPDF } = window.jspdf;
                            const doc = new jsPDF();
                            doc.text('Data Pph Unifikasi', 14, 20);
                            doc.autoTable({
                                head: [['No', 'Nama', 'NTPN', 'Jumlah Bayar', 'Biaya_bulan', 'BPF']],
                                body: [...element.querySelectorAll('tbody tr')].map(row => [
                                    row.cells[0].textContent,
                                    row.cells[1].textContent,
                                    row.cells[2].textContent,
                                    row.cells[3].textContent,
                                    row.cells[4].textContent,
                                    row.cells[5].textContent
                                ]),
                                styles: {
                                    fontSize: 12,
                                    overflow: 'linebreak'
                                }
                            });
                            doc.save('pphunifikasi.pdf');

                            getPphunifikasi()
                            $('#excelModal').modal('hide')
                        },

                        copyToClipboard(selector) {
                            var element = document.querySelector(selector);

                            if (element) {
                                var range = document.createRange();
                                var selection = window.getSelection();

                                selection.removeAllRanges();

                                range.selectNodeContents(element);

                                selection.addRange(range);

                                try {
                                    document.execCommand('copy');
                                    alert('Data copied to clipboard!');
                                } catch (err) {
                                    alert('Oops, unable to copy');
                                }

                                selection.removeAllRanges();
                            } else {
                                alert('Element not found');
                            }

                            getPphunifikasi()
                            $('#excelModal').modal('hide')
                        },
                    }))
                })
            </script>
        @endpush
    </main>
@endsection

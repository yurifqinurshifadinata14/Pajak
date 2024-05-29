@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-0" x-data="app">
            <h5 class="mt-4 d-inline d-md-none"> Pph</h5>
            <h1 class="mt-4 d-none d-md-block"> Pph</h1>

            <div class="card mb-4 mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        <span class="d-inline d-md-none">Pph</span>
                        <span class="d-none d-md-inline">Data Pph</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Button trigger modal Import-->
                        <button type="button" class="btn btn-sm btn-success me-2" title="Import Excel" data-bs-toggle="modal" data-bs-target="#importExcel">
                            <i class="fas fa-file-excel"></i>
                            <span class="d-none d-md-inline">Import Excel</span>
                        </button>
                        <!-- Button trigger modal Export-->
                        <!-- <button id="exportBtn" type="button" class="btn btn-sm btn-secondary me-2 d-sm-none" data-bs-toggle="modal"
                            data-bs-target="#exportModal">
                            <i class="fas fa-fw fa-file-export"></i>
                            <span class="d-none d-md-inline">Export</span>
                        </button> -->
                        <!-- Button trigger modal Export-->
                        <button type="button" class="btn btn-sm btn-primary me-2" title="Tambah Data Pph" data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fas fa-fw fa-solid fa-plus"></i>
                            <span class="d-none d-md-inline">Tambah</span>
                        </button>

                       
                        <!-- <div class="d-sm-flex">
                            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel">Export Data PPH</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <a href="{{ route('export.excelpph') }}" class="btn btn-success btn-sm">Export to Excel</a>
                                            <button class="btn btn-danger btn-sm" x-on:click="exportPDF()">Export to PDF</button>
                                            <button class="btn btn-secondary btn-sm text-light" x-on:click="copyToClipboard('#pphTable')">Copy Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Modal Button Tambah -->
                        <x-pphsub.modaltambahpph :pajaks="$pajaks" />
                        <!-- Modal Button Edit -->
                        <x-pphsub.modaleditpph />
                        <!-- Modal Button import -->
                        <x-pphsub.modalimportpph />
                    </div>
                </div>
                <div class="card-body">
                    <style>
                        .dt-buttons {
                        display: block !important;
                        }
                        @media (max-width: 768px) {
                        
                        }
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
                        responsive:true,
                        buttons: [
                            //'copy', 'excel', 'pdf'
                            {
                                extend: 'copy',
                                text: '<i class="fas fa-copy"> </i> Copy',
                                className: 'btn-sm btn-secondary',
                                titleAttr: 'Salin ke Clipboard',
                            },
                            {
                                extend: 'excel',
                                text: '<i class="fas fa-file-excel"> </i> Excel',
                                className: 'btn-sm btn-success',
                                titleAttr: 'Ekspor ke Excel',
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="fas fa-file-pdf"> </i> PDF',
                                className: 'btn-sm btn-danger',
                                titleAttr: 'Unduh sebagai PDF',
                            }
                        ],
                        initComplete: function() {
                            // Menambahkan event listener untuk tombol "Export Excel"
                            $('#exportExcelBtn').on('click', function(event) {
                                event.preventDefault();
                                window.location.href = '{{ route("export.excelpph21") }}';
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

                        exportPDF() {
                            const element = document.getElementById('pphTable');
                            const {
                                jsPDF
                            } = window.jspdf;
                            const doc = new jsPDF();
                            doc.text('Data PPH', 14, 10);
                            doc.autoTable({
                                head: [
                                    ['No', 'Nama Wp', 'NTPN', 'Biaya Bulan', 'Jumlah Bayar']
                                ],
                                body: [...element.querySelectorAll('tbody tr')].map(row => [
                                    row.cells[0].textContent,
                                    row.cells[1].textContent,
                                    row.cells[2].textContent,
                                    row.cells[3].textContent,
                                    row.cells[4].textContent
                                ]),
                                styles: {
                                    fontSize: 12,
                                    overflow: 'linebreak'
                                }
                            });
                            doc.save('pph.pdf');
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
                        },
                    }))
                })
            </script>
        @endpush
    </main>
@endsection

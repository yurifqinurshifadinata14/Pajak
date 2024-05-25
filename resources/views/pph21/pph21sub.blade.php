@extends ('main')
@section('konten')
    <main x-data="{ pilih: '' }">
        <div class="container-fluid px-4" x-data="app">
            <h5 class="mt-4 d-inline d-md-none"> PPH21 </h5>
            <h1 class="mt-4 d-none d-md-block"> PPH21 </h1>

            <div class="card mb-4 mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        <span class="d-inline d-md-none">Pph21</span>
                        <span class="d-none d-md-inline">Data Pph21</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Button Import -->
                        <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                            data-bs-target="#importExcel">
                            <i class="fas fa-fw fa-file-excel"></i>
                            <span class="d-none d-md-inline">Import Excel</span>
                        </button>
                        <button id="exportBtn" type="button" class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal"
                            data-bs-target="#exportModal">
                            <i class="fas fa-fw fa-file-export"></i>
                            <span class="d-none d-md-inline">Export</span>
                        </button>
                        <!-- Button Tambah -->
                        <button id="tambahButton" aria-label="Tambah" class="btn btn-sm btn-primary me-2"
                            title="Tambah Data Pph 21" data-bs-toggle="modal" data-bs-target="#tambah"
                            @click="getDataKaryawan">
                            <i class="fas fa-plus"></i>
                            <span class="d-none d-md-inline">Tambah</span>
                        </button>

                        <!-- modal button tambah-->
                        <x-pph21sub.modaltambah :pajaks="$pajaks" />
                        <!-- modal button edit-->
                        <x-pph21sub.modaledit />
                        <!-- modal button karyawan-->
                        <x-pph21sub.modalkaryawan :karyawan="$karyawan" />
                        <!-- Modal Button import -->
                        <x-pph21sub.modalimportpph21 />

                        <!-- Export Button -->
                        <div class="d-sm-flex">
                            <!-- Modal Export Mobile -->
                            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel">Export Data Pph21</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="{{ route('export.excelpph21') }}" class="btn btn-success">Export to
                                                Excel</a>
                                            <button class="btn btn-danger" x-on:click="exportPDF()">Export to
                                                PDF</button>
                                            <button class="btn btn-secondary text-light" x-on:click="copyToClipboard('#pph21Table')">Copy Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <button type="button" class="btn btn-sm btn-primary float-end mb-2" title="Tambah Data Karyawan"
                            data-bs-toggle="modal" data-bs-target="#tambahkaryawan"
                            onclick="setTimeout(()=>tableKaryawan(karyawan),200)">
                            <i class="fas fa-fw fa-solid fa-plus"></i> Karyawan
                        </button> --}}
                        {{-- <button type="button" class="btn btn-sm btn-primary float-end mb-2" title="Tambah Data Pph 21"
                            data-bs-toggle="modal" data-bs-target="#tambah" @click="getDataKaryawan">
                            <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                        </button> --}}

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
                        <table id="pph21Table" class="my-table responsive" style="width: 100%">
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

                document.addEventListener('alpine:init', function() {
                    Alpine.data('app', () => ({
                        select(id) {
                            this.pilih = id;
                        }
                    }));

                    initTable(pph21);
                });
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
                    if (confirm('Apakah anda ingin menghapus?') == true) {
                        await fetch(`{{ route('pph21Destroy', '') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(res => getpph21()).catch(err => console.log(err));
                    }
                }

                let rupiah = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0
                })
                var initTable = (pph21) => {
                    $('#pph21Table').DataTable({
                        // dom: 'Bfrtip',
                        // buttons: [{
                        //         extend: 'copy',
                        //         text: '<i class="fas fa-copy"> </i> Copy',
                        //         className: 'btn-sm btn-secondary d-none d-md-block', // Menambahkan kelas 'btn-success' untuk tombol Excel
                        //         titleAttr: 'Salin ke Clipboard', // Keterangan tambahan untuk tooltip
                        //         responsive: true,
                        //         responsivePriority: 1,
                        //     },
                        //     {
                        //         extend: 'excel',
                        //         text: '<i class="fas fa-file-excel"> </i> Excel',
                        //         className: 'btn-sm btn-success d-none d-md-block', // Menambahkan kelas 'btn-success' untuk tombol Excel
                        //         titleAttr: 'Ekspor ke Excel', // Keterangan tambahan untuk tooltip
                        //         responsive: true,
                        //         responsivePriority: 2,
                        //     },
                        //     {
                        //         extend: 'pdf',
                        //         text: '<i class="fas fa-file-pdf"> </i> PDF',
                        //         className: 'btn-sm btn-danger d-none d-md-block', // Menambahkan kelas 'btn-danger' untuk tombol PDF
                        //         titleAttr: 'Unduh sebagai PDF', // Keterangan tambahan untuk tooltip
                        //         responsive: true,
                        //         responsivePriority: 3,
                        //     }
                        // ],
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
                        data: pph21,
                        columns: [{
                                data: 'id',
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

                        exportPDF() {
                            const element = document.getElementById('pph21Table');
                            const {
                                jsPDF
                            } = window.jspdf;
                            const doc = new jsPDF();
                            doc.text('Data Pph21', 14, 20);
                            doc.autoTable({
                                head: [
                                    ['No', 'Nama Wp', 'Jumlah Bayar', 'BPF', 'Biaya Bulan',
                                        'Daftar Karyawan'
                                    ]
                                ],
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
                            doc.save('pph21.pdf');
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

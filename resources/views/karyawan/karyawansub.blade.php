@extends('main')
@section('konten')
    <main x-data="karyawan">
        <div class="container-fluid px-0">
            <h5 class="d-inline d-md-none mt-4"> Data Karyawan </h5>
            <h1 class="d-none d-md-block mt-4"> Data Karyawan </h1>

            <div class="card mb-4 mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        <span class="d-inline d-md-none">Karyawan</span>
                        <span class="d-none d-md-inline">Data Karyawan</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Button trigger modal Import-->
                        <button type="button" class="btn btn-sm btn-success me-2" title="Import Excel"
                            data-bs-toggle="modal" data-bs-target="#importExcel">
                            <i class="fas fa-file-excel"></i>
                            <span class="d-none d-md-inline">Import Excel</span>
                        </button>
                        <button id="exportBtn" type="button" class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal"
                            data-bs-target="#exportModal">
                            <i class="fas fa-fw fa-file-export"></i>
                            <span class="d-none d-md-inline">Export</span>
                        </button>
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-sm btn-primary float-end me-2" title="Tambah Data Karyawan"
                            data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fas fa-fw fa-solid fa-plus"></i>
                            <span class="d-none d-md-inline">Tambah</span>
                        </button>

                        <!-- Export Button  -->
                        <div class="d-sm-flex">
                            <!-- Modal Export Mobile -->
                            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel">Export Data Karyawan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <a href="{{ route('export.excelkaryawan') }}" class="btn btn-success btn-sm">Export to
                                                Excel</a>
                                            <button class="btn btn-danger btn-sm" onclick="exportPDF()">Export to PDF</button>
                                            <button class="btn btn-secondary text-light btn-sm"
                                                onclick="copyToClipboard('#tableKaryawan')">Copy Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal button tambah-->
                    <x-karyawansub.modaltambah />
                    <!-- modal button edit-->
                    <x-karyawansub.modaledit />
                    <!-- Modal Button import -->
                    <x-karyawansub.modalimport />
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
                        <table class="my-table" id="tableKaryawan" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>NPWP</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @push('script')
<script>
    let karyawan = {!! json_encode($karyawan) !!};

                let tableKaryawan = (karyawan) => {
                    $('#tableKaryawan').DataTable({
                        // dom: 'Bfrtip',
                        // buttons: [
                        //     {
                        //         extend: 'copy',
                        //         text: '<i class="fas fa-copy"> </i> Copy',
                        //         className: 'btn-sm btn-secondary',
                        //         titleAttr: 'Salin ke Clipboard',
                        //     },
                        //     {
                        //         extend: 'excel',
                        //         text: '<i class="fas fa-file-excel"> </i> Excel',
                        //         className: 'btn-sm btn-success',
                        //         titleAttr: 'Ekspor ke Excel',
                        //     },
                        //     {
                        //         extend: 'pdf',
                        //         text: '<i class="fas fa-file-pdf"> </i> PDF',
                        //         className: 'btn-sm btn-danger',
                        //         titleAttr: 'Unduh sebagai PDF',
                        //     }
                        // ],
                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        pageLength: 10,
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
            data: karyawan,
            columns: [
                {
                    data: 'id',
                    render: (data, type, row, meta) => {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'nama',
                },
                {
                    data: 'nik'
                },
                {
                    data: 'npwp',
                },
                {
                    data: 'id',
                    render: (data) => {
                        return `<div class="button-container gap-2">
                            <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning"
                                @click="getEdit(${data})"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                            <button type="button" class="btn btn-sm btn-danger"
                                @click="handleDelete(${data})"><i class="fas fa-fw fa-solid fa-trash"></i>
                            </button>
                        </div>`;
                    }
                },
            ]
        });
    };

    tableKaryawan(karyawan);

    const getKaryawan = async () => {
        await fetch("{{ route('getKaryawan') }}", {
            method: 'GET',
        }).then(res => res.json()).then(res => {
            karyawan = res;
            tableKaryawan(karyawan);
        });
    };

    document.addEventListener('alpine:init', () => {
        Alpine.store('karyawanEdit', {
            formData: {
                id: '',
                nama: '',
                nik: '',
                npwp: ''
            }
        });

        Alpine.data('karyawan', () => ({
            file: null,
            formData: {
                id: '',
                nama: '',
                nik: '',
                npwp: ''
            },

            getEdit(id) {
                const findKaryawan = karyawan.find(item => item.id === id);
                this.formData = { ...findKaryawan };
                Alpine.store('karyawanEdit').formData = { ...findKaryawan };
            },

            handleReset() {
                this.formData = {
                    id: '',
                    nama: '',
                    nik: '',
                    npwp: ''
                };
            },

            handleSubmit() {
                fetch("{{ route('addKaryawan') }}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.formData)
                }).then(res => {
                    this.handleReset();
                    $('#tambah').modal('hide');
                    getKaryawan();
                }).catch(err => console.log(err));
            },

            handleDelete(id) {
                fetch(`{{ route('deleteKaryawan', '') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => getKaryawan()).catch(err => console.log(err));
            },

            handleImport() {
                let formData = new FormData();
                formData.append('file', this.file[0]);

                fetch("{{ route('karyawan.import_excel') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                }).then(res => {
                    getKaryawan();
                    $('#importExcel').modal('hide');
                });
            },
        }));

        Alpine.data('formEdit', () => ({
            get formData() {
                return Alpine.store('karyawanEdit').formData;
            },

            set formData(data) {
                Alpine.store('karyawanEdit').formData = data;
            },

            editSubmit() {
                fetch(`{{ route('karyawanUpdate', '') }}/${this.formData.id}`, {
                    method: 'PUT',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.formData)
                }).then(res => {
                    $('#edit').modal('hide');
                    getKaryawan();
                }).catch(err => console.log(err));
            }
        }));
    });

    function exportPDF() {
    const element = document.getElementById('tableKaryawan');
    const jsPDF = window.jspdf.jsPDF;
    const doc = new jsPDF();
    
   
    doc.text('Data Karyawan', 14, 10);
    
    doc.autoTable({
        head: [
            ['No', 'Nama', 'NIK', 'NPWP']
        ],
        body: Array.from(element.querySelectorAll('tbody tr')).map(row => [
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
    doc.save('datakaryawan.pdf');
}


    window.copyToClipboard = function(selector) {
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
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('copyToClipboardBtn').addEventListener('click', function() {
            window.copyToClipboard('#tableKaryawan');
        });
    });
</script>
@endpush

    </main>
@endsection


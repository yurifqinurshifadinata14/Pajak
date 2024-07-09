@extends('admin.main')
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
                        <select id="namaWpSelect" class="form-select me-2" style="width: 200px;">
                            <option value="">Pilih Nama WP</option>
                        </select>
                        <!-- <button type="button" class="btn btn-sm btn-success me-2" title="Import Excel"
                            data-bs-toggle="modal" data-bs-target="#importExcel">
                            <i class="fas fa-file-excel"></i>
                            <span class="d-none d-md-inline">Import Excel</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary float-end me-2" title="Tambah Data Karyawan"
                            data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fas fa-fw fa-solid fa-plus"></i>
                            <span class="d-none d-md-inline">Tambah</span>
                        </button> -->
                    </div>

                    <!-- modal button tambah-->
                    <!-- modal button edit-->
                    <x-karyawansub.modaledit />
                    <!-- Modal Button import -->
                    <x-karyawansub.modalimport />
                </div>
                <div class="card-body">
                    <style>
                        /* CSS untuk mode mobile */
                        @media (max-width: 767px) {
                            .mobile-top-left {
                                position: absolute;
                                top: 0;
                                left: 0;
                                z-index: 1000;
                            }
                        }

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
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> Copy',
                className: 'btn-sm btn-secondary',
                titleAttr: 'Salin ke Clipboard',
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn-sm btn-success',
                titleAttr: 'Ekspor ke Excel',
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn-sm btn-danger',
                titleAttr: 'Unduh sebagai PDF',
            }
        ],
        initComplete: function () {
            // Menerapkan perubahan CSS untuk mode mobile
            if ($(window).width() < 768) {
                $('.dt-buttons').addClass('mobile-top-left');
            }
        },
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
                        return /*html*/ `<div class="button-container gap-2">
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
                id_pajak:'',
                nama: '',
                nik: '',
                npwp: ''
            }
        });

        Alpine.data('karyawan', () => ({
            file: null,
            formData: {
                id: '',
                id_pajak:'',
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
                    id_pajak:'',
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

            init() {
                    this.initNamaWpSelect();
                },

                initNamaWpSelect() {
                        // Mengumpulkan nama_wp yang unik
                        const uniqueNamaWp = [...new Set(karyawan.map(item => item.nama_wp))];

                        // select dropdown dengan data nama_wp yang unik
                        const selectElement = document.getElementById('namaWpSelect');
                        selectElement.innerHTML = '<option value="">Pilih Nama WP</option>';

                        uniqueNamaWp.forEach(nama_wp => {
                            const option = document.createElement('option');
                            option.value = nama_wp;
                            option.textContent = nama_wp;
                            selectElement.appendChild(option);
                        });

                        // Tambahkan event listener untuk pencarian langsung
                        selectElement.addEventListener('change', (event) => {
                            const selectedNamaWp = event.target.value;
                            const table = $('#tableKaryawan').DataTable();
                            table.columns(1).search(selectedNamaWp).draw();
                        });
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


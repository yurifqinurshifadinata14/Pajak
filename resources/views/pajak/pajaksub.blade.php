@extends('admin.main')
@section('konten')
<main x-data="{ pilih: '' }">
    <div class="container-fluid px-0" x-data="app">
        <h5 class="mt-4 d-inline d-md-none"> Data Diri</h5>
        <h1 class="mt-4 d-none d-md-block"> Data Diri </h1>

        <div class="card mb-4 mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    <span class="d-inline d-md-none">Pembayar</span>
                    <span class="d-none d-md-inline">Data Diri Pembayar</span>
                </div>

                <div class="d-flex align-items-center">
                     <!-- Button trigger modal Import-->
                    <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                        data-bs-target="#importExcel">
                        <i class="fas fa-fw fa-file-excel"></i>
                        <span class="d-none d-md-inline">Import Excel</span>
                    </button>

                    <!-- Button trigger modal tambah-->
                    <button type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <i class="fas fa-fw fa-solid fa-plus"></i>
                        <span class="d-none d-md-inline">Tambah</span>
                    </button>

                    <select id="namaWpSelect" class="form-select me-2" style="width: 200px;">
                        <option value="">Pilih Nama WP</option>
                    </select>

                    <!-- Modal Button Tambah -->
                    <x-pajaksub.modaltambah />
                    <!-- Modal Button Edit -->
                    <x-pajaksub.modaledit />
                    <!-- Modal Button Import -->
                   <x-pajaksub.modalimportpajak />

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
                    <table id="pajakTable" class="my-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
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
        let pajak = {!! json_encode($pajak) !!};

        var getPajak = async () => {
            await fetch("{{ route('getpajaksub') }}", {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(res => res.json()).then(res => {
                console.log('get pajak')
                i = 1
                pajak = res.pajak
                initTable(pajak)
            }).catch(err=>{
                console.log('get pajak error:')
                console.log(err)
            })
        };

        var deleteData = async (id) => {
            if (confirm('Apakah anda ingin menghapus?') == true) {
                await fetch(`{{ route('pajakDestroy', '') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => getPajak()).catch(err => console.log(err));
            }
        }

        let i = 1;

        var initTable = (pajak) => {
            $('#pajakTable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [{
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
                initComplete: function () {
                    $('#exportExcelBtn').on('click', function (event) {
                        event.preventDefault();
                        window.location.href = '{{ route("export.excelpajak") }}';
                    });
                },
                responsive: {
                    details: {
                        renderer: (api, rowIdx, columns) => {
                            let data = columns
                                .map((col, i) => {
                                    return col.hidden ?
                                        `<tr data-dt-row="${col.rowIndex}" data-dt-column="${i}">
                                            <th>${col.title}</th>
                                            <td style="width: 100%;">${col.data}</td>
                                        </tr>`
                                    : ``;
                                })
                                .join('');

                            let table = document.createElement('table');
                            table.innerHTML = data;

                            return data ? table : false;
                        }
                    }
                },
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
                            return /*html*/ `<div class="button-container gap-2">
                                        <a class="btn btn-sm btn-info" title="Detail Jenis & Status" href="{{ route('pajak.Detail', '') }}/${data}" ><i class="fas fa-fw fa-solid fa-search"></i></a>
                                        <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning" title="Edit Data" @click="select('${data}')">
                                            <i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                        
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="deleteData('${data}')">
                                            <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                      
                                    </div>`
                        }
                    },
                ]
            }).cells(null, 0, {
                search: 'applied',
                order: 'applied'
                })
                .every(function (cell) {
                    this.data(i++);
                });
        }

        initTable(pajak)

        document.addEventListener('alpine:init', () => {
            Alpine.data('formTambah', () => ({
                formData: {
                    nama_wp: '',
                    jenis: 'Pribadi',
                    status: 'Non PKP',
                    npwp: '',
                    no_hp: '',
                    no_efin: '',
                    gmail: '',
                    nik: '',
                    alamat: '',
                    merk_dagang: '',
                },
                showJenis: false,
                showStatus: false,

                handleSubmit() {
                    console.log(this.formData)
                    fetch("{{ route('pajakStore') }}", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then(res => {
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
                        };
                        getPajak(); // Panggil fungsi getPajak untuk memperbarui data yang ditampilkan
                    })
                    .catch(err => console.log('Error:', err));
                }

            }))


            Alpine.data('app', () => ({
                data: [],
                editId: '',

                file: null,
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
                handleImport() {
                    let formData = new FormData();
                    formData.append('file', this.file[0]);

                    fetch("{{ route('pajak.import_excel') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    }).then(res => {
                        getPajak()
                        $('#importExcel').modal('hide')
                    })
                },
                init() {
                    console.log('data:', this.data)
                    this.initNamaWpSelect();
                },

                 initNamaWpSelect() {
                        // Mengumpulkan nama_wp yang unik
                        const uniqueNamaWp = [...new Set(pajak.map(item => item.nama_wp))];

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
                            const table = $('#pajakTable').DataTable();
                            table.columns(1).search(selectedNamaWp).draw();
                        });
                    },

                exportPDF() {
                const element = document.getElementById('pajakTable');
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                doc.text('Data Pajak', 14, 10);
                doc.autoTable({
                    head: [['No', 'Nama', 'Jenis WP', 'Status WP', 'NPWP', 'No Hp', 'No EFIN', 'Gmail', 'NIK', 'Alamat', 'Merk Dagang']],
                    body: [...element.querySelectorAll('tbody tr')].map(row => [
                        row.cells[0].textContent,
                        row.cells[1].textContent,
                        row.cells[2].textContent,
                        row.cells[3].textContent,
                        row.cells[4].textContent,
                        row.cells[5].textContent,
                        row.cells[6].textContent,
                        row.cells[7].textContent,
                        row.cells[8].textContent,
                        row.cells[9].textContent,
                        row.cells[10].textContent
                    ]),
                    styles: {
                        fontSize: 8,
                        overflow: 'linebreak'
                    }
                });
                doc.save('pajak.pdf');
            },

            copyToClipboard(selector) {
                var element = document.querySelector(selector);

                if (element) {
                    var range = document.createRange();
                    var selection = window.getSelection();

                    range.selectNodeContents(element);
                    selection.removeAllRanges();
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

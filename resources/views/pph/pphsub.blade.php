@extends ('admin.main')
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
                         <select id="namaWpSelect" class="form-select me-2" style="width: 200px;">
                            <option value="">Pilih Nama WP</option>
                        </select>
                        <!-- Modal Button Edit -->
                        <x-pphsub.modaleditpph />
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
                                    <!-- <th>Aksi</th> -->
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
        });

        let pph = {!! json_encode($pph) !!}
        console.log('pph: ', pph);

        let i = 1;

        var initTable = (pph) => {
            if ($.fn.DataTable.isDataTable('#pphTable')) {
                $('#pphTable').DataTable().destroy();
            }

            $('#pphTable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
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
                            return meta.row + 1;
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
                            return rupiah.format(data);
                        }
                    },
                    {
                        data: 'jumlah_bayar',
                        render: (data, type, full, meta) => {
                            return rupiah.format(data);
                        }
                    },
                    // {
                    //     data: 'id_pph',
                    //     render: (data, type, full, meta) => {
                    //         return /*html*/ `<div class="button-container gap-2">
                    //             <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning" title="Edit Data" @click="select('${data}')">
                    //                 <i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                
                    //                             <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="deleteData('${data}')">
                    //                                 <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                                
                    //         </div>`;
                    //     }
                    // },
                ]
            });
        }

        initTable(pph);

        async function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?') == true) {
                await fetch(`{{ route('pphDestroy', '') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => getData()).catch(err => console.log(err));
            }
        };

        async function getData() {
            await fetch(`{{ route('getPph') }}`).then(res => res.json()).then(data => {
                i = 1;
                initTable(data);
            });
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
                    };
                    console.log(this.formData);
                    fetch("{{ route('pphStore') }}", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    }).then(res => {
                        $('#tambah').modal('hide');
                        console.log(res);
                        this.formData = {
                            id_pajak: '',
                            ntpn: '',
                            biaya_bulan: '',
                            jumlah_bayar: '',
                        };
                        getData();
                    }).catch(err => console.log(err));
                },

            }));

            Alpine.data('app', () => ({
                data: {},
                editId: '',
                file: null,

                select(id) {
                    const findData = pph.find(item => item.id_pph == id);
                    this.data = {
                        id_pph: findData.id_pph,
                        id_pajak: findData.id_pajak,
                        ntpn: findData.ntpn,
                        jumlah_bayar: rupiah.format(findData.jumlah_bayar),
                        biaya_bulan: rupiah.format(findData.biaya_bulan),
                    };
                },

                editSubmit() {
                    const data = {
                        id_pajak: this.data.id_pajak,
                        ntpn: this.data.ntpn,
                        biaya_bulan: this.data.biaya_bulan.replaceAll('.', ''),
                        jumlah_bayar: this.data.jumlah_bayar.replaceAll('.', ''),
                    };

                    fetch(`{{ route('pphUpdate', '') }}/${this.data.id_pph}`, {
                        method: 'PUT',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    }).then(res => {
                        $('#edit').modal('hide');
                        getData();
                    }).catch(err => console.log(err));
                },

                init() {
                    this.initNamaWpSelect();
                },

                initNamaWpSelect() {
                        // Mengumpulkan nama_wp yang unik
                        const uniqueNamaWp = [...new Set(pph.map(item => item.nama_wp))];

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
                            const table = $('#pphTable').DataTable();
                            table.columns(1).search(selectedNamaWp).draw();
                        });
                    }

            }));
        });
    </script>
@endpush

    </main>
@endsection

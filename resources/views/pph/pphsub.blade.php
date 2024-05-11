@extends ('main')
@section('konten')
    <main>
        <div class="container-fluid px-4" x-data="app">
            <h1 class="mt-4"> PPH </h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    PPH Rekap

                    <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#tambah">
                        <i class="fas fa-fw fa-solid fa-plus"></i> Tambah </button>

                    <!-- Modal Button Tambah -->
                    <x-pphsub.modalTambahpph :pajaks="$pajaks" />

                    <x-pphsub.modaleditpph  />

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
                    <table id="pphTable" class="my-table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
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

        @push('script')
            <script>
                let pph = {!! json_encode($pph) !!}
                console.log('pph: ',pph)

                
                let i = 1;

                var initTable = (pph) => {
                    $('#pphTable').DataTable({
                            destroy: true,
                            data: pph,
                            columns: [{
                                    data: 'id'
                                },
                                {
                                    data: 'nama_wp'
                                },
                                {
                                    data: 'ntpn'
                                },
                                {
                                    data: 'biaya_bulan'
                                },
                                {
                                    data: 'jumlah_bayar'
                                },

                                {
                                    data: 'id_pph',
                                    render: ( data, type, full, meta) => {
                                        return /*html*/ `<div class="button-container">
                                        <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning"  @click="select('${meta.row}')">
                                            <i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteData('${data}')">
                                        <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                    </div>`
                                    }
                                },
                            ]
                        }).cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });;
                }

                initTable(pph)

                async function deleteData(id){
                    if (confirm('Apakah anda yakin ingin menghapus data ini?')==true){
                        await fetch(`{{ route('pphDestroy','') }}/${id}`,{
                            method:'DELETE',
                            headers:{
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(res => getData()).catch(err => console.log(err))
                    }
                };

                async function getData(){
                   await fetch(`{{ route('getPph') }}`).then(res => res.json()).then(data => {
                    i=1
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
                            console.log(this.formData)
                            fetch("{{ route('pphStore') }}", {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(this.formData)
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
                        data: [],
                        editId: '',
                        select(id) {
                            this.data = pph[id]
                        },

                        editSubmit() {
                            console.log(this.data)
                            fetch(`{{ route('pphUpdate', '') }}/${this.data.id_pph}`, {
                                method: 'PUT',
                                headers: {
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(this.data)
                            }).then(res => {
                                $('#edit').modal('hide');
                                getData()
                            }).catch(err => console.log(err))
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
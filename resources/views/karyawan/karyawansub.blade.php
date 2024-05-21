@extends('main')
@section('konten')
<main x-data="karyawan">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Karyawan</h1>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Data Karyawan
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-primary float-end" title="Tambah Data Karyawan"
                        data-bs-toggle="modal" data-bs-target="#tambah">
                        <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                    </button>
                </div>

                <x-karyawansub.modaltambah />
                <x-karyawansub.modaledit />
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
                    <table class="my-table" id="tableKaryawan">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>NPWP</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        let karyawan = {!! json_encode($karyawan) !!}

        let tableKaryawan = (karyawan) => {
            $('#tableKaryawan').DataTable({
                destroy: true,
                data: karyawan,
                columns: [{
                        data: 'null',
                        render: (data, type, row, meta) => {
                            return meta.row + 1
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
                            return /*html*/`<div class="button-container">
                                <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning"
                                    @click="getEdit(${data})"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                <button type="button" class="btn btn-sm btn-danger"
                                    @click="handleDelete(${data})"><i class="fas fa-fw fa-solid fa-trash"></i>
                                </button>
                            </div>`
                        }
                    },
                ]
            })
        }

        tableKaryawan(karyawan)

        const getKaryawan = async () => {
            await fetch("{{ route('getKaryawan') }}", {
                method: 'GET',
            }).then(res => res.json()).then(res => {
                karyawan = res
                tableKaryawan(karyawan)
            })
        }

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
                formData: {
                    id: '',
                    nama: '',
                    nik: '',
                    npwp: ''
                },

                getEdit(id) {
                    const findKaryawan = karyawan.find(item => item.id === id)
                    this.formData = {...findKaryawan}
                    Alpine.store('karyawanEdit').formData = {...findKaryawan}
                },

                handleReset() {
                    this.formData = {
                        id: '',
                        nama: '',
                        nik: '',
                        npwp: ''
                    }
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
                        this.handleReset()
                        $('#tambah').modal('hide');
                        getKaryawan()
                    }).catch(err => console.log(err));
                },

                handleDelete(id) {
                    fetch(`{{ route('deleteKaryawan', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => getKaryawan()).catch(err => console.log(err))
                }
            }))

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
        })
    </script>
    @endpush
</main>
@endsection

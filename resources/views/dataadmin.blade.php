@extends('main')

@section('konten')
<main x-data="{ pilih: '' }">
    <div class="container-fluid px-4" x-data="app">
        <h1 class="mt-4"> DATA ADMIN </h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Admin Rekap

                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#tambah">
                    <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                </button>

                <!-- Modal Button Tambah -->
                <x-dataadmin.modaltambahdataadmin />

                <!-- Modal Button Edit -->
                <x-dataadmin.modaleditdataadmin />

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
                <table id="dataadminTable" class="my-table">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataadmins as $dataadmin)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Incremental number -->
                            <td>{{ $dataadmin->name }}</td>
                            <td>{{ $dataadmin->email }}</td>
                            <td>{{ $dataadmin->password }}</td>

                            <td>{{ $dataadmin->role }}</td>
                            <td>
                                <!-- Buttons for actions -->
                                <div class="button-container">
                                    {{-- <a data-bs-toggle="modal" data-bs-target="#edit{{ $dataadmin->id }}" class="btn
                                    btn-sm btn-warning"
                                    @click="select('{{ $dataadmin->id }}')">
                                    <i class="fas fa-fw fa-solid fa-pen"></i>
                                    </a> --}}

                                    <a href="#edit{{$dataadmin->id}}" type="button"
                                        class="btn btn-warning float-end ms-2" data-toggle="modal"
                                        data-target="#edit{{$dataadmin->id}}">
                                        <i class="fas fa-fw fa-solid fa-pen"></i></a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit{{ $dataadmin->id }}" tabindex="-1"
                                        aria-labelledby="edit{{ $dataadmin->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edit{{ $dataadmin->id }}Label">Edit Data
                                                        Admin</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/dataadminUpdate/{{ $dataadmin->id }}" method="POST">
                                                        <!-- Fix action route and method -->
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Use PUT method -->
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-user"
                                                                id="examplenama" placeholder="Name" name="name"
                                                                value="{{ $dataadmin->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" class="form-control form-control-user"
                                                                id="exampleInputEmail" placeholder="Email" name="email"
                                                                value="{{ $dataadmin->email }}">
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                <input type="password"
                                                                    class="form-control form-control-user"
                                                                    id="exampleInputPassword" placeholder="Password"
                                                                    name="password"  value="{{ $dataadmin->password }}">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="password"
                                                                    class="form-control form-control-user"
                                                                    id="exampleRepeatPassword"
                                                                    placeholder="Repeat Password"
                                                                    name="password_confirmation"  value="{{ $dataadmin->password }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <select name="role" id="exampleInputRole"
                                                                class="form-select">
                                                                <option value="" disabled>Pilih Role</option>
                                                                <option value="admin"
                                                                    {{ $dataadmin->role == 'admin' ? 'selected' : '' }}>
                                                                    Admin</option>
                                                                <option value="staff"
                                                                    {{ $dataadmin->role == 'staff' ? 'selected' : '' }}>
                                                                    Staff</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    &nbsp;&nbsp;


                                    <a href="/dataadminDelete/{{$dataadmin->id}}" class="btn btn-danger "
                                        onclick="return confirm('Yakin ingin menghapus data ?')"><i
                                            class="fa fa-trash"></i></a>


                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('formTambah', () => ({
                formData: {
                    id_pajak: '',
                    nama: '',
                    email: '',
                    pw: '',
                    repeat_pw: '',
                    role: '',
                },

                handleSubmit() {
                    console.log(this.formData);
                    fetch("{{ route('dataadmin') }}", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.formData)
                    }).then(res => {
                        $('#tambah').modal('hide');
                        console.log(res);
                        this.formData = {
                            id_dataadmin: '',
                            nama: '',
                            email: '',
                            pw: '',
                            repeat_pw: '',
                            role: '',
                        };
                        $('#tambah').on('hidden.bs.modal', function () {
                            Alpine.store('formTambah').formData = {
                                id_pajak: '',
                                nama: '',
                                email: '',
                                pw: '',
                                repeat_pw: '',
                                role: '',
                            };
                        });
                        getData();
                    }).catch(err => console.log(err));
                },

            }));

            Alpine.data('app', () => ({
                data: {},
                select(id) {
                    const findData = dataadmin.find(item => item.id_dataadmin == id);
                    this.data = {
                        id_dataadmin: findData.id_dataadmin,
                        nama: findData.nama,
                        email: findData.email,
                        pw: findData.pw,
                        repeat_pw: findData.repeat_pw,
                        role: findData.role,
                    };
                },

                // editSubmit() {
                //     console.log(this.data.id_dataadmin);
                //     fetch("{{ url('/dataadminUpdate/') }}/${this.data.id_dataadmin}", { 
                //         method: 'PUT',
                //         headers: {
                //             "Content-Type": "application/json",
                //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                //         },
                //         body: JSON.stringify(this.data)
                //     }).then(res => {
                //         $('#edit').modal('hide');
                //         getData();
                //     }).catch(err => console.log(err));
                // },

                init() {
                    console.log('data:', this.data);
                },
            }));
        });

    </script>

    @endpush
</main>
@endsection

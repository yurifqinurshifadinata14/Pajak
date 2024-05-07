@extends('main')
@section('konten')
    <main>
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Pajak</h1>
            <p class="mb-4">Jenis
                <a target="_blank" href="/pajaksub"> Pajak</a>.
            </p>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Jenis Pajak</h6>
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
                    <table id="datatables" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th>NPWP</th>
                                <th>Saham</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis as $j)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $j->jenis }}</td>
                                    <td>{{ $j->alamatBadan }}</td>
                                    <td>{{ $j->jabatan }}</td>
                                    <td>{{ $j->npwpBadan }}</td>
                                    <td>{{ $j->saham }}</td>
                                    <td>
                                        {{-- <div class="button-container">
                                            <a href="{{ route('jenisEdit', $j->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                            <form method="POST" action="{{ route('pajakDestroy', $j->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin mau hapus???')"><i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                            </form>
                                        </div> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <h1 class="mt-4">Status Pajak</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Status Pajak
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
                    <table id="datatablesSimple" class="my-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>ENoFA Password</th>
                                <th>Passphrase Password</th>
                                <th>User E-Faktur</th>
                                <th>Password Efaktur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pajak as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->status }}</td>
                                    <td>{{ $s->enofa_password }}</td>
                                    <td>{{ $s->passphrese }}</td>
                                    <td>{{ $s->user_efaktur }}</td>
                                    <td>{{ $s->password_efaktur }}</td>
                                    <td>
                                        {{-- <a href="/hapus/{{ $j->id }}"class="btn btn-sm btn-danger"><i class="fas fa-fw fa-solid fa-trash"></i></a> --}}
                                        {{-- <a href="{{ route('statusEdit', $s->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-solid fa-pen"></i> </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

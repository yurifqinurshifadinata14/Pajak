@extends ('main')
@section('konten')
    <main>
        <div class="container-fluid px-4">
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
                    <table  id="datatablesSimple" class="my-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>ENoFA Password</th>
                                <th>Passphrase Password</th>
                                <th>User E-Faktur</th>
                                <th>Password Efaktur</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($status as $s)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$s->status }}</td>
                                    <td>{{$s->enofa_password}}</td>
                                    <td>{{$s->passphrese }}</td>
                                    <td>{{$s->user_efaktur }}</td>
                                    <td>{{$s->password_efaktur}}</td>
                                    <td>
                                        {{-- <a href="/hapus/{{ $j->id }}"class="btn btn-sm btn-danger"><i class="fas fa-fw fa-solid fa-trash"></i></a> --}}
                                        {{-- <a href="{{ route('statusEdit', $s->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-solid fa-pen"></i> </a>                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

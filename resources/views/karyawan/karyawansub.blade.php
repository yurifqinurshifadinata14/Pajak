@extends ('main')
@section('konten')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Karyawan</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Karyawan
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
                                <th>NIK</th>
                                <th>NPWP</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($karyawan as $k)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$k->nik}}</td>
                                    <td>{{$k->npwp}}</td>>
                                    <td>
                                    <div class="button-container">
                                        <a href="{{route('', $k->id)}}" class="btn btn-sm btn-warning"><i
                                            class="fas fa-fw fa-solid fa-pen"></i> </a>
                                        <form method="POST" action="{{route('karyawanDestroy', $k->id)}}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin mau hapus???')"><i
                                                class="fas fa-fw fa-solid fa-trash"></i> </button>
                                    </form>

                                    </div>
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

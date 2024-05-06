@extends ('main')
@section('konten')
    <main>

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Jenis Pajak</h1>
            <p class="mb-4">Jenis
                <a target="_blank" href="https://datatables.net"> Pajak</a>.
            </p>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Jenis Pajak
                        {{-- <a href="/jenis" class="btn btn-sm btn-primary float-end"><i class="fas fa-fw fa-solid fa-plus"></i> Tambah</a> --}}
                    </h6>
                </div>
                <div class="card-body">
                    {{-- <style>
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
                    </style> --}}
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
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$j->jenis}}</td>
                                    <td>{{$j->alamatBadan}}</td>
                                    <td>{{$j->jabatan}}</td>
                                    <td>{{$j->npwpBadan}}</td>
                                    <td>{{$j->saham}}</td>
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

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

        </div>

    </main>
@endsection


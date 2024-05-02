@extends ('main')
@section('konten')
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4"> Data Diri</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Diri Pembayar
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
                        <th>Nomor</th>
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
                <tbody>
                    @foreach ($pajak as $p )
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $p->nama_wp }}</td>
                        {{-- <td>{{ $p->jenis_wp }}</td>
                        <td>{{ $p->status_wp }}</td> --}}
                        <td>{{ $p->npwp }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->no_efin }}</td>
                        <td>{{ $p->gmail }}</td>
                        <td>{{ $p->nik }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->merk_dagang }}</td>
                        <td>
                            <div class="button-container">
                                <a href="{{route('pajakEdit', $p->id)}}" class="btn btn-sm btn-warning"><i
                                    class="fas fa-fw fa-solid fa-pen"></i> </a>
                            <form method="POST" action="{{route('pajakDestroy', $p->id)}}"
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

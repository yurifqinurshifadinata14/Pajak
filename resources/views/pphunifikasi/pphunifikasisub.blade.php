@extends ('main')
@section('konten')
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4"> Data Pph Unifikasi</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Pph Unifikasi
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
                        <th>NTPN</th>
                        <th>Jumlah Bayar</th>
                        <th>Biaya Bulan</th>
                        <th>BPF</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pphunifikasi as $pphuni )
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $pphuni->ntpn }}</td>
                        <td>{{ $pphuni->jumlah_bayar }}</td>
                        <td>{{ $pphuni->biaya_bulan }}</td>
                        <td>{{ $pphuni->bpf }}</td>
                        <td>
                            <div class="button-container">
                                <a href="{{route('pphunifikasiEdit', $pphuni->id)}}" class="btn btn-sm btn-warning"><i
                                    class="fas fa-fw fa-solid fa-pen"></i> </a>
                            <form method="POST" action="{{route('pphunifikasiDestroy', $pphuni->id)}}"
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

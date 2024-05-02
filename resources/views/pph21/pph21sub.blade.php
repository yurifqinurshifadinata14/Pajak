@extends ('main')
@section('konten')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">PPH21</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    PPH21
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
                                <th>Jumlah Bayar</th>
                                <th>BPF</th>
                                <th>Biaya Bulan</th>
                                <th>Daftar Karyawan</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($pph21 as $p)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$p->jumlah_bayar}}</td>
                                    <td>{{$p->bpf}}</td>
                                    <td>{{$p->biaya_bulan}}</td>
                                    <td>{{$p->daftar_karyawan}}</td>
                                    <td>
                                    <div class="button-container">
                                        <a href="{{route('pph21Edit', $p->id)}}" class="btn btn-sm btn-warning"><i
                                            class="fas fa-fw fa-solid fa-pen"></i> </a>
                                        <form method="POST" action="{{route('pph21Destroy', $p->id)}}"
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
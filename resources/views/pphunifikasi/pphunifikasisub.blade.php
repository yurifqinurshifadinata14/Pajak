@extends ('main')
@section('konten')
<main x-data="{ pilih: '' }">
    <div class="container-fluid px-4" x-data="app">
        <h1 class="mt-4"> Data Pph Unifikasi</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Pph Unifikasi
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="fas fa-fw fa-solid fa-plus"></i> Tambah
                </button>
                <!-- Modal Button Tambah -->
                <x-pphunifikasisub.modalTambahuni :pajaks="$pajaks"/>
                <!-- Modal Button edit -->
                <x-pphunifikasisub.modaledituni />
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
                    <table id="pphuniTable" class="my-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama WP</th>
                                <th>NTPN</th>
                                <th>Jumlah Bayar</th>
                                <th>Biaya Bulan</th>
                                <th>BPF</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
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
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            let pphunifikasi = {!! json_encode($pphunifikasi) !!}
            console.log('pphunifikasi: ',pphunifikasi)

            let i = 1;
            var getPphunifikasi = async () => {
                await fetch("{{ route('getPphunifikasi') }}", {
                    method: 'GET',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => res.json()).then(res => {
                    i = 1
                    pphunifikasi = res.pphunifikasi
                    initTable(pphunifikasi)
                })
            };

            var deleteData = async (id) => {
                if (confirm('Apakah anda ingin menghapus?')==true){
                    await fetch(`{{ route('pphunifikasiDestroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => getPphunifikasi()).catch(err => console.log(err));
                }
            }

            var initTable = (pphunifikasi) => {
                $('#pphuniTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'excel', 'pdf'
                        ],
                        destroy: true,
                        data: pphunifikasi,
                        columns: [
                            {
                                data: 'id'
                            },
                            {
                                data: 'nama_wp'
                            },
                            {
                                data: 'ntpn'
                            },
                            {
                                data: 'jumlah_bayar'
                            },
                            {
                                data: 'biaya_bulan'
                            },
                            {
                                data: 'bpf'
                            },
                            {
                                data: 'id_pphuni',
                                render: (data, type, full, meta) => {
                                    return /*html*/ `<div class="button-container">
                                                        <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning"  @click="select('${meta.row}')">
                                                            <i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                            @if (auth()->user()->role == 'admin')
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteData('${data}')">
                                                            <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                                        @endif
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

            initTable(pphunifikasi)

            document.addEventListener('alpine:init', () => {
                Alpine.data('formTambah', () => ({
                    formData: {
                        id_pajak: '',
                        ntpn: '',
                        jumlah_bayar: '',
                        biaya_bulan: '',
                        bpf: '',
                    },

                    handleSubmit() {
                        console.log(this.formData)
                        fetch("{{ route('pphunifikasiStore') }}", {
                            method: 'POST',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.formData)
                        }).then(res => {
                            $('#tambah').modal('hide');
                            this.formData = {
                                id_pajak: '',
                                ntpn: '',
                                jumlah_bayar: '',
                                biaya_bulan: '',
                                bpf: '',
                            }
                            getPphunifikasi()
                        }).catch(err => console.log(err))
                    },

                }))


                Alpine.data('app', () => ({
                    data: [],
                    editId: '',
                    select(id) {
                        //this.data = pphunifikasi.filter(item => item.id_pajak == id)
                        //this.data = this.data[0]
                        this.data = pphunifikasi[id]
                    },

                    editSubmit() {
                        console.log(this.data)
                        fetch(`{{ route('pphunifikasiUpdate', '') }}/${this.data.id_pphuni}`, {
                            method: 'PUT',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.data)
                        }).then(res => {
                            $('#edit').modal('hide');
                            getPphunifikasi()
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

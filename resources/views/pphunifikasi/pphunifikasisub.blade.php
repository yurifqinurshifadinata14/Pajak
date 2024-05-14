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

            let rupiah = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            })

            var initTable = (pphunifikasi) => {
                $('#pphuniTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            //'copy', 'excel', 'pdf'
                            {
                                extend: 'copy'
                            },
                            {
                                extend: 'excel',
                                className: 'btn-success' // Menambahkan kelas 'btn-success' untuk tombol Excel
                            },
                            {
                                extend: 'pdf',
                                className: 'btn-danger' // Menambahkan kelas 'btn-danger' untuk tombol PDF
                            }
                        ],
                        destroy: true,
                        data: pphunifikasi,
                        columns: [
                            {
                                data: 'null',
                                render:(data,type,row,meta)=>{
                                    return meta.row+1
                                }
                            },
                            {
                                data: 'nama_wp'
                            },
                            {
                                data: 'ntpn'
                            },
                            {
                                data: 'jumlah_bayar',
                                render: ( data, type, full, meta) => {
                                    return rupiah.format(data)
                                }
                            },
                            {
                                data: 'biaya_bulan',
                                render: ( data, type, full, meta) => {
                                    return rupiah.format(data)
                                }
                            },
                            {
                                data: 'bpf'
                            },
                            {
                                data: 'id_pphuni',
                                render: (data, type, full, meta) => {
                                    return /*html*/ `<div class="button-container">
                                                        <a data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-sm btn-warning"  @click="select('${data}')">
                                                            <i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                            @if (auth()->user()->role == 'admin')
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteData('${data}')">
                                                            <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                                        @endif
                                                    </div>`

                                }
                            },
                        ]
                    })

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
                        const data ={
                            id_pajak: this.formData.id_pajak,
                            ntpn: this.formData.ntpn,
                            jumlah_bayar: this.formData.jumlah_bayar.replaceAll('.', ''),
                            biaya_bulan: this.formData.biaya_bulan.replaceAll('.', ''),
                            bpf: this.formData.bpf,
                        }
                        //console.log(data)
                        console.log(this.formData)
                        fetch("{{ route('pphunifikasiStore') }}", {
                            method: 'POST',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
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
                    //pajaks: {!! json_encode($pajaks) !!},
                    //data: [],
                    data: {},
                    editId: '',
                    select(id) {
                        //this.data = pphunifikasi.filter(item => item.id_pajak == id)
                        //this.data = this.data[0]
                        const findData = pphunifikasi.find(item => item.id_pphuni == id)
                            this.data = {
                                //id: findData.id,
                                id_pphuni:findData.id_pphuni,
                                id_pajak: findData.id_pajak,
                                //nama_wp: findData.nama_wp,
                                ntpn: findData.ntpn,
                                jumlah_bayar: rupiah.format(findData.jumlah_bayar),
                                biaya_bulan: rupiah.format(findData.biaya_bulan),
                                bpf: findData.bpf,
                            }
                        //this.data = pphunifikasi[id]
                    },

                    editSubmit() {
                        const Data = {
                            id_pajak: this.data.id_pphuni,
                            //nama_wp: this.data.nama_wp,
                            ntpn: this.data.ntpn,
                            jumlah_bayar: Number(this.data.jumlah_bayar.replaceAll(/[.Rp_]/g, '').trim()),
                            biaya_bulan: Number(this.data.biaya_bulan.replaceAll(/[.Rp_]/g, '').trim()),
                            bpf: this.data.bpf,
                        }
                        console.log(this.data.id_pphuni)
                        fetch(`{{ route('pphunifikasiUpdate', '') }}/${this.data.id_pphuni}`, {
                            method: 'PUT',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(Data)
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

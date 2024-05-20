<div class="modal fade" id="tambahkaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    x-data="modalKaryawan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Karyawan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                {{-- <form @submit.prevent="handleSubmit">
                    <div class="d-flex justify-content-center gap-3">
                        <div style="width: 7%">
                            <x-pph21sub.formkaryawan type="text" title="ID" model="formData.id"
                                value="formData.id" status="disabled" />
                        </div>
                        <x-pph21sub.formkaryawan type="text" title="Nama" model="formData.nama"
                            value="formData.nama" status="" />
                        <x-pph21sub.formkaryawan type="number" title="NIK" model="formData.nik" value="formData.nik"
                            status="" />
                        <x-pph21sub.formkaryawan type="number" title="NPWP" model="formData.npwp"
                            value="formData.npwp" status="" />
                        <button type="button" class="btn btn-primary" @click="handleReset">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                    </div>
                </form> --}}

                <div class="table-responsive mt-3">
                    <table class="my-table" id="tableKaryawan">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>NPWP</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        let karyawan = {!! json_encode($karyawan) !!}
        let tableKaryawan = (karyawan) => {
            $('#tableKaryawan').DataTable({
                destroy: true,
                data: karyawan,
                columns: [{
                        data: 'null',
                        render: (data, type, row, meta) => {
                            return meta.row + 1
                        }
                    },
                    {
                        data: 'nama',
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'npwp',

                    },
                    {
                        data: 'id',
                        render: (data) => {
                            return /*html*/ `<div class="button-container gap-2">
                                                <a href="#" class="btn btn-sm btn-warning" @click="getEdit(${data})"><i class="fas fa-fw fa-solid fa-pen"></i> </a>
                                                    <button type="button" class="btn btn-sm btn-danger" @click="handleDelete(${data})">
                                                        <i class="fas fa-fw fa-solid fa-trash"></i> </button>
                                        </div>`
                        }
                    },
                ]
            })

        }

        /*  tableKaryawan(karyawan) */

        const getKaryawan = async () => {
            await fetch("{{ route('getKaryawan') }}", {
                method: 'GET',
            }).then(res => res.json()).then(res => {
                karyawan = res
                tableKaryawan(karyawan)
            })
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('modalKaryawan', () => ({
                formData: {
                    id: '',
                    nama: '',
                    nik: '',
                    npwp: ''
                },


                getEdit(id) {
                    const findKaryawan = karyawan.find(item => item.id === id)
                    this.formData = findKaryawan
                    console.log(this.formData)
                },

                handleReset() {
                    this.formData = {
                        id: '',
                        nama: '',
                        nik: '',
                        npwp: ''
                    }
                },

                handleSubmit() {
                    fetch("{{ route('addKaryawan') }}", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.formData)
                    }).then(res => {
                        this.handleReset()
                        getKaryawan()

                    }).then(res => getpph21())
                },

                handleDelete(id) {
                    fetch(`{{ route('deleteKaryawan', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => getKaryawan()).catch(err => console.log(err))
                }


            }))
        })
    </script>
@endpush

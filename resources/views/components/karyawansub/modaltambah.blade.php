{{-- @props(['pajaks']) --}}

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true"
    x-data="formTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel"><b>Tambah Data Karyawan</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <form action="{{ route('karyawanStore') }}" method="post"> -->
            <form @submit.prevent="handleSubmit">
                <div class="modal-body">
                    @csrf
                    <!-- Input Data -->
                    {{-- <div class="form-group">
                        <label for="id_pph21">Nama WP</label>
                        <select name="id_pph21" id="id_pph21" class="form-select" x-model="formData.id_pph21">
                            <option value="" disabled selected>Pilih Nama</option>
                            @foreach ($pajaks as $pajak)
                                <option value="{{ $pajak->id_pajak }}">{{ $pajak->nama_wp }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Nama" x-model="formData.nama">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK"
                            x-model="formData.nik">
                    </div>
                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp"
                            placeholder="NPWP" x-model="formData.npwp">
                    </div>
                    {{--  <div id="karyawan">
                        <h6>-- Karyawan --</h6>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK"
                                x-model="formData.nik">
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP</label>
                            <input type="text" class="form-control" id="npwp" name="npwp" placeholder="npwp"
                                x-model="formData.npwp">
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-toggle="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

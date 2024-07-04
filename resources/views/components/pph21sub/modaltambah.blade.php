@props(['pajaks'])

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true"
    x-data="formTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel"><b>Tambah Data Pph21</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <form action="{{ route('pph21Store') }}" method="post"> -->
            <form @submit.prevent="handleSubmit">
                <div class="modal-body">
                    @csrf
                    <!-- Input Data -->
                    <div class="form-group">
                        <label for="id_pajak">Nama WP</label>
                        <select name="id_pajak" id="id_pajak" class="form-select" x-model="formData.id_pajak" required>
                            <option value="" disabled selected>Pilih Nama</option>
                            @foreach ($pajaks as $pajak)
                                <option value="{{ $pajak->id_pajak }}">{{ $pajak->nama_wp }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Bayar</label>
                        <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar"
                            placeholder="Jumlah Bayar" x-model="formData.jumlah_bayar"
                            x-mask:dynamic="$money($input, ',')" required>
                    </div>
                    <div class="form-group">
                        <label for="bpe">BPE</label>
                        <input type="text" class="form-control" id="bpe" name="bpe" placeholder="BPE"
                            x-model="formData.bpe" required>
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya Bulan</label>
                        <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan"
                            placeholder="Biaya Bulan" x-model="formData.biaya_bulan"
                            x-mask:dynamic="$money($input, ',')" required>
                    </div>
                    <div class="form-group">
                        <label for="karyawan">Daftar Karyawan</label>
                        <select name="karyawan" id="karyawan" class="form-select" x-model="formData.nik" required>
                            <option value="">--Select--</option>
                            {{--  @foreach ($karyawan as $k)
                                <option value="{{ $k->nik }}">{{ $k->nama }}
                                </option>
                            @endforeach --}}
                            <template x-for="karyawan in dataKaryawan" required>
                                <option :value="karyawan.nik" x-text="karyawan.nama">
                                </option>
                            </template>
                        </select>
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

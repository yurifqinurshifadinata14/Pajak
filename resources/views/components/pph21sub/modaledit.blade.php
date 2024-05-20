<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form {{-- action="{{ route('pph21Update', $p->id_pph21) }}" method="post" --}} @submit.prevent="editSubmit">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel"><b>Edit Data Pph21</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <!--input data-->
                    <div class="form-group">
                        <label for="id_pajak">Nama WP</label>
                        <select name="id_pajak" id="id_pajak" class="form-select" x-model="data.id_pajak">
                            <option value="" disabled selected>Pilih Nama</option>
                            {{-- @foreach ($pajaks as $pajak)
                                <option value="{{ $pajak->id_pajak }}">{{ $pajak->nama_wp }}</option>
                            @endforeach --}}
                            <template x-for="pajak in pajaks">
                                <option :value="pajak.id_pajak" x-text="pajak.nama_wp"></option>
                            </template>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Bayar</label>
                        <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar"
                            placeholder="Jumlah Bayar" x-model="data.jumlah_bayar" x-mask:dynamic="$money($input, ',')">
                    </div>
                    <div class="form-group">
                        <label for="bpf">BPF</label>
                        <input type="text" class="form-control" id="bpf" name="bpf" {{-- value="data.bpf" --}}
                            placeholder="BPF" x-model="data.bpf">
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya Bulan</label>
                        <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan"
                            {{-- value="data.biaya_bulan" --}} placeholder="Biaya Bulan" x-model="data.biaya_bulan"
                            x-mask:dynamic="$money($input, ',')">
                    </div>
                    {{--  <h6>-- Karyawan --</h6>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            placeholder="NIK" x-model="data.nik">
                    </div>
                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp"
                            placeholder="NPWP" x-model="data.npwp">
                    </div> --}}
                    <div class="form-group">
                        <label for="karyawan">Daftar Karyawan</label>
                        <select name="karyawan" id="karyawan" class="form-select" x-model="data.nik">
                            <option disabled>--Select--</option>
                            {{--  @foreach ($karyawan as $k)
                                <option value="{{ $k->nik }}">{{ $k->nama }}
                                </option>
                            @endforeach --}}
                            <template x-for="karyawan in dataKaryawan">
                                <option :value="karyawan.nik" x-text="karyawan.nama">
                                </option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

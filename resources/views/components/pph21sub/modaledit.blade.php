<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    x-data="formEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel"><b>Edit Data Pph21</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form {{-- action="{{ route('pph21Update', $p->id_pph21) }}" method="post" --}} @submit.prevent="editSubmit">
                    @csrf
                    @method('PUT')
                    <!--input data-->
                    <div class="form-group">
                        <label for="jumlah">Jumlah Bayar</label>
                        <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" :value="data.jumlah_bayar"
                            placeholder="Jumlah Bayar" x-model="data.jumlah_bayar">
                    </div>
                    <div class="form-group">
                        <label for="bpf">BPF</label>
                        <input type="text" class="form-control" id="bpf" name="bpf" :value="data.bpf"
                            placeholder="BPF" x-model="data.bpf">
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya Bulan</label>
                        <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan" :value="data.biaya_bulan"
                            placeholder="Biaya Bulan" x-model="data.biaya_bulan">
                    </div>
                    <div class="form-group">
                        <label for="karyawan">Daftar Karyawan</label>
                        <select name="karyawan" id="karyawan" class="form-select" :value="data.karyawan"
                            onchange="showEditInput(this)" x-model="data.karyawan">
                            <option disabled>--Select--</option>
                            <option value="karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div id="karyawan" style="display:none;">
                        <h6>-- Karyawan --</h6>
                        <div class="form-group">
                            <label for="nikKaryawan">NIK</label>
                            <input type="text" class="form-control" id="nikKaryawan" name="nikKaryawan"
                                :value="data.nikKaryawan" placeholder="NIK" x-model="data.nikKaryawan">
                        </div>
                        <div class="form-group">
                            <label for="npwpKaryawan">NPWP</label>
                            <input type="text" class="form-control" id="npwpKaryawan" name="npwpKaryawan"
                                :value="data.npwpKaryawan" placeholder="NPWP" x-model="data.npwpKaryawan">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        console.log('ini modal edit')
    </script>
@endpush

<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    x-data="formEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel"><b>Edit Data Pph Unifikasi</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editSubmit">
                    @csrf
                    @method('PUT')
                    <!--edit data-->
                    {{-- <div class="form-group">
                        <label for="id_pajak">Nama WP</label>
                        <select name="id_pajak" id="id_pajak" class="form-select">
                            @foreach ($pajaks as $pajak)
                                <option value="{{$pajak->id_pajak}}">{{$pajak->nama_wp}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="ntpn">NTPN</label>
                        <input type="number" class="form-control" id="ntpn" name="ntpn" placeholder="NTPN" value="ntpn" x-model="data.ntpn">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar</label>
                        <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Jumlah Bayar" value="jumlah_bayar" x-model="data.jumlah_bayar"  x-mask:dynamic="$money($input,',')">
                    </div>
                    <div class="form-group">
                        <label for="biaya_bulan">Biaya Bulan</label>
                        <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan" placeholder="Biaya Bulan" value="biaya_bulan" x-model="data.biaya_bulan"  x-mask:dynamic="$money($input,',')">
                    </div>
                    <div class="form-group">
                        <label for="bpe">BPE</label>
                        <input type="text" class="form-control" id="bpe" name="bpe" placeholder="BPE" x-model="data.bpe" value="bpe">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        console.log('editData')
    </script>
@endpush

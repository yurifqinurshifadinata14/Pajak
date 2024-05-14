<div x-data="formEdit" class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><b>Edit Data PPH</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editSubmit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="ntpn">NTPN</label>
                        <input type="number" class="form-control" id="ntpn" value="ntpn"
                            placeholder="NTPN" x-model="data.ntpn">
                    </div>
                    <div class="form-group">
                        <label for="biaya_bulan">Biaya Bulan</label>
                        <input type="text" class="form-control" id="biaya_bulan"
                            value="biaya_bulan" placeholder="Biaya Bulan" x-model="data.biaya_bulan" x-mask:dynamic="$money($input,',')">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar</label>
                        <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar"
                            value="jumlah_bayar" placeholder="Jumlah Bayar" x-model="data.jumlah_bayar" x-mask:dynamic="$money($input,',')">
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
        console.log(editData);
    </script>
@endpush

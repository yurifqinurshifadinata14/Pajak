@props(['pajaks'])

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true" x-data="formTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel"><b>Tambah Data PPH</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form @submit.prevent="handleSubmit">
                @csrf <!-- Laravel CSRF Protection -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_pajak">Nama WP</label>
                        <select name="id_pajak" id="id_pajak" class="form-select" x-model="formData.id_pajak">
                            <option value="" disabled selected>Pilih Nama</option>
                            @foreach ($pajaks as $pajak)
                            <option value="{{$pajak->id_pajak}}">{{$pajak->nama_wp}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ntpn">NTPN</label>
                        <input type="number" class="form-control" id="ntpn" name="ntpn" placeholder="NTPN" x-model="formData.ntpn">
                    </div>
                    <div class="form-group">
                        <label for="biaya_bulan">Biaya Bulan</label>
                        <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan" placeholder="Biaya Bulan" x-model="formData.biaya_bulan" x-mask:dynamic="$money($input,',')">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar</label>
                        <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Jumlah Bayar" x-model="formData.jumlah_bayar" x-mask:dynamic="$money($input,',')">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-navy">Submit</button>    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
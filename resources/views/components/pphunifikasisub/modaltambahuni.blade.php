@props(['pajaks'])
<!-- Modal -->
  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" x-data="formTambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Tambah Data Pph Unifikasi</b></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <form action="{{route('pphunifikasiStore')}}" method="post"> --}}
        <form @submit.prevent="handleSubmit">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_pajak">Nama WP</label>
                    <select name="id_pajak" id="id_pajak" class="form-select" x-model="formData.id_pajak" required>
                        <option value="" disabled selected>Pilih Nama</option>
                        @foreach ($pajaks as $pajak)
                            <option value="{{$pajak->id_pajak}}">{{$pajak->nama_wp}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">NTPN</label>
                    <input type="number" class="form-control" id="ntpn" name="ntpn" placeholder="NTPN" x-model="formData.ntpn" required>
                </div>
                <div class="form-group">
                    <label for="nama">Jumlah Bayar</label>
                    <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Jumlah Bayar" x-model="formData.jumlah_bayar" x-mask:dynamic="$money($input,',')" required>
                </div>
                <div class="form-group">
                    <label for="nama">Biaya Bulan</label>
                    <input type="text" class="form-control" id="biaya_bulan" name="biaya_bulan" placeholder="Biaya Bulan" x-model="formData.biaya_bulan" x-mask:dynamic="$money($input,',')" required>
                </div>
                <div class="form-group">
                    <label for="nama">BPE</label>
                    <input type="text" class="form-control" id="bpe" name="bpe" placeholder="BPE" x-model="formData.bpe" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>

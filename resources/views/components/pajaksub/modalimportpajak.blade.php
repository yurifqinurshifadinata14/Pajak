
<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form @submit.prevent="handleImport" enctype="multipart/form-data">
                {{-- method="post" action="{{ route('pajak.import_excel') }}" --}}
                {{-- <form method="post" action="#" enctype="multipart/form-data"> --}}
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formfile" class="form-label">Upload File Excel</label>
                        <input class="form-control" id="formfile" type="file" name="file" required="required" @change="file=Object.values($event.target.files)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

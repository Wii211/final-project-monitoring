<div class="modal fade" id="import-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="import-title">Import Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="import-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="final-import-id">Import</label>
                        <input type="file" class="form-control-file" id="import" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="import-action">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
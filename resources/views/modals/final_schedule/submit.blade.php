<div class="modal fade" id="final-schedule-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="final-schedule-title">Pengajuan Seminar Proposal/Sidang Tugas Akhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="final-schedule-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="upload-document" id="upload-document-name"></label>
                        <input type="file" class="form-control-file" id="upload-document" name="document_result"
                            accept="application/pdf" required>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/design/undraw_super_thank_you_obwk.png') }}" class="w-50">
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="final-schedule-checked" required>
                        <label class="custom-control-label" for="final-schedule-checked">
                            Saya yakin untuk mengajukan proposal/tugas akhir ini dan dosen pembimbing
                            mengetahuinya.</label>
                    </div>
                    <input type="hidden" name="final_log_id" id="final-log-id">
                    <input type="hidden" name="final_status_name" id="final-status-name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
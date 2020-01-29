<div class="modal fade" id="final-project-active-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="final-project-active-title">Update Proposal/Tugas Akhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="final-project-active-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title-active">Judul Proposal/Tugas Akhir</label>
                        <input type="text" class="form-control" id="title-active" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="supervisors-1">Dosen Pembimbing Pertama</label>
                        <select class="form-control" id="supervisors-1" name="supervisors[lecturer_id]" required>
                        </select>
                        <a id="supervisors-file-1" class="btn btn-danger w-100 d-block text-white" target="_blank">Tidak Ada Berkas Persetujuan</a>
                        <input type="hidden" id="supervisors-role-1" name="supervisors[role]" value="1">
                    </div>
                    <div class="form-group">
                        <label for="supervisors-2">Dosen Pembimbing Kedua</label>
                        <select class="form-control" id="supervisors-2" name="supervisors2[lecturer_id]" required>
                        </select>
                        <a id="supervisors-file-2" class="btn btn-danger w-100 d-block text-white" target="_blank">Tidak Ada Berkas Persetujuan</a>
                        <input type="hidden" id="supervisors-role-2" name="supervisors2[role]" value="2">
                    </div>
                    <hr>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="final-project-active-id">
                    <input type="hidden" id="final-student-active-id" name="final_student_id">
                    <input type="hidden" id="description-active" name="description">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
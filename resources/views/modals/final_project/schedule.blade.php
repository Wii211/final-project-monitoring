<div class="modal fade" id="final-schedule-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="final-schedule-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="final-schedule-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="final-schedule-type">Jenis Jadwal Tugas Akhir</label>
                        <select class="form-control form-control-sm" id="final-schedule-type" name="status" required>
                            <option value="proposal">Seminar Proposal</option>
                            <option value="tugas_akhir">Sidang Tugas Akhir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="final-project-schedule-id">Judul Tugas Akhir</label>
                        <select class="form-control form-control-sm" id="final-project-schedule-id" name="final_project_id" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal & Waktu</label>
                        <input type="datetime-local" class="form-control form-control-sm" id="date" name="scheduled" required>
                    </div>
                    <div class="form-group">
                        <label for="place">Tempat Seminar</label>
                        <input type="text" class="form-control form-control-sm" id="place" name="place" required>
                    </div>
                    <div class="form-group">
                        <label for="first-examiner-name">Dosen Penguji Pertama</label>
                        <input type="hidden" name="examiner1[role]" id="first-examiner-role" value="1">
                        <select class="form-control form-control-sm" name="examiner1[lecturer_id]"
                            id="first-examiner-name" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="second-examiner-name">Dosen Penguji Kedua</label>
                        <input type="hidden" name="examiner2[role]" id="second-examiner-role" value="2">
                        <select class="form-control form-control-sm" name="examiner2[lecturer_id]"
                            id="second-examiner-name" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="third-examiner-name">Dosen Penguji Ketiga</label>
                        <input type="hidden" name="examiner3[role]" id="third-examiner-role" value="3">
                        <select class="form-control form-control-sm" name="examiner3[lecturer_id]"
                            id="third-examiner-name" required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="final-schedule-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="final-schedule-button">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
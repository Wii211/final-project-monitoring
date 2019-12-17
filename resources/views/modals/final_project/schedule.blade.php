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
                        <label for="final-schedule-date">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" id="final-schedule-date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="final-schedule-time">Waktu</label>
                        <input type="time" class="form-control form-control-sm" id="final-schedule-time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="place">Tempat Seminar</label>
                        <input type="text" class="form-control form-control-sm" id="place" name="place" required>
                    </div>
                    <div class="form-group">
                        <label for="examiner-name-1">Dosen Penguji Pertama</label>
                        <input type="hidden" name="examiner1[role]" id="examiner-role-1" value="1">
                        <input type="hidden" name="examiner1[id]" id="examiner-id-1">
                        <select class="form-control form-control-sm" name="examiner1[lecturer_id]" id="examiner-name-1" 
                        required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="examiner-name-2">Dosen Penguji Kedua</label>
                        <input type="hidden" name="examiner2[role]" id="examiner-role-2" value="2">
                        <input type="hidden" name="examiner2[id]" id="examiner-id-2">
                        <select class="form-control form-control-sm" name="examiner2[lecturer_id]" id="examiner-name-2" 
                        required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="examiner-name-3">Dosen Penguji Ketiga</label>
                        <input type="hidden" name="examiner3[role]" id="examiner-role-3" value="3">
                        <input type="hidden" name="examiner3[id]" id="examiner-id-3">
                        <select class="form-control form-control-sm" name="examiner3[lecturer_id]" id="examiner-name-3" 
                        required>
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
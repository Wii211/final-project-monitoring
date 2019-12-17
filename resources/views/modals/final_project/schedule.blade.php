<div class="modal fade" id="final-schedule-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="final-schedule-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="final-schedule-form">
                    <div class="form-group">
                        <label for="final-schedule-type">Jenis Jadwal Tugas Akhir</label>
                        <select class="form-control form-control-sm" id="final-schedule-type">
                            <option value="seminar">Seminar Proposal</option>
                            <option value="sidang">Sidang Tugas Akhir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="final-project-schedule-id">Judul Tugas Akhir</label>
                        <select class="form-control form-control-sm" id="final-project-schedule-id">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" id="date">
                    </div>
                    <div class="form-group">
                        <label for="time">Waktu</label>
                        <input type="time" class="form-control form-control-sm" id="time">
                    </div>
                    <div class="form-group">
                        <label for="place">Tempat Seminar</label>
                        <input type="text" class="form-control form-control-sm" id="place">
                    </div>
                    <div class="form-group">
                        <label for="first-examiner-name">Dosen Penguji Pertama</label>
                        <input type="hidden" name="examiner[role]" id="first-examiner-role">
                        <select class="form-control form-control-sm" name="examiner[lecturer_id]" id="first-examiner-name">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="second-examiner-name">Dosen Penguji Kedua</label>
                        <input type="hidden" name="examiner[role]" id="second-examiner-role">
                        <select class="form-control form-control-sm" name="examiner[lecturer_id]" id="second-examiner-name">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="third-examiner-name">Dosen Penguji Ketiga</label>
                        <input type="hidden" name="examiner[role]" id="third-examiner-role">
                        <select class="form-control form-control-sm" name="examiner[lecturer_id]" id="third-examiner-name">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="final-schedule-id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="final-schedule-button">Ajukan</button>
            </div>
        </div>
    </div>
</div>
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
                    <div class="mx-auto"><h4>Informasi Mahasiswa</h4></div>
                    <div class="form-group">
                        <label for="final-project-student">Nama Mahasiswa</label>
                        <input type="text" class="form-control form-control-sm" id="final-project-student" disabled>
                    </div>
                    <div class="form-group">
                        <label for="final-project-title">Judul Tugas Akhir</label>
                        <textarea class="form-control" id="final-project-title" rows="3" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="supervisor-1">Dosen Pembimbing Pertama</label>
                        <select class="form-control form-control-sm" id="supervisor-1"
                        disabled>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supervisor-2">Dosen Pembimbing Kedua</label>
                        <select class="form-control form-control-sm" id="supervisor-2"
                        disabled>
                        </select>
                    </div>
                    {{-- <button type="button" class="btn btn-primary w-100 mt-1" id="final-project-checked">Cek Berkas
                        Persetujuan Sidang/Seminar</button>
                    <small>Klik untuk melihat berkas persetujuan proposal/tugas akhir.</small> --}}
                    <hr>
                    <div class="mx-auto"><h4>Jadwal Seminar Mahasiswa</h4></div>
                    <div class="form-group">
                        <label for="final-schedule-date">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" id="final-schedule-date" name="date"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="final-schedule-time">Waktu Mulai</label>
                        <input type="time" class="form-control form-control-sm" id="final-schedule-time" name="time"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="final-schedule-time-end">Waktu Berakhir</label>
                        <input type="time" class="form-control form-control-sm" id="final-schedule-time-end"
                            name="end_time" required>
                    </div>
                    <div class="form-group">
                        <label for="place">Tempat Seminar</label>
                        <input type="text" class="form-control form-control-sm" id="place" name="place"
                            placeholder="(Misal: A16)" required>
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
                    <div class="form-group" id="final-project-examiner-3">
                        <label for="examiner-name-3">Dosen Penguji Ketiga</label>
                        <input type="hidden" name="examiner3[role]" id="examiner-role-3" value="3">
                        <input type="hidden" name="examiner3[id]" id="examiner-id-3">
                        <select class="form-control form-control-sm" name="examiner3[lecturer_id]" id="examiner-name-3"
                            required>
                        </select>
                    </div>
                    <div class="form-group" id="final-project-examiner-4">
                        <label for="examiner-name-4">Dosen Penguji Keempat</label>
                        <input type="hidden" name="examiner4[role]" id="examiner-role-4" value="4">
                        <input type="hidden" name="examiner4[id]" id="examiner-id-4">
                        <select class="form-control form-control-sm" name="examiner4[lecturer_id]" id="examiner-name-4"
                            required>
                        </select>
                    </div>
                    <div class="form-group" id="final-project-examiner-5" style="display:none">
                        <label for="examiner-name-5">Dosen Penguji Kelima</label>
                        <input type="hidden" name="examiner5[role]" id="examiner-role-5" value="5">
                        <input type="hidden" name="examiner5[id]" id="examiner-id-5">
                        <select class="form-control form-control-sm" name="examiner5[lecturer_id]" id="examiner-name-5"
                            required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="final-project-status" name="status">
                    <input type="hidden" id="final-project-schedule-hidden-id" name="final_project_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="final-schedule-button">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
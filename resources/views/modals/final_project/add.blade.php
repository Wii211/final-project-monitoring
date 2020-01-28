<div class="modal fade" id="final-project-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="final-project-title">Pengajuan Judul Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="final-project-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Judul/Topik Proposal</label>
                        <input type="text" class="form-control" id="title" name="title" required maxlength="120">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Umum Proposal Tugas Akhir</label>
                        <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="supervisors-1">Dosen Pembimbing Pertama</label>
                        <select class="form-control" id="supervisors-1" name="supervisors[lecturer_id]" required>
                        </select>
                        <input type="hidden" id="supervisors-role-1" name="supervisors[role]" value="1">
                    </div>
                    <div class="form-group">
                        <label for="supervisors-file-1">Berkas Persetujuan Pembimbing Pertama</label>
                        <input type="file" id="supervisors-file-1" name="supervisors[file]" value="1">
                    </div>
                    <div class="">
                        <div class="form-group">
                            <label for="supervisors-2">Dosen Pembimbing Kedua</label>
                            <select class="form-control" id="supervisors-2" name="supervisors2[lecturer_id]" required>
                            </select>
                            <input type="hidden" id="supervisors-role-2" name="supervisors2[role]" value="2">
                        </div>
                        <div class="form-group">
                            <label for="supervisors-file-2">Berkas Persetujuan Pembimbing Kedua</label>
                            <input type="file" id="supervisors-file-2" name="supervisors2[file]" value="1">
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('recomendation-title.index') }}" class="btn bg-gradient-primary w-100">Klik di sini untuk memilih judul dari dosen, tersedia topik baru!</a>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="final-project-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="final-project-action">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
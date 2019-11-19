<div class="modal fade" id="preproposal-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="preproposal-title">Pengajuan Judul Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="preproposal-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Judul/Topik Proposal</label>
                        <input type="text" class="form-control" id="title" name="title" required>
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
                        <label for="supervisors-2">Dosen Pembimbing Kedua</label>
                        <select class="form-control" id="supervisors-2" name="supervisors2[lecturer_id]" required>
                        </select>
                        <input type="hidden" id="supervisors-role-2" name="supervisors2[role]" value="2">
                    </div>
                    <hr>
                    <a href="{{ route('recomendation-title.index') }}" class="btn bg-gradient-primary w-100">Klik di sini untuk memilih judul dari dosen, tersedia topik baru!</a>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="preproposal-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="preproposal-action">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
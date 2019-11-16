<div class="modal fade" id="student-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="student-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="final-student-id">NIM</label>
                        <input type="text" id="final-student-id" class="form-control form-control-sm" name="student_id"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" class="form-control form-control-sm" name="name" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select class="form-control form-control-sm" id="status" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    {{-- <div class="form-group mt-3">
                        <label for="user-id">Session</label>
                        <select class="form-control form-control-sm" id="user-id" name="user_id" required>
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="student-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="student-action">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

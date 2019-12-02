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
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control form-control-sm" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone-number">Telepon</label>
                        <input type="text" id="phone-number" class="form-control form-control-sm" name="phone_number" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select class="form-control form-control-sm" id="status" name="status" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="status">Jenis Kelamin</label>
                        <select class="form-control form-control-sm" id="gender" name="gender" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
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

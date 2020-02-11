<div class="modal fade" id="lecturerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lecturerModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="lecturerDataForm" method="POST" 
        enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NIP</label>
                        <input type="text" id="lecturerPersonalId" class="form-control" name="personnel_id" required>
                    </div>
                    <div class="form-group">
                        <label for="">NIDN</label>
                        <input type="text" id="lecturerLecturerId" class="form-control" name="lecturer_id" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap (Dengan Gelar)</label>
                        <input type="text" id="lecturerName" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" id="lecturerNumber" class="form-control" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input type="text" id="lecturerEmail" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Pendidikan Terakhir</label>
                        <input type="text" id="lecturerLastEduction" class="form-control" name="last_education" required>
                    </div>
                    <div class="form-group">
                        <label for="lecturerStatus">Status Dosen</label>
                        <select class="form-control" id="lecturerStatus" name="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Foto</label>
                        <input type="file" class="form-control-file" name="image_profile" id="lecturerImage" value="12121">
                    </div>
                    <div class="form-group">
                        <label for="positions">Jabatan Fungsional</label>
                        <select class="form-control" id="positions" name="position_id">
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="topics">Bidang Minat Dosen</label>
                        <select multiple class="form-control" id="topics" name="topics[]">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="lecturerId" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="input" class="btn btn-primary" id="lecturerModalButton">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>

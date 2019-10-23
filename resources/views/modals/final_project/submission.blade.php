<div class="modal fade" id="pengajuanProposal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengajuan Judul Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="studentTitle" value="option1"
                            checked>
                        <label class="form-check-label" for="studentTitle">
                            Judul sendiri
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="lecturerTitle" value="option2">
                        <label class="form-check-label" for="lecturerTitle">
                            Judul dari dosen
                        </label>
                    </div>
                    <hr>
                    <div class="lecturer-final-project-title">
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect2">Judul Proposal Dari Dosen</label>
                            <select multiple class="form-control" id="exampleFormControlSelect2">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="student-final-project-title">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Judul Proposal</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Deskripsi Umum Proposal Tugas Akhir</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Dosen Pembimbing Pertama</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Dosen Pembimbing Kedua</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
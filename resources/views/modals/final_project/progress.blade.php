<div class="modal fade" id="progressFinalProject" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Progress Pengerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th><i class="fas fa-file-word"></i> File</th>
                                <th>Persetujuan<br>Pembimbing</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>21-01-2019</td>
                                <td>Konsultasi Pra-Proposal</td>
                                <td>File</td>
                                <td>
                                    <span class="badge badge-success p-2">Disetujui</span>
                                </td>
                                <td>
                                    <button class="btn bg-gradient-danger btn-sm w-100"><span
                                            class="fas fa-times"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <hr>
                <form>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleFormControlInput1">Tanggal</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="form-group col-6">
                            <label for="exampleFormControlInput1">Keterangan</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="form-group col-12">
                            <label for="exampleFormControlInput1">Hasil</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <button type="button" class="btn bg-gradient-success w-100" data-dismiss="modal">Submit
                        Progress</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
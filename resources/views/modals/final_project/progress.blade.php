<div class="modal fade" id="final-project-progress-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="final-project-progress-title">Progres Pengerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="final-project-progress-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Persetujuan<br>Pembimbing</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <hr>
                <form id="final-project-progress-form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="progress-description">Deskripsi Progres</label>
                            <textarea class="form-control" name="description" id="progress-description" rows="5"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="final_status" id="final-project-status">
                    <input type="hidden" name="final_project_id" id="final-project-progress-id">
                    <button type="submit" class="btn bg-gradient-success w-100">Submit
                        Progres</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
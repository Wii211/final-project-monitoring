<div class="modal fade" id="final-project-verification-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="final-project-verification-title">Verifikasi Tugas Akhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="final-project-verification-form">
                @csrf
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="final-status-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status Tugas Akhir</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="final-status-table-row">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="final-project-verification-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
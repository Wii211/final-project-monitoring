<div class="modal fade" id="recomendationTitleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recomendationTitleModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="recomendationTitleForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan Topik</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="topics">Topik</label>
                        <select multiple class="form-control" id="topics" name="topics[]">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lecturers">Dosen Pengampu</label>
                        <select class="form-control" id="lecturers" name="lecturer_id">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="recommendationTitleId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="recomendationTitleModalButton">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
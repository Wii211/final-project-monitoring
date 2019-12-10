<div class="modal fade" id="news-report-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="news-report-title">Arsip Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <div class="d-flex justify-content-end">
                    <button id="convertImageToPDF" type="submit" class="btn bg-gradient-success mb-2">
                        <i class="fas fa-images"></i>
                        Download Images
                    </button>
                </div> --}}
                <div class="filter-container p-0 row"  id="news-report-image">
                    
                </div>
                <hr>
                <form enctype="multipart/form-data" id="news-report-form">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="news-reports">Tambah Foto Berita Acara</label>
                            <input type="file" class="form-control-file" id="news-reports" name="news_report_images[]" multiple>
                        </div>
                    </div>
                    <input type="hidden" id="news-report-id">
                    <input type="hidden" id="news-report-status" name="final_status_name">
                    <input type="hidden" id="final-news-project-id" name="final_project_id">
                    <button type="submit" class="btn bg-gradient-primary w-100">Submit Berita Acara
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
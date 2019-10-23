<div class="modal fade" id="newsReport" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arsip Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end">
                    <button id="convertImageToPDF" type="submit" class="btn bg-gradient-success mb-2">
                        <i class="fas fa-images"></i>
                        Download Images
                    </button>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox"
                            data-title="sample 1 - white" data-gallery="gallery">
                            <img id="image123" src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2"
                                alt="white sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox"
                            data-title="sample 2 - black" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2"
                                alt="black sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox"
                            data-title="sample 3 - red" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2"
                                alt="red sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox"
                            data-title="sample 4 - red" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2"
                                alt="red sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox"
                            data-title="sample 5 - black" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2"
                                alt="black sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox"
                            data-title="sample 6 - white" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2"
                                alt="white sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox"
                            data-title="sample 7 - white" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2"
                                alt="white sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox"
                            data-title="sample 8 - black" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2"
                                alt="black sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox"
                            data-title="sample 9 - red" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2"
                                alt="red sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox"
                            data-title="sample 10 - white" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2"
                                alt="white sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox"
                            data-title="sample 11 - white" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2"
                                alt="white sample" />
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox"
                            data-title="sample 12 - black" data-gallery="gallery">
                            <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2"
                                alt="black sample" />
                        </a>
                    </div>
                </div>

                <hr>
                <form enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="exampleFormControlInput1">Tambah Foto Berita Acara</label>
                            <input type="file" class="form-control-file" id="" name="news_reports[]" multiple>
                        </div>
                    </div>
                    <button type="button" class="btn bg-gradient-primary w-100" data-dismiss="modal">Submit Berita Acara
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
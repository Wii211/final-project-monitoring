@extends('layouts.master')

<!-- Section Start -->
@section('title', 'Dashboard Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="info-box bg-gradient-danger">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Deadline Pendaftaran Proposal Tugas Akhir</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            <b>

                                Pendaftaran akan ditutup 10 hari lagi, pada tanggal 29 Oktober 2019
                            </b>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        Lengkapi syarat pendaftaran proposal terlebih dahulu untuk bisa mengakses halaman berikutnya.
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Transkip Nilai</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Rencana Studi Terakhir</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 w-100">Verifikasi</button>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
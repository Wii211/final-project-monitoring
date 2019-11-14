@extends('layouts.master')

<!-- Section Start -->

@section('title', 'Dashboard Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="info-box bg-gradient-danger mb-0">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Deadline Pendaftaran Proposal Tugas Akhir</span>

                        <span class="progress-description mt-2">
                            <b>
                                Pendaftaran akan ditutup {{$endDateAndDiffDate['differenceBetweenDate']}}
                                hari lagi, pada tanggal {{$endDateAndDiffDate['endDate']->toFormattedDateString()}}
                            </b>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>

                {{-- TODO ERROR MESSAGE AND SUCCESS MESSAGE --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div> 
        @if(Auth::user()->isVerified() == 0)
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('final_registration.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        Lengkapi syarat pendaftaran proposal terlebih dahulu untuk bisa mengakses halaman berikutnya.
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Transkip Nilai</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="transcript">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Rencana Studi Terakhir</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1"
                            name="latest_study_plan">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 w-100">Verifikasi</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
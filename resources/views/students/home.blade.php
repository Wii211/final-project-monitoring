@extends('layouts.master')

<!-- Section Start -->

@section('title', 'Dashboard Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/design/undraw_time_management_30iu.png') }}" class="w-100" srcset="">
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-gradient-danger pb-0">
                            <span class="info-box-icon"><i class="fas fa-clock"></i></span>
        
                            <div class="info-box-content">
                                <span class="info-box-text">Deadline {{ ucfirst($endDateAndDiffDate['finalStatus']) }}</span>
        
                                <span class="progress-description mt-2">
                                    <b>
                                        {{ucfirst($endDateAndDiffDate['finalStatus'])}} akan ditutup {{$endDateAndDiffDate['differenceBetweenDate']}}
                                        hari lagi, pada tanggal {{$endDateAndDiffDate['endDate']->toFormattedDateString()}}
                                    </b>
                                </span>
                            </div>
                        </div>
                    </div>
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
            @if(Session::has('Success'))
            <div class="alert alert-success" role="alert">
                Berhasil. Silahkan tunggu proses verifikasi.
            </div>
            @elseif(Session::has('Failed'))
            <div class="alert alert-danger" role="alert">
                Error.
            </div>
            @endif
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
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="transcript" accept="application/pdf">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Rencana Studi Terakhir</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1"
                            name="latest_study_plan" accept="application/pdf">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 w-100">Verifikasi</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

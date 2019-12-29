@extends('layouts.master')

<!-- Section Start -->

@section('title', 'Dashboard Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/design/undraw_time_management_30iu.png') }}" class="w-100"
                            srcset="">
                    </div>
                    <div class="col-md-8">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h6 class="mb-0 pb-0"><i class="icon fas fa-info-circle"></i> Anda login sebagai mahasiswa
                            </h6>
                        </div>
                        <div class="alert alert-primary bg-gradient-primary">
                            <h4><i class="icon fas fa-bullhorn"></i> Deadline {{ $endDateAndDiffDate['finalStatus'] }}</h4>
                            <b>
                                @if($endDateAndDiffDate['finalDescription'] !== "berakhir")
                                {{$endDateAndDiffDate['finalStatus']}} akan ditutup
                                {{$endDateAndDiffDate['differenceBetweenDate']}}
                                hari lagi, pada tanggal
                                {{$endDateAndDiffDate['endDate']->toFormattedDateString()}}.
                                @else

                                {{$endDateAndDiffDate['finalStatus']}} telah berakhir pada
                                {{$endDateAndDiffDate['endDate']->toFormattedDateString()}}.
                                @endif
                            </b>
                        </div>
                        <div class="callout callout-info mt-3">
                            <h5>Peringatan!</h5>

                            <p>Pastikan untuk selalu memperhatikan deadline pada tiap status yang ada di tugas akhir.
                            </p>
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
        @if($endDateAndDiffDate['finalDescription'] !== "berakhir")
            <div class="card">
                @if(Session::has('Success'))
                    <div class="alert alert-success" role="alert">
                        Berhasil. Silahkan tunggu proses verifikasi.
                    </div>
                @elseif(Session::has('Failed'))
                    <div class="alert alert-danger" role="alert">
                        Error. Terjadi kesalahan.
                    </div>
                @endif
                @if(Auth::user()->isVerified() == 0)
                <div class="card-body">
                    <form method="POST" action="{{route('final_registration.store')}}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                @csrf
                                @if(!$alreadyUploaded)
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    Lengkapi syarat pendaftaran proposal terlebih dahulu untuk bisa mengakses halaman
                                    lainnya. Pastikan telah mengisi file dengan benar!
                                </div>
                                @else
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    Anda telah mengunggah berkas yang berkaitan. Silahkan tunggu beberapa saat untuk menunggu verifikasi dari koordinator.
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload Transkip Nilai (.pdf)</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        name="transcript" accept="application/pdf">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload Rencana Studi Terakhir (.pdf)</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        name="latest_study_plan" accept="application/pdf">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/design/undraw_fill_forms_yltj.png') }}" class="w-100" srcset="">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-gradient-primary mb-2 w-100">Verifikasi</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection

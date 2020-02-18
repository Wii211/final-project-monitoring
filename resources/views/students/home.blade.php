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
                            @if($endDateAndDiffDate['finalStatus'] === "tugas_akhir")
                                @php $status = "tugas akhir" @endphp
                            @elseif($endDateAndDiffDate['finalStatus'] === "tugas_akhir_selesai")
                                @php $status = "penyelesaian tugas akhir" @endphp
                            @else
                                @php $status = $endDateAndDiffDate['finalStatus'] @endphp
                            @endif
                            <h4><i class="icon fas fa-bullhorn"></i> Deadline {{ $status }}</h4>
                            <b>
                                @if($endDateAndDiffDate['finalDescription'] !== "berakhir")
                                {{$status}} akan ditutup
                                {{$endDateAndDiffDate['differenceBetweenDate']}}
                                hari lagi, pada tanggal
                                {{$endDateAndDiffDate['endDate']->toFormattedDateString()}}.
                                @else

                                {{$status}} telah berakhir pada
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
                                    <label for="exampleFormControlFile1">Upload Kartu Rencana Studi Terakhir (.pdf)</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        name="latest_study_plan" accept="application/pdf">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/design/undraw_fill_forms_yltj.png') }}" class="w-100" srcset="">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-gradient-primary mb-2 w-100"><b>Verifikasi Pendaftaran</b></button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th>Berkas</th>
                                    <th style="width:60%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Pedoman Proposal/Tugas Akhir</td>
                                    <td><a href="{{ asset('storage/PEDOMAN TUGAS AKHIR PRODI TI.pdf') }}" download>Download Berkas
                                            </a> </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Formulir Pernyataan Kesediaan Membimbing Tugas Akhir</td>
                                    <td><a href="{{ asset('storage/PERNYATAAN KESEDIAN MEMBIMBING TUGAS AKHIR.pdf') }}" download>Download Berkas
                                            </a> </td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Formulir Pernyataan Kesediaan Menghadiri Seminar atau Sidang Tugas Akhir</td>
                                    <td><a href="{{ asset('storage/Surat kesedian seminar&sidang.pdf') }}" download>Download Berkas
                                            </a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            Anda telah diverifikasi. Anda dapat mengakses halaman lain.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('storage/design/undraw_confirmed_81ex.png') }}" class="w-50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @else 
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->isPastDeadlineSchedule())
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @if($endDateAndDiffDate['finalStatus'] === "tugas_akhir")
                            <strong>Deadline tugas akhir telah berakhir. Terimakasih.</strong>
                        @elseif($endDateAndDiffDate['finalStatus'] === "tugas_akhir_selesai")
                            <strong>Deadline penyelesaian tugas akhir telah berakhir. Terimakasih.</strong>
                        @else
                            <strong>Deadline {{$endDateAndDiffDate['finalStatus']}} telah berakhir. Terimakasih.</strong>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/design/undraw_throw_down_ub2l.png') }}" class="w-50">
                    </div>
                    @else
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Anda telah menyelesaikan tugas akhir.</strong>
                    </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

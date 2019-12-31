@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Proposal/Tugas Akhir')
{{-- {{ dd($data) }} --}}
@section('content')
<section class="content">
    <div class="container-fluid">
        @if(!is_null($data))
            @if($data->checkIsVerify($data->id, "pra-proposal"))
                @foreach($data->finalLogs as $finalLog)
                @php $status = $finalLog->finalStatus->name @endphp
                @php $finalLogId = $finalLog->id @endphp
                @endforeach
                @if(Auth::user()->isPastDeadlineSchedule())
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Deadline proposal/tugas akhir telah berakhir. Terimakasih.</strong>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('storage/design/undraw_throw_down_ub2l.png') }}" class="w-50">
                        </div>
                    </div>
                </div>
                @elseif($status === "tugas_akhir" || $status === "proposal")
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table" id="final-project-table">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Deskripsi Proposal/Tugas Akhir</th>
                                        </tr>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ $data->created_at }}</td>
                                            <td><span class="badge badge-primary p-2">{{ ucfirst($status) }}</span></td>
                                            <td>
                                                <button type="button"
                                                    class="btn bg-gradient-primary btn-sm w-100 btn-progress progress-input"
                                                    id="{{ $data->id }}" value="{{ $status }}">Progress</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        @foreach($data->finalLogs as $finalLog)
                            @if(!is_null($finalLog->finalSchedules))
                                @foreach($finalLog->finalSchedules as $finalSchedule)
                                    @php $date = $finalSchedule->date @endphp
                                    @php $time = $finalSchedule->hour @endphp
                                    @php $place = $finalSchedule->place @endphp
                                @endforeach
                            @endif
                        @endforeach
                    @if(!is_null($data->finalLogs))
                        @if(is_null($data->finalLogs[0]->finalShedules))
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Seminar {{ $status }}</th>
                                        </tr>
                                        <tr>
                                            <th style="width:5%">#</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Tempat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>{{ $date }}</td>
                                            <td>{{ $time }}</td>
                                            <td>Ruangan {{ $place }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    @endif
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Dosen Pembimbing</th>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->supervisors as $supervisor)
                                    <tr>
                                        <td>{{ $supervisor->lecturer->name }}</td>
                                        @if($supervisor->role == 1)
                                        <td><span class="badge badge-primary p-2">Dosen Pembimbing 1</span></td>
                                        @else
                                        <td><span class="badge badge-info p-2">Dosen Pembimbing 2</span></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                                        <td><a href="{{ asset('storage/pedoman_tugas_akhir.docx') }}" download>Download Berkas
                                                Lampiran</a> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            @if($data->checkIsVerify($data->id, "proposal") && $status !== "tugas_akhir")
                            <button type="button" class="btn btn-success mb-2 submit-final-project" id="{{ $data->id }}">Mulai
                                Mengerjakan Tugas Akhir / Skripsi</button>
                            @elseif((!$data->checkIsVerify($data->id, "proposal")) && $status !== "tugas_akhir")
                                @if(Auth::user()->finalRequirementAlreadySubmitted($finalLogId))
                                <div class="alert alert-primary alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                        <b>
                                            Anda telah mengajukan seminar proposal. Silahkan menunggu jadwal dari koordinator.
                                        </b>
                                </div>
                                @else
                                <button type="button" class="btn btn-success mb-2 submit-schedule" id="{{ $finalLogId }}"
                                    value="{{ $status }}">
                                    Ajukan Seminar Proposal</button>
                                @endif
                            @elseif($data->checkIsVerify($data->id, "tugas_akhir") && $status === "tugas_akhir")
                            <button type="button" class="btn btn-primary mb-2 submit-finish-final-project" id="{{ $data->id }}">
                                Klik di sini apabila tugas akhir selesai</button>
                            @elseif((!$data->checkIsVerify($data->id, "tugas_akhir")) && $status === "tugas_akhir")
                                @if(Auth::user()->finalRequirementAlreadySubmitted($finalLogId))
                                <div class="alert alert-primary alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                        <b>
                                            Anda telah mengajukan sidang tugas akhir. Silahkan menunggu jadwal dari koordinator.
                                        </b>
                                </div>
                                @else
                                <button type="button" class="btn btn-success mb-2 submit-schedule" id="{{ $finalLogId }}"
                                    value="{{ $status }}">
                                    Ajukan Sidang Tugas Akhir</button>
                                @endif
                            @endif
                        </div>
                    </div>
                @elseif($status === "tugas_akhir_selesai")
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-primary alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Selamat! Anda telah menyelesaikan tugas akhir.</strong>
                            </div>
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('storage/design/undraw_super_thank_you_obwk.png') }}" class="w-50">
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Anda belum mengambil proposal/tugas akhir. Silahkan masuk ke halaman <a
                                    href="{{ route('pre_proposal.index') }}">pra-proposal.</a></strong>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('storage/design/undraw_done_a34v.png') }}" class="w-50">
                        </div>
                    </div>
                </div>
            @endif
        @else
        <div class="card">
            <div class="card-body">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Anda belum mengambil pra-proposal. Silahkan masuk ke halaman <a
                            href="{{ route('pre_proposal.index') }}">pra-proposal.</a> untuk mengajukan judul</strong>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/design/undraw_done_a34v.png') }}" class="w-50">
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@section('modal')
@include('modals.final_project.progress')
@include('modals.final_project.detail')
@include('modals.final_schedule.submit')
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/student/final_project.js') }}"></script>
@endsection
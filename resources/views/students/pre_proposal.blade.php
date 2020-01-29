@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Pra-Proposal')

<!-- Content -->
@section('content')
<section class="content">
    <div class="container-fluid">
        {{-- {{dd($data)}} --}}
        @if(is_null($data))
        @if(Auth::user()->recomendationTitleIsPicked())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-info-circle"></i>
                    <strong>Anda sedang menunggu verifikasi dari Koordinator TA
                        untuk pengambilan topik/judul dari dosen yang bersangkutan</strong>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/design/undraw_done_a34v.png') }}" class="w-50">
                </div>
            </div>
        </div>
        @else
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-primary mb-2" id="preproposal-add" data-toggle="modal"
                    data-target="#preproposal-modal">Ajukan Judul Proposal</button>
            </div>
        </div>
        <hr>
        @endif
        @endif
        @if(!is_null($data))
        @if($status !== 'proposal')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="preproposal-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tanggal Diajukan</th>
                                <th>Status Skripsi</th>
                                <th>Status Verifikasi</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td><span
                                        class="badge badge-primary p-2">{{ ucfirst($data->finalLogsPraProposal[0]->finalStatus->name) }}</span>
                                </td>
                                @if($data->checkIsVerify($data->id, "pra-proposal"))
                                <td><span class="badge badge-success p-2">Telah diverifikasi</span></td>
                                @else
                                <td><span class="badge badge-warning p-2">Menunggu verifikasi</span></td>
                                @endif
                                <td>
                                    <button class="btn bg-gradient-warning btn-sm w-100 update"
                                        id="{{ $data->id }}">Update</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <span class="d-block text-center"><b>Dosen Pembimbing</b></span>
            </div>
            <div class="card-body pt-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status Pembimbing</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->supervisors as $supervisor)
                        <tr>
                            <td>{{ $supervisor->lecturer->name }}</td>
                            @if($supervisor->role == 1)
                            <td>
                                <span class="badge badge-primary p-2">Dosen Pembimbing 1</span>
                                @if($supervisor->is_agree == 1)
                                <span class="badge badge-success p-2">Sudah Terverifikasi</span>
                                @else
                                <span class="badge badge-warning p-2">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            @else
                            <td><span class="badge badge-info p-2">Dosen Pembimbing 2</span>
                                @if($supervisor->is_agree == 1)
                                <span class="badge badge-success p-2">Sudah Terverifikasi</span>
                                @else
                                <span class="badge badge-warning p-2">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($data->checkIsVerify($data->id, "pra-proposal"))
        <div class="card">
            <form action="{{ route('pre_proposal.update', ['id' => $data->id]) }}" method="post">
                @csrf
                <div class="form-check">
                    <div class="card-body">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                        <label class="form-check-label" for="defaultCheck1">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <b>
                                Saya menyadari bahwa setelah menekan fix/commit, saya tidak akan bisa
                                memperbarui judul lagi ke depannnya. Terkecuali atas izin dari dosen yang bersangkutan.
                            </b>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary w-100">Fix / Commit</button>
            </form>
        </div>
        @endif
        @elseif($status === 'proposal' || $status === 'tugas_akhir')
        <div class="card">
            <div class="card-body">
                <div class="alert alert-primary alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-info-circle"></i>
                    <strong>Anda telah mengambil proposal/tugas akhir. Silahkan masuk ke halaman <a
                            href="{{ route('final_project.index') }}">tugas akhir.</a></strong>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/design/undraw_done_a34v.png') }}" class="w-50">
                </div>
            </div>
        </div>
        @elseif(Auth::user()->isPastDeadlineSchedule())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Deadline mengajukan judul pra-proposal telah berakhir. Terimakasih.</strong>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/design/undraw_throw_down_ub2l.png') }}" class="w-50">
                </div>
            </div>
        </div>
        @endif
        @endif
    </div>
</section>
@endsection

<!-- Modal -->
@section('modal')
@include('modals.final_project.submission')
@endsection


@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/student/preproposal.js') }}"></script>
@endsection
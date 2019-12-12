@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Tugas Akhir')
{{-- {{ dd($data) }} --}}
@section('content')
<section class="content">
    <div class="container-fluid">
        @if(!is_null($data))
            @if($data->checkIsVerify($data->id, "proposal"))
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4">Deskripsi Tugas Akhir</th>
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
                                    @foreach($data->finalLogs as $finalLog)
                                        @php $status = $finalLog->finalStatus->name @endphp
                                    @endforeach
                                    <td><span class="badge badge-primary p-2">{{ ucfirst($status) }}</span></td>
                                    <td>
                                    <button class="btn bg-gradient-primary btn-sm w-100 btn-progress" id="{{ $data->id }}" value="{{ $data->id }}">Progress</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                                    <td>Pembimbing 1</td>
                                    @else
                                    <td>Pembimbing 2</td>
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
                                    <td>Pedoman Tugas Akhir</td>
                                    <td><a href="#">Download Berkas Lampiran</a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="p-2 bd-highlight">
                        <button type="submit" class="btn btn-success mb-2" data-toggle="modal"
                            data-target="#pengajuanProposal">Ajukan ke Dosen Pembimbing</button>
                    </div>
                </div>
                @foreach($data->finalLogs as $finalLog)
                    @if(is_null($finalLog->finalSchedules))
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Seminar</th>
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
                                            <td>19-19-2019</td>
                                            <td>21:00</td>
                                            <td>Ruangan A-16</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Anda belum mengambil proposal/tugas akhir. Silahkan masuk ke halaman <a href="{{ route('pre_proposal.index') }}">pra-proposal.</a></strong>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>
@endsection

@section('modal')
@include('modals.final_project.progress')
@include('modals.final_project.detail')
@endsection

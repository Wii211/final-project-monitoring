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
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-primary mb-2" id="preproposal-add" data-toggle="modal"
                    data-target="#preproposal-modal">Ajukan Judul Proposal</button>
            </div>
        </div>
        <hr>
        @endif
        @if(!is_null($data))
        <div class="card">
            <div class="card-body">
                <table class="table" id="preproposal-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status Skripsi</th>
                            <th>Status Verifikasi</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->created_at->toDateString() }}</td>
                            <td><span
                                    class="badge badge-primary p-2">{{ ucfirst($data->finalLogsPraProposal[0]->finalStatus->name) }}</span>
                            </td>
                            @if($data->finalLogsPraProposal[0]->is_verification == 0)
                            <td><span class="badge badge-warning p-2">Menunggu verifikasi</span></td>
                            @else
                            <td><span class="badge badge-success p-2">Telah diverifikasi</span></td>
                            @endif
                            <td>
                                <button class="btn bg-gradient-warning btn-sm w-100"
                                    id="{{ $data->id }}">Update</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->supervisors as $supervisor)
                        <tr>
                            <td>{{ $supervisor->lecturer->name }}</td>
                            @if($supervisor->is_agree == 0)
                            <td><span class="badge badge-warning p-2">Menunggu Persetujuan</span></td>
                            @else
                            <td><span class="badge badge-success p-2">Disetujui</span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            {{-- <form action="{{ route('pre_proposal.update', ['id' => $data->id]) }}" method="post"> --}}
                @csrf
                <div class="form-check">
                    <div class="card-body">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <b>
                                Saya menyadari bahwa setelah menekan fix/commit, saya tidak akan bisa
                                memperbarui judul lagi ke depannnya. Terkecuali atas izin dari dosen yang bersangkutan.
                            </b>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="">
                <button type="button" class="btn btn-primary w-100">Fix / Commit</button>
            {{-- </form> --}}
        </div>
    </div>
    @endif
</section>
@endsection

<!-- Modal -->
@section('modal')
@include('modals.final_project.submission')
@endsection


@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/student/preproposal.js') }}"></script>
@endsection

@extends('layouts.master')

<!-- Section Start -->
@section('title', 'Dashboard Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="mt-3">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        Deadline telah diperbaharui!
                    </div>
                    @elseif(Session::has('failed'))
                    <div class="alert alert-danger" role="alert">
                        Deadline gagal diperbaharui!
                    </div>
                    @endif
                </div>
                <form action="{{route('dead-line.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/design/undraw_timeline_9u4u.png') }}" class="w-100" srcset="">
                        </div>
                        <div class="col-md-9">
                            <div class="form-group row">
                                <label class="col-md-4" for="exampleFormControlInput1">Pendaftaran dimulai</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control form-control-sm"
                                        name="registration_start_date"
                                        value="{{ date('Y-m-d', strtotime($deadlineSchedule[0]->start_date)) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4" for="exampleFormControlInput1">Deadline Pendaftaran</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control form-control-sm" name="registration_end_date"
                                        value="{{ date('Y-m-d', strtotime($deadlineSchedule[0]->end_date)) }}">
                                </div>
                            </div>
                            <hr>
                            <blockquote>
                                <i class="fas fa-info-circle" aria-hidden="true"></i> Deadline untuk mahasiswa melakukan
                                pendaftaran proposal.
                            </blockquote>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Pra-Proposal</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="pre_proposal_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[1]->end_date)) }}"> Dimulai
                            setelah deadline pendaftaran.
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Proposal</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="proposal_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[2]->end_date)) }}"> Dimulai
                            setelah deadline pra-proposal.
                        </div>
                    </div>
                    <div class="form-group row">
                        {{-- <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Proposal</label>
                        <div class="col-md-4"> --}}
                            <input type="hidden" class="form-control form-control-sm" name="revision_proposal_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[3]->end_date)) }}">
                        {{-- </div> --}}
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Tugas Akhir</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="final_project_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[4]->end_date)) }}"> Dimulai
                            setelah deadline revisi proposal.
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        {{-- {{-- <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Tugas Akhir</label>
                        <div class="col-md-4"> --}}
                            <input type="hidden" class="form-control form-control-sm"
                                name="revision_final_project_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[5]->end_date)) }}">
                        {{-- </div> --}}
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Perbarui Deadline</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
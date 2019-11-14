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
                    @endif
                </div>
                <form action="{{route('dead-line.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Pendaftaran dimulai</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="registration_start_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[0]->start_date)) }}">
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Pendaftaran</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="registration_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[0]->end_date)) }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Pra-Proposal</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="pre_proposal_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[1]->end_date)) }}"> Hari
                            setelah pendaftaran ditutup.
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Proposal</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="proposal_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[2]->end_date)) }}"> Hari
                            setelah pra-proposal ditutup.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Proposal</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="revision_proposal_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[3]->end_date)) }}">
                            Hari setelah proposal ditutup.
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Tugas Akhir</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm" name="final_project_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[4]->end_date)) }}"> Hari
                            setelah revisi proposal ditutup.
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Tugas Akhir</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control form-control-sm"
                                name="revision_final_project_end_date"
                                value="{{ date('Y-m-d', strtotime($deadlineSchedule[5]->end_date)) }}"> Hari setelah
                            tugas akhir ditutup.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Perbarui Deadline</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Seminar Proposal / Sidang TA')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

<!-- Content -->
@section('content')
<section class="content">
    <div class="container-fluid">
        {{-- <div class="d-flex justify-content-end"> --}}
            {{-- <button type="button" class="btn bg-gradient-success mb-2" id="convert">
                <i class="fas fa-images"></i>
                Export to Image</button> --}}
            {{-- <button type="submit" class="btn btn-primary mb-2" data-toggle="modal" id="final-schedule-add"
                data-target="#final-schedule-modal">Tentukan Seminar/Sidang</button>
        </div> --}}
        <div class="mb-2">
            <div id="result"></div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table w-100" id="final-schedule-table">
                        <thead>
                            <tr>
                                <th width="25%">Judul</th>
                                <th>Mahasiswa</th>
                                <th width="19%">Tempat Tanggal Seminar</th>
                                <th width="30%">Dosen Penguji</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- Modal -->
@section('modal')
@include('modals.final_project.schedule_update')
@include('modals.final_project.detail')
@include('modals.final_project.update')
@include('modals.student.information')
@endsection

@section('javascript')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pdfobject.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/final_project/schedule.js') }}"></script>
@endsection
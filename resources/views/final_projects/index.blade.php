@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Tugas Akhir Mahasiswa')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table" id="final-project-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th width="15%">Progress</th>
                            <th width="7%"></th>
                            <th width="7%"></th>
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

@section('modal')
@include('modals.final_project.update_active')
@include('modals.final_project.verification')
@include('modals.final_project.progress_agreement')
@include('modals.final_project.detail')
@endsection

@section('javascript')
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/final_project/active.js') }}"></script>
@endsection
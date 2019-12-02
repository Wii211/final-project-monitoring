@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Data Mahasiswa')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

<!-- Content -->
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <button type="button" class="btn bg-gradient-success mb-2" data-toggle="modal" 
                data-target="#import-modal"><i class="fas fa-images"></i>Import Data</button>
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                data-target="#student-modal">Tambah Data Mahasiswa</button>

        </div>
        <div class="card">
            <div class="card-body">
                <table class="table" id="student-table">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- Modal -->
@section('modal')
    @include('modals.student.add')
    @include('modals.student.import')
    {{-- @include('modals.lecturer.detail') --}}
@endsection

@section('javascript')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/student/student.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/import.js') }}"></script>
@endsection
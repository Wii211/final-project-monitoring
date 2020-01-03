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
                data-target="#import-modal"><i class="fas fa-images"></i> Import Data</button>
            <button type="button" class="btn btn-primary mb-2" id="student-add" data-toggle="modal"
                data-target="#student-modal">Tambah Data Mahasiswa</button>

        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="student-table">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>IPK</th>
                                <th>Telepon</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/student/student.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/import.js') }}"></script>
@endsection
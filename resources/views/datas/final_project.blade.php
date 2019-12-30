@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Data Tugas Akhir')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

<!-- Content -->
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <button type="button" id="final-project-add" class="btn btn-primary mb-2" data-toggle="modal"
                data-target="#final-project-modal">Tambah Data TA</button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="final-project-table">
                        <thead>
                            <tr>
                                <th width="30%">Judul</th>
                                <th>Mahasiswa</th>
                                <th>Tanggal</th>
                                <th width="10%">Berkas</th>
                                <th width="10%">Berita Acara</th>
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
{{-- @include('modals.final_project.add') --}}
@include('modals.final_project.update')
@include('modals.final_project.news_report')
@include('modals.final_project.news_report_detail')
@include('modals.student.import')
@include('modals.student.information')
@endsection

@section('javascript')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

<!-- -->
<script type="text/javascript" src="{{ asset('assets/js/pdfobject.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/final_project/final_project.js') }}"></script>
@endsection
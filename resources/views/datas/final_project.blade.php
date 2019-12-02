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
                <table class="table" id="final-project-table">
                    <thead>
                        <tr>
                            <th width="40%">Judul</th>
                            <th width="20%">Mahasiswa</th>
                            <th width="10%">Tanggal</th>
                            <th width="15%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td>Hey aspiring content creators, submit demo musik kamu dan dapatkan kesempatan menangin
                                HP Pavilion x360, serta mentoring dari Eka.e</td>
                            <td>Winardi Chandra</td>
                            <td>29-02-2022</td>
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#newsReport">Berita Acara</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">View</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-warning btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Update</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-danger btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Delete</button>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
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
@include('modals.student.import')
@endsection

@section('javascript')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

<!-- -->
<script type="text/javascript" src="{{ asset('assets/js/final_project/final_project.js') }}"></script>
@endsection
@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Tugas Akhir')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <table class="table" id="finalStudentTable">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1610817110001</td>
                            <td>Achmad Mujaddid Islami</td>
                            <th>Status</th>
                            <td>
                                <button class="btn bg-gradient-success btn-sm w-100" data-toggle="modal"
                                    data-target="#progressFinalProject">Verifikasi</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-warning btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Update</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-danger btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject"><i class="fa fa-times-circle"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
@include('modals.final_project.progress')
@include('modals.final_project.detail')
@endsection


@section('javascript')
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lecturer/lecturer.js') }}"></script>
@endsection
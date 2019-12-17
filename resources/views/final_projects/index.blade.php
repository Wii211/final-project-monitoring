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
                <table class="table" id="final-project-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Achmad Mujaddid Islami</td>
                            <td>Update software without click</td>
                            <td><span class="badge badge-primary p-2">Pra-Proposal</span></td>
                            <td>
                                <button class="btn bg-gradient-success btn-sm w-100" data-toggle="modal"
                                    data-target="#progressFinalProject">Verifikasi</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#progressFinalProject">Progress Proposal</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#progressFinalProject">Progress Tugas Akhir</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-warning btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Update</button>
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
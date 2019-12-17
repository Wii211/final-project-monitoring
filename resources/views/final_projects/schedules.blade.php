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
        <div class="d-flex justify-content-end">
            {{-- <button type="button" class="btn bg-gradient-success mb-2" id="convert">
                <i class="fas fa-images"></i>
                Export to Image</button> --}}
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal" id="final-schedule-add"
                data-target="#final-schedule-modal">Tentukan Seminar/Sidang</button>
        </div>
        <div class="mb-2">
            <div id="result"></div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table w-100" id="final-schedule-table">
                        <thead>
                            <tr>
                                <th width="30%">Judul</th>
                                <th>Mahasiswa</th>
                                <th>Tempat Tanggal Seminar</th>
                                <th width="30%">Dosen Penguji</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                    <td>Hey aspiring content creators, submit demo musik kamu dan dapatkan kesempatan menangin
                                        HP Pavilion x360, serta mentoring dari Eka.e</td>
                                    <td>Winardi Chandra</td>
                                    <td class="p-0">
                                        <table class="table m-0">
                                            <tr>
                                                <th>Ruangan</th>
                                                <td>A16</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <td>29-02-2022</td>
                                            </tr>
                                            <tr>
                                                <th>Waktu</th>
                                                <td>00:00</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="p-0">
                                        <table class="table m-0">
                                            <tr>
                                                <th>Ketua</th>
                                                <td>M. Winarto Ramadhani</td>
                                            </tr>
                                            <tr>
                                                <th>Pembahas 1</th>
                                                <td>Wiranto Never Die</td>
                                            </tr>
                                            <tr>
                                                <th>Pembahas 2</th>
                                                <td>Winardi</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <button class="btn bg-gradient-warning btn-sm w-100" data-toggle="modal"
                                            data-target="#updateProposal">Update</button>
                                        <button class="btn bg-gradient-danger btn-sm w-100 mt-3" data-toggle="modal"
                                        data-target="#updateProposal">Delete</button>
                                    </td>
                                </tr> --}}
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
@include('modals.final_project.schedule')
@include('modals.final_project.detail')
@include('modals.final_project.update')
@endsection

@section('javascript')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/final_project/schedule.js') }}"></script>
@endsection
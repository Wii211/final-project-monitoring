@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Seminar Proposal / Sidang TA')

<!-- Content -->
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            {{-- <button type="button" class="btn bg-gradient-success mb-2" id="convert">
                <i class="fas fa-images"></i>
                Export to Image</button> --}}
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                data-target="#scheduleFinalProject">Tentukan Seminar/Sidang</button>
        </div>
        <div class="mb-2">
        <div id="result"></div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th width="40%">Judul</th>
                            <th>Mahasiswa</th>
                            <th>Tempat Tanggal Seminar</th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hey aspiring content creators, submit demo musik kamu dan dapatkan kesempatan menangin
                                HP Pavilion x360, serta mentoring dari Eka.e</td>
                            <td>Winardi Chandra</td>
                            <td>29-02-2022</td>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Detail</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-warning btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Update</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-danger btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

{{-- @section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/convertToImage.js') }}"></script>
@endsection --}}
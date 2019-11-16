@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Pra-Proposal')

<!-- Content -->
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                    data-target="#preproposal-modal">Ajukan Judul Proposal</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tipe</th>
                            <th>Status Verifikasi</th>
                            <th>Status Dosen Pembimbing</th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hey aspiring content creators, submit demo musik kamu dan dapatkan kesempatan menangin
                                HP Pavilion x360, serta mentoring dari Eka.e</td>
                            <td><span class="badge badge-primary p-2">Pra-Proposal</span></td>
                            <td><span class="badge badge-warning p-2">Menunggu Persetujuan</span></td>
                            <td><span class="badge badge-warning p-2">Menunggu Persetujuan</span></td>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Detail</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-warning btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Update</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="form-check">
                <div class="card-body">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        <b>
                            Saya menyadari bahwa setelah menekan fix/commit, saya tidak akan bisa
                            memperbarui judul lagi ke depannnya. Terkecuali atas izin dari dosen yang bersangkutan.
                        </b>
                    </label>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary w-100">Fix / Commit</button>
    </div>
</section>
@endsection

<!-- Modal -->
@section('modal')
@include('modals.final_project.submission')
@include('modals.final_project.detail')
@include('modals.final_project.update')
@endsection


@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/student/preproposal.js') }}"></script>
@endsection
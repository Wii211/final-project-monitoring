@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Update software without click</td>
                            <td><span class="badge badge-primary p-2">Tugas Akhir</span></td>
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#progressFinalProject">Progress</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:5%">#</th>
                            <th>Task</th>
                            <th style="width:60%"></th>
                            <th style="width:5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Konsultasi ke Dosen Pembimbing</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-primary" style="width: 55%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary">55%</span></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Lampiran 1</td>
                            <td><a href="#">Download Berkas Lampiran</a> </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-success mb-2" data-toggle="modal"
                    data-target="#pengajuanProposal">Ajukan ke Dosen Pembimbing</button>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
@include('modals.final_project.progress')
@include('modals.final_project.detail')
@endsection
  
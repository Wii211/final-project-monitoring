@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Daftar Mahasiswa Bimbingan')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                    data-target="#statusFinalProject"><i class="fas fa-info-circle    "></i> Keterangan Status</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1610817110001</td>
                            <td>Achmad Mujaddid Islami</td>
                            <td><span class="badge badge-primary">Revisi Proposal</span></td>
                            <td>
                                <button class="btn bg-gradient-success btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Setuju</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-danger btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Tidak Setuju</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#agreementProgress">Progress</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Detail</button>
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
        <hr>
        <div class="card">
            <div class="card-header">
                <h6>Daftar Calon Bimbingan</h6>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Ditunjuk sebagai</th>
                            <th width="10%"></th>
                            <th width="15%"></th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Achmad Mujaddid Islami</td>
                            <td>Create an application without thinking hard.</td>
                            <th><span class="badge badge-primary">Pembimbing Pertama</span></th>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Detail</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-success btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Setuju</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-danger btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Tidak Setuju</button>
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
    @include('modals.final_project.progress_agreement')
    @include('modals.final_project.detail')
    @include('modals.information.final_project_status')
@endsection

@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Tugas Akhir Mahasiswa')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th width="10%"></th>
                            <th width="10%"></th>
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
                                    data-target="#progressFinalProject">Progress</button>
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
    </div>
</section>
@endsection

@section('modal')
@include('modals.final_project.progress_view')
@include('modals.final_project.detail')
@endsection
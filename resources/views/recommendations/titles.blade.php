@extends('layouts.master')

<!-- Section Start -->
@section('title', 'Rekomendasi Judul Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            {{-- <button type="button" class="btn bg-gradient-success mb-2" id="convert">
                <i class="fas fa-images"></i>
                Import Data</button> --}}
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                data-target="#recomendationTitle">Tambah Rekomendasi Judul</button>
        </div>
        <div class="card">
            <div class="card-body pb-0">
                <form class="row" action="" method="post">
                    <div class="form-group col-md-9">
                        <input type="text" class="form-control form-control-sm" placeholder="Cari judul..." id="" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn bg-gradient-primary w-100">Cari</button>
                    </div>
                </form>
            </div>
            <div class="card-body pt-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Topik</th>
                            <th>Judul</th>
                            <th>Dosen</th>
                            <th width="30%">Keterangan</th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Microcontroller</td>
                            <td>Sayap-sayap kelam kupu-kupu</td>
                            <td>Prof. Winardi</td>
                            <td>Peler peler peler peler peler peler peler peler peler peler peler peler peler peler
                                peler</td>
                            <td>
                                <button class="btn bg-gradient-warning btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Update</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-danger btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Delete</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-success btn-sm w-100" data-toggle="modal"
                                    data-target="#updateProposal">Ambil Bgst</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
    </div>
</section>
@endsection

@section('modal')
@include('modals.final_project.recommendation')
@endsection
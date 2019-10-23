@extends('layouts.master')

<!-- Section Start -->
@section('title', 'Dashboard Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-info-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Verifikasi Mahasiswa</span>
                        <span class="info-box-number">
                            10
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Mahasiswa TA</span>
                        <span class="info-box-number">5</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{-- <button type="button" class="btn bg-gradient-success mb-2" id="convert">
                <i class="fas fa-images"></i>
                Import Data</button> --}}
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                data-target="#scheduleFinalProject">Tambah Rekomendasi Judul</button>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Topik</th>
                            <th>Judul</th>
                            <th>Dosen Pengampu</th>
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
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#lecturerDetail">Detail</button>
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
        <hr>
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Pendaftaran</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Pra-Proposal</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah pendaftaran ditutup.
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Proposal</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah pra-proposal ditutup.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Proposal</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah proposal ditutup.
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Tugas Akhir</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah revisi proposal ditutup.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Tugas Akhir</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah tugas akhir ditutup.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" data-toggle="modal"
                        data-target="#scheduleFinalProject">Perbarui Deadline</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
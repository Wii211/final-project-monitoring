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
                            <th colspan="4">Deskripsi Tugas Akhir</th>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Update software without click</td>
                            <td>Update software without click</td>
                            <td><span class="badge badge-primary p-2">Tugas Akhir</span></td>
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#progressFinalProject">Progress</button>
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
                            <th colspan="2">Dosen Pembimbing</th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pa Darmansyah</td>
                            <td>Pembimbing 1</td>
                        </tr>
                        <tr>
                            <td>Pa Husnul Khatimi</td>
                            <td>Pembimbing 2</td>
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
                            <th>Berkas</th>
                            <th style="width:60%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Pedoman Tugas Akhir</td>
                            <td><a href="#">Download Berkas Lampiran</a> </td>
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
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4">Seminar</th>
                        </tr>
                        <tr>
                            <th style="width:5%">#</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>19-19-2019</td>
                            <td>21:00</td>
                            <td>Ruangan A-16</td>
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

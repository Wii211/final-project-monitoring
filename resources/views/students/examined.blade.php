@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Daftar Mahasiswa Yang Diuji')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jadwal Pengujian</th>
                            <th>Judul</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Achmad Mujaddid Islami</td>
                            <td>1610817110001</td>
                            <td>Rabu, 16 Oktober 2019</td>
                            <td>Achmad Mujaddid Achmad Mujaddid Achmad Mujaddid Achmad Mujaddid Achmad Mujaddid </td>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">Detail</button>
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
@include('modals.final_project.progress')
@include('modals.final_project.detail')
@endsection
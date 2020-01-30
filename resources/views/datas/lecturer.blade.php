@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Data Dosen')

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
                Import Data</button> --}}
            <button type="submit" class="btn btn-primary mb-2" id="lecturerStore" data-toggle="modal"
                data-target="#lecturerModal">Tambah Data Dosen</button>

        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="lecturerTable">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>NIDN</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jumlah <br> Bimbingan-1</th>
                                <th>Jumlah <br> Bimbingan-2</th>
                                <th>Status</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

{{-- Modal --}}
@section('modal')
@include('modals.lecturer.store')
@include('modals.lecturer.detail')
@endsection

{{-- Javascript --}}

@section('javascript')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lecturer/lecturer.js') }}"></script>
@endsection

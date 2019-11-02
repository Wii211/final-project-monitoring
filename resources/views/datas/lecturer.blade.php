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
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                data-target="#scheduleFinalProject">Tambah Data Dosen</button>

        </div>
        <div class="card">
            <div class="card-body">
                <table class="table" id="lecturerTable">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- Modal --}}
@section('modal')
    @include('modals.lecturer.detail')
@endsection

{{-- Javascript --}}

@section('javascript')
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lecturer/lecturer.js') }}"></script>
@endsection
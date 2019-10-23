@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Data Tugas Akhir')

@section('galery')
<link rel="stylesheet" href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

<!-- Content -->
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn bg-gradient-success mb-2" data-toggle="modal"
                data-target="#pengajuanProposal">Export Data</button>
            <button type="submit" class="btn btn-primary mb-2" data-toggle="modal"
                data-target="#pengajuanProposal">Tambah Data TA</button>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="40%">Judul</th>
                            <th width="20%">Mahasiswa</th>
                            <th width="10%">Tanggal</th>
                            <th width="15%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hey aspiring content creators, submit demo musik kamu dan dapatkan kesempatan menangin
                                HP Pavilion x360, serta mentoring dari Eka.e</td>
                            <td>Winardi Chandra</td>
                            <td>29-02-2022</td>
                            <td>
                                <button class="btn bg-gradient-primary btn-sm w-100" data-toggle="modal"
                                    data-target="#newsReport">Berita Acara</button>
                            </td>
                            <td>
                                <button class="btn bg-gradient-info btn-sm w-100" data-toggle="modal"
                                    data-target="#detailFinalProject">View</button>
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
    </div>
</section>
@endsection

<!-- Modal -->
@section('modal')
@include('modals.final_project.submission')
@include('modals.final_project.detail')
@include('modals.final_project.news_report')
@include('modals.final_project.update')
@endsection

@section('javascript')
<script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/fileSaver.js') }}"></script> --}}
<script>
    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

//         $('#convertImageToPDF').click(function () {
//             var imgData = screen.toDataURL();
//             imgData = imgData.substr(22);
//             imgData = atob(imgData);

//             let zip = new JSZip();
//             zip.file(imgData, imgData);
//             zip.generateAsync({
//                     type: "blob"
//                 })
//                 .then(function (content) {
//                     saveAs(content, "example.zip");
//                 });
//         })
//     })
// </script>


@endsection
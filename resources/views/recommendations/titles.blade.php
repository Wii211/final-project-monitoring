@extends('layouts.master')

<!-- Section Start -->
@section('title', 'Rekomendasi Judul Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        @if(Auth::user()->isAdmin())
        <div class="d-flex justify-content-end">
            {{-- <button type="button" class="btn bg-gradient-success mb-2" id="convert">
                <i class="fas fa-images"></i>
                Import Data</button> --}}
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" id="addRecommendationTitle"
                data-target="#recomendationTitleModal">Tambah Rekomendasi Judul</button>
        </div>
        @endif
        <div class="card">
            <div class="card-body pb-0">
                <form class="row" action="{{route('recomendation-title.index')}}" method="GET">
                    <div class="form-group col-md-9">
                        <input type="text" name="q" class="form-control form-control-sm" placeholder="Cari judul..."
                            id="" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" value="q" class="btn bg-gradient-primary w-100">Cari</button>
                    </div>
                </form>
                <div class="mt-3">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        Berhasil. Judul milik ini anda!
                    </div>
                    @elseif(Session::has('failed'))
                    <div class="alert alert-danger" role="alert">
                        Error
                    </div>
                    @elseif(Session::has('duplicate'))
                    <div class="alert alert-warning" role="alert">
                        Anda mengambil judul yang lain. Jangan maruk!
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table" id="recommendationTitleTable">
                        <thead>
                            <tr>
                                <th>Topik</th>
                                <th>Judul</th>
                                <th>Dosen</th>
                                <th width="30%">Keterangan</th>
                                @if(Auth::user()->isAdmin())
                                <th width="5%"></th>
                                <th width="5%"></th>
                                @endif
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recomendationTitles as $title)


                            <tr>
                                <td>
                                    <ul>
                                        @foreach ($title->topics as $topic)
                                        <li>{{$topic->name}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td> {{$title->title}} </td>
                                <td>{{$title->lecturer->name}}</td>
                                <td>{{$title->description}}</td>
                                @if(Auth::user()->isAdmin())
                                <td>
                                    <button class="btn bg-gradient-warning btn-sm w-100 update"
                                        id="{{ $title->id }}">Update</button>
                                </td>
                                <td>
                                    <button class="btn bg-gradient-danger btn-sm w-100 delete"
                                        id="{{ $title->id }}">Delete</button>
                                </td>
                                @elseif(Auth::user()->isStudent())
                                <td>
                                    @if(!$title->final_student_id)
                                    <form action="{{ route('pre_proposal.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="title" value="{{ $title->title }}">
                                        <input type="hidden" name="title_id" value="{{ $title->id }}">
                                        <input type="hidden" name="supervisors[]" value="{{ $title->lecturer->id }}">
                                        <input type="hidden" name="supervisors[]" value="1">
                                        <input type="hidden" name="type" value="recommendation-title">
                                        <button class="btn bg-gradient-success btn-sm w-100" data-toggle="modal"
                                            data-target="#updateProposal">Ambil</button>
                                    </form>
                                    @elseif($title->final_student_id === Auth::user()->finalStudent->id)
                                    <span class="badge badge-warning">Judul telah anda ambil</span>
                                    @else
                                    <span class="badge badge-danger">Judul telah diambil</span>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="pagination"> {{ $recomendationTitles->links() }} </div>
            </div>
        </div>
        <hr>

    </div>
</section>
@endsection

@section('modal')
@include('modals.final_project.recommendation')
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/title/title.js') }}"></script>
@endsection

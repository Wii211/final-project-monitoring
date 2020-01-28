@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Profil Saya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-widget widget-user-2">
            <div class="d-flex justify-content-center">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/design/undraw_profile_6l1l.png') }}" class="w-100" srcset="">
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                @if(Auth::user()->finalStudent !== null)
                                <h4 class="mb-0">{{ Auth::user()->finalStudent->name }} ({{ Auth::user()->finalStudent->student_id }})</h4>
                                @else
                                <h4 class="mb-0">{{ Auth::user()->user_name }}</h4>
                                @endif
                            <hr class="mb-3 mt-1">
                            </div>
                            <div class="col-md-12">
                                @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    Berhasil. Profil telah diperbaharui.
                                </div>
                                @elseif(Session::has('failed'))
                                <div class="alert alert-danger" role="alert">
                                    Error. Terjadi kesalahan.
                                </div>
                                @endif
                                <form action="{{route('change_profile.update', ['id' => Auth::user()->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Profile</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    value="{{ $data->user_name }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-sm"
                                                    name="email" placeholder="Email" value="{{ $data->email }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="phone_number" placeholder="Nomor Telepon" value="{{ $data->phone_number }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block" for="image-profile">Upload Foto Profile</label>
                                        <small>
                                            Ukuran maks. 1 MB :: Format .PNG, .JPEG, .JPG
                                        </small>
                                        <input type="file" class="form-control-file mt-2" name="image_profile"
                                            id="image-profile" accept="image/*">
                                    </div>
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="btn btn-primary mb-2 w-100">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@section('javascript')
@endsection
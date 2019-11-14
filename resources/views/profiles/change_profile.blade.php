@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Profil Saya')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-widget widget-user-2">
            <div class="d-flex justify-content-center">
                <div class="widget-user-header">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ $data->image_profile }}" alt="User Avatar">
                    </div>
                    <h3 class="widget-user-username">{{ Auth::user()->finalStudent->name }}</h3>
                    <h5 class="widget-user-desc">{{ Auth::user()->finalStudent->student_id }}</h5>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    Berhasil
                </div>
                @elseif(Session::has('failed'))
                <div class="alert alert-danger" role="alert">
                    Error
                </div>
                @endif
                    <form action="{{route('change_profile.update', ['id' => Auth::user()->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Profile</label>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $data->user_name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="phone_number"
                                        value="{{ $data->phone_number }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block" for="image-profile">Upload Foto Profile</label>
                                    <small>
                                        Ukuran maks. 1 MB <br>
                                        Format .PNG, .JPEG, .JPG
                                    </small>
                                    <input type="file" class="form-control-file mt-2" name="image-profile"
                                        id="image-profile">
                                </div>
                            </div>
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="btn btn-primary mb-2 w-100">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection


@section('javascript')
@endsection
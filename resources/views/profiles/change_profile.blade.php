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
                        <img class="img-circle elevation-2" src="{{ asset('assets/dist/img/user7-128x128.jpg') }}"
                            alt="User Avatar">
                    </div>
                    <h3 class="widget-user-username">Nadia Carmichael</h3>
                    <h5 class="widget-user-desc">171082171001</h5>
                </div>
            </div>
            <div class="card-body">
                    <form action="">
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Profile</label>
                                <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" value="maayadestra" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="No. Telepon" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block" for="exampleFormControlFile1">Upload Foto Profile</label>
                                <small>
                                    Ukuran maks. 1 MB <br>
                                    Format .PNG, .JPEG, .JPG
                                </small>
                                <input type="file" class="form-control-file mt-2" id="exampleFormControlFile1">
                            </div>
                        </div>
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
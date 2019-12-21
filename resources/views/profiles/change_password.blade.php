@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Ganti Password')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
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
                <form action="{{route('change_password.update', ['id' => Auth::user()->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">

                            <div class="form-group row">
                                <label class="col-md-3" for="oldPassword">Password Lama</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control form-control-sm" id="oldPassword"
                                        name="old_password" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-md-3" for="password">Password Baru</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control form-control-sm" id="password"
                                        name="password" minLength="8" maxlength="16" required>
                                    <div id="passwordStatus"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3" for="exampleFormControlInput1">Konfirmasi Password Baru</label>
                                <div class="col-md-9">
                                    <small class="form-text">Panjang kata sandi harus 8-16 karakter.</small>
                                    <input type="password" class="form-control form-control-sm" id="confirmPassword"
                                        minLength="8" maxlength="16" name="confirm_password" required>
                                    <div id="confirmStatus"></div>
                                </div>
                            </div>
                            <input type="hidden" name="_method" value="PUT">
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('storage/design/undraw_my_password_d6kg.png') }}" class="w-100" srcset="">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mb-2 w-100" data-toggle="modal"
                                data-target="#pengajuanProposal">
                                <i class="fas fa-key mr-2"></i>
                                Ganti Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/changePassword.js') }}"></script>
@endsection
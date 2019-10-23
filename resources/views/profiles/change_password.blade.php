@extends('layouts.master')

<!-- Section Start -->
<!-- If() -->
@section('title', 'Ganti Password')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="form-group row">
                        <label class="col-3" for="oldPassword">Password Lama</label>
                        <div class="col-9">
                            <input type="password" class="form-control form-control-sm" id="oldPassword"
                                name="old_password" required minLength="8" maxlength="16" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3" for="password">Password Baru</label>
                        <div class="col-9">
                            <input type="password" class="form-control form-control-sm" id="password" name="password"
                                minLength="8" maxlength="16" required>
                            <div id="passwordStatus"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3" for="exampleFormControlInput1">Konfirmasi Password Baru</label>
                        <div class="col-9">
                            <small class="form-text">Panjang kata sandi harus 8-16 karakter.</small>
                            <input type="password" class="form-control form-control-sm" id="confirmPassword"
                                minLength="8" maxlength="16" name="confirm_password" required>
                            <div id="confirmStatus"></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mb-2 w-100" data-toggle="modal" data-target="#pengajuanProposal">
            <i class="fas fa-key mr-2"></i>
            Ganti Password</button>
    </div>
</section>
@endsection


@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/changePassword.js') }}"></script>
@endsection
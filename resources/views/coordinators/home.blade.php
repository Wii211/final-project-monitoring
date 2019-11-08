@extends('layouts.master')

<!-- Section Start -->
@section('title', 'Dashboard Tugas Akhir')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Pendaftaran</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Pra-Proposal</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah pendaftaran ditutup.
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Proposal</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah pra-proposal ditutup.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Proposal</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah proposal ditutup.
                        </div>
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Tugas Akhir</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah revisi proposal ditutup.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exampleFormControlInput1">Deadline Revisi Tugas Akhir</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1"> Hari setelah tugas akhir ditutup.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" data-toggle="modal"
                        data-target="#scheduleFinalProject">Perbarui Deadline</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
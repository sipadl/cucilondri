@extends('layouts.temp')
@section('content')
<div class="card">
    {{-- <div class="d-flex"> --}}
        <div class="card-header">
            Ubah Password
        </div>
    {{-- </div> --}}
    <div class="card-body">
        <div class="row">
            <form action="{{route('edit.passwords')}}" method="post">
                @csrf
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-md-3">Password Lama</label>
            <div class="col-md-5">
                <input type="password" class="form-control" name="password_old" id="" required>
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-md-3">Password Baru</label>
            <div class="col-md-5">
                <input type="password" class="form-control" name="password_new" id="" required>
            </div>
        </div>
        <div class="form-group row mb-2">
            <label for="" class="label-form-col col-md-3">Konfirmasi Password</label>
            <div class="col-md-5">
                <input type="password" class="form-control" name="password_confirmation" id="" required>
            </div>
        </div>
        <div class="col mt-4">
            <button type="submit" class="btn btn-info text-light">Simpan</button>
            <a href="{{ url('user/dashboard') }}" class="btn btn-danger text-light">Batal</a>
        </div>
    </form>
    </div>
    </div>
</div>
@endsection
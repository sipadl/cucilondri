@extends('layouts.temp')
@section('content')
<div class="card text-left">
    <div class="card-header mb-1">
        <div class="d-flex justify-content-between">
            <h4>Cabang</h4>
            <div class="">
                <span class="badge bg-primary p-2">
                    <a class="text-light p-2" data-bs-toggle="modal" href="javascript:;" data-bs-target="#exampleModal">
                        Tambah Baru
                    </a>
                </span>
            </div>
        </div>
    </div>
    @php
        $i = 1;
    @endphp
    <div class="card-body">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Nama Pemilik</th>
                    <th>No. Telpon</th>
                    <th>Pendapatan</th>
                    <th>Piutang</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $item)

                <tr class="text-center">
                    <td>{{$i++}}</td>
                    <td>{{$item['name'] }}</td>
                    <td>{{$item['phone'] }}</td>
                    <td>Rp {{number_format($item['keuntungan'] ,1) }}</td>
                    <td>Rp {{number_format($item['piutang'] ,1) }}</td>
                    <td>{{($item['status']  == 1)?"Aktif":"Tidak Aktif"}}</td>
                    <td>{{($item['role']  == 0 )?'Cabang':'Administrator'}}</td>
                    <td>
                        <span class="badge bg-info">
                            <a href="javascript:;" onclick="get({{$item['id']}})" data-bs-toggle="modal" href="javascript:;" data-bs-target="#EditModal" class="text-light">Ubah</a>
                        </span>
                        {{-- <span class="badge bg-secondary">
                            <a href="{{ route('deaktifs',[$item->id_user]) }}" class="text-light">Deaktif</a>
                        </span> --}}
                        <span class="badge bg-danger">
                            <a href="{{ route('destroys',[ $item['id'] ]) }}" class="text-light">Hapus</a>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $user->links() }}
  </div>
</div>

{{-- Modal Add --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Cabang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('user/mitra') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Nama Pemilik</label>
                    <div class="col-8">
                        <input required name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Email</label>
                    <div class="col-8">
                        <input required type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Username</label>
                    <div class="col-8">
                        <input required type="text" name="username" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">No. Telpon</label>
                    <div class="col-8">
                        <input required  name="phone" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Alamat</label>
                    <div class="col-8">
                        <textarea name="address" id="" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
      </div>
    </div>
</div>

    {{-- Edit User --}}
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Cabang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('update.mitra') }}" method="post">
            @csrf
            <input required type="hidden" name="id" id="id">
            <div class="modal-body">
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Nama Pemilik</label>
                    <div class="col-8">
                        <input required name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Email</label>
                    <div class="col-8">
                        <input required type="email" id="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Username</label>
                    <div class="col-8">
                        <input required type="text" id="username" name="username" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">No. Telpon</label>
                    <div class="col-8">
                        <input required  name="phone" id="phone" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Alamat</label>
                    <div class="col-8">
                        <textarea name="address" id="address" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="label-form-col col-4 p-1">Role</label>
                    <div class="col-8">
                        <select name="role" class="form-control" id="role" required>
                            <option value="#">Pilih Salah Satu</option>
                            <option value="0">Cabang</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
      </div>
    </div>

    @section('js')
    <script>
        function get(i)
        {
            $.get(`http://127.0.0.1:8000/user/show/${i}`, {},
                function (data) {
                    $('#id').val(data.id)
                    $('#name').val(data.name)
                    $('#address').val(data.address)
                    $('#phone').val(data.phone)
                    $('#email').val(data.email)
                    $('#username').val(data.username)
                    $('#role').val(data.role)
                },
            );
        }
    </script>
    @endsection
@endsection
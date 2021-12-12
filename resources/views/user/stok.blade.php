@extends('layouts.temp')
@section('content')
<div class="card borderless">
    <div class="d-flex justify-content-between card-header">
        <div class="">
            <h5>Pengaturan Stok</h5>
        </div>
        <div class="mt-1">
            <a href="javascript:;" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
                Tambahkan Barang Baru
            </a>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-12">
            </div>
            <div class="p-2">
                <table class="table" id="datatabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Stok</th>
                            <th>Suplier</th>
                            <th>Harga/Pcs</th>
                            <th>Last Updated</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($stok as $data)
                        <tr>
                            <td scope="row">{{ $i++ }}</td>
                            <td>{{$data->product}}</td>
                            <td>{{$data->stock}}</td>
                            <td>{{ $data->suplier->name }}</td>
                            <td>{{'Rp '.number_format($data->price,0,',','.')}}</td>
                            <td>{{ $date->updated_at??$data->created_at }}</td>
                            <td>
                                <span><a class="badge bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="get({{$data->id}})" href="javascript:;">Ubah</a></span>
                                <span><a class="badge bg-secondary text-light" href="{{ route('stok.edit', $data->id) }}">{{ ($data->status == 1)?'Non Aktifkan':'Aktifkan' }}</a></span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="newModalLabel">Tambahkan Produk Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('user/stok') }}" method="post">
                @csrf
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Nama Produk</label>
                    <div class="col-md-8">
                        <input type="text" name="product" id="" class="form-control" placeholder="e.g Pemutih, Detergen" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Stok Produk</label>
                    <div class="col-md-8">
                        <input type="number" name="stock" id="" class="form-control" min="1" value="1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Harga Produk</label>
                    <div class="col-md-8">
                        <input type="number" name="price" id="" class="form-control" min="1000" value="1000" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Suplier Produk</label>
                    <div class="col-md-8">
                        <select name="id_suplier" class="form-control" id="">
                            <option value="0">Chosse One</option>
                            @foreach($suplier as $sup)
                            <option value="{{ $sup->id }}">{{$sup->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="updateModalLabel">Ubah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('stoks.updated') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Nama Produk</label>
                    <div class="col-md-8">
                        <input type="text" name="product" id="produk" class="form-control" placeholder="e.g Pemutih, Detergen" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Stok Produk</label>
                    <div class="col-md-8">
                        <input type="number" name="stock" id="stok" class="form-control" min="1" value="1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Harga Produk</label>
                    <div class="col-md-8">
                        <input type="number" name="price" id="harga" class="form-control" min="1000" value="1000" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <input type="hidden" name="status" value="1">
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Suplier Produk</label>
                    <div class="col-md-8">
                        <select name="id_suplier" class="form-control" id="suplier">
                            <option value="0">Pilih Satu</option>
                            @foreach($suplier as $sup)
                            <option value="{{ $sup->id }}">{{$sup->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready( function () {
        $('#datatabel').DataTable({
            select:false,
        });
    } );

    function get(i)
    {
        $.get(`http://127.0.0.1:8000/user/stok/${i}`, {},
            function (data, textStatus, jqXHR) {
                console.log(data)
                $('#id').val(i)
                $('#produk').val(data.product)
                $('#harga').val(data.price)
                $('#stok').val(data.stock)
                $('#suplier').val(data.id_suplier)
            },
        );
    }
</script>
@stop
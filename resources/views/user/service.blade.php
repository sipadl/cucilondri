@extends('layouts.temp')
@section('content')
<div class="card borderless">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="a">
                <h5>Pengaturan Layanan</h5>
            </div>
            <div class="a"><a href="javascript:;" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
                Tambahkan Layanan Baru
            </a></div>
        </div>
    </div>
    <div class="tabels p-2">
            <table class="table" id="datatabel">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Layanan</th>
                        <th>Kode</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Diskon Member</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                @foreach($service as $data)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->code}}</td>
                    <td>{{'Rp '.number_format($data->price,0,',','.')}}</td>
                    <td>{{$data->duration.' Days'}}</td>
                    <td>{{'Rp '.number_format($data->member_discount,0,',','.')}}</td>
                    <td> <span class="badge bg-light text-dark">{{ ($data->status == 1)?'Active':'Deactive' }}</span></td>
                    <td>
                        <span><a class="badge bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="get({{$data->id}})" href="javascript:;">Ubah</a></span>
                        <span><a class="badge bg-secondary text-light" href="{{ route('service.edit', $data->id) }}">{{ ($data->status == 1)?'Non Aktifkan':'Aktifkan' }}</a></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal New --}}
<div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="newModalLabel">Tambahkan Layanan Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('user/service') }}" method="post">
                @csrf
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Nama Layanan</label>
                    <div class="col-md-8">
                        <input type="text" name="name" id="" class="form-control" placeholder="e.g Cuci Londri Express" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Kode Layanan</label>
                    <div class="col-md-8">
                        <input type="text" name="code" id="" class="form-control" placeholder="e.g CGX, CGS" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Harga Layanan</label>
                    <div class="col-md-8">
                        <input type="number" name="price" id="" class="form-control" min="1000" value="1000" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Durasi Layanan</label>
                    <div class="col-md-8">
                        <input type="number" name="duration" id="" class="form-control" min="1" value="1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Member Diskon</label>
                    <div class="col-md-8">
                        <input type="number" name="member_discount" id="" class="form-control" min="0" value="0" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Status</label>
                    <div class="col-md-8">
                        <select type="number" name="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
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

{{-- Modal Update --}}
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="updateModalLabel">Ubah Layanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('service.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Nama Layanan</label>
                    <div class="col-md-8">
                        <input type="text" name="name" id="name" class="form-control" placeholder="e.g Cuci Londri Express" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Kode Layanan</label>
                    <div class="col-md-8">
                        <input type="text" name="code" id="kode" class="form-control" placeholder="e.g CGX, CGS" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Harga Layanan</label>
                    <div class="col-md-8">
                        <input type="number" name="price" id="harga" class="form-control" min="1000" value="1000" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Durasi Layanan</label>
                    <div class="col-md-8">
                        <input type="number" name="duration" id="durasi" class="form-control" min="1" value="1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Member Diskon</label>
                    <div class="col-md-8">
                        <input type="number" name="member_discount" id="diskon" class="form-control" min="0" value="0" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Status</label>
                    <div class="col-md-8">
                        <select type="number" name="status" id="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
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
    let url = window.location.host
    function get(i){
        $.get(`service/${i}`,
            function (data) {
                console.log(data)
                $('#id').val(i)
                $('#name').val(data.name)
                $('#harga').val(data.price)
                $('#kode').val(data.code)
                $('#durasi').val(data.duration)
            },
        );
    }
</script>
@stop
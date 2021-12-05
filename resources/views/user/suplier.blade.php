@extends('layouts.temp')
@section('content')
<div class="card borderless">
    <div class="d-flex justify-content-between card-header">
        <div class="">
            <h5>Supliers Settings</h5>
        </div>
        <div class="mt-1">
            <a href="javascript:;" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
                Add New Supliers
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
                            <th>Name Supliers</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($data as $data)
                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{ $data->address }}</td>
                            <td>
                                <span><a class="badge bg-warning text-dark" onclick="get({{$data->id}})" href="javascript:;">Update</a></span>
                                <span><a class="badge bg-secondary text-light" href="javascript:;">Disable</a></span>
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
          <h5 class="modal-title" id="newModalLabel">Add New Supliers</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('user/suplier') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Name Suplier</label>
                    <div class="col-md-8">
                        <input type="text" name="name" id="" class="form-control" placeholder="e.g Rudi Suharto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Phone Suplier</label>
                    <div class="col-md-8">
                        <input type="number" name="phone" id="" class="form-control" placeholder="e.g 081290..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <input type="hidden" name="ext" value="null">
                <input type="hidden" name="status" value="1">
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Address Suplier</label>
                    <div class="col-md-8">
                        <textarea name="address" id="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
                    </div>
                </div>
                <div class="form-input row mb-2">
                    <label for="" class="label-form-col col-md-4">Address Suplier</label>
                    <div class="col-md-8">
                        <input type="file" name="photos" class="form-control" id="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
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
</script>
@stop
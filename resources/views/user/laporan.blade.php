@extends('layouts.temp')
@section('content')
<div class="card">
    <div class="card-header">
    <div class="d-flex justify-content-between">
        <div class="w-75">
            <h6>Laporan</h6>
        </div> 
            <div class="">
                <span class="badge bg-primary"><a class="text-light" href="javascript:;" onclick="mitra()">Kemitraan</a></span>
                <span class="badge bg-primary"><a class="text-light" href="javascript:;" onclick="print()">print</a></span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-2">
                <form action="" method="post">
                <div class="form-group row">
                        @csrf
                        <div class="col-md-4 col-xs-12">
                            <label for="">Dari</label>
                            <input type="date" name="start" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label for="">Sampai</label>
                            <input type="date" name="end" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="mt-4"></div>
                            <button type="submit" class="btn btn-info text-light d-block">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <table class="table" id="tables">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No. Order</th>
                            <th>Pelanggan</th>
                            <th>Berat</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Layanan</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                         $i = 1;   
                        @endphp
                        @foreach($trans as $tr)
                        @php
                            $data = json_decode($tr->ext);
                            $layanan = DB::table('service')->where('id', $data->service_id)->first();
                            switch ($tr->status) {
                                case '1':
                                    $status = 'Cuci';
                                    break;
                                case '2':
                                    $status = 'Setrika';
                                    break;
                                case '3':
                                    $status = 'Selesai';
                                    break;
                                case '4':
                                    $status = 'Diambil';
                                    break;
                                default:
                                    $status = 'Proses';
                                    break;
                            }
                        @endphp
                        <tr class="text-center">
                            <td scope="row">{{$i++}}</td>
                            <td>{{ $tr->created_at }}</td>
                            <td>{{ $layanan->code.'-'.$tr->order_number }}</td>
                            <td>{{ $tr->name }}</td>
                            <td>{{ $tr->weight.' Kg' }}</td>
                            <td>{{ 'Rp '.number_format($tr->price,'0',',','.') }}</td>
                            <td>{{ $status }}</td>
                            <td>{{ $layanan->name }}</td>
                            <td>{{ ($tr->payment_type == 1)?'Lunas':'Belum lunas' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
function print()
{
    $("#tables").table2excel({
        // exclude: ".excludeThisClass",
        name: "Laporan",
        filename: "laporan.xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
    });
}
</script>
@stop

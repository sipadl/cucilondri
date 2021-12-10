@extends('layouts.temp')
@section('content')
<div class="content">
    <div class="d-flex">
        <div class="card mx-2 w-50 text-center">
            <h6 class="card-header mb-1">Transaksi</h6>
            <div class="d-flex justify-content-around mb-2">
                <div class="text-center mx-2">
                    <span class="mx-2 text-success">{{$berhasil}}</span><br>
                    <p class="card-text" href="#">Berhasil</p>
                </div>
                <div class="text-center mx-2">
                    <span class="mx-2 text-warning">{{$proses}}</span><br>
                    <p class="card-text" href="#">Proses</p>
                </div>
                <div class="text-center mx-2">
                    <span class="mx-2 text-danger">{{$gagal}}</span><br>
                    <p class="card-text" href="#">Batal</p>
                </div>
            </div>
        </div>
        <div class="card mx-2 w-25 text-center">
            <h6 class="card-header mb-1">Keuangan /Bulan</h6>
            <div class="d-flex justify-content-around mb-2">
                <div class="income text-center">
                    <span class="text-success">Rp. {{ number_format($profit,0,',','.') }}</span><br>
                    <p class="card-text" href="#">Pemasukan</p>
                </div>
                <div class="income text-center">
                    <span class="text-danger">Rp. {{ number_format($piutang,0,',','.') }}</span><br>
                    <p class="card-text" href="#">Piutang</p>
                </div>
            </div>
        </div>
        <div class="card mx-2 w-25">
                <h6 class="card-header mb-1">Stok</h6>
                <p class="card-text">Text</p>
        </div>
    </div>
    <div class="card p-2 m-1 mt-2">
        <table class="table" id="table_id">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Pemilik</th>
                    <th>Berat</th>
                    <th>Layanan</th>
                    <th>Biaya</th>
                    <th>Status</th>
                    {{-- <th>#</th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $y = 1;
                @endphp
                @foreach($transaction as $tr)
                @php
                    $data = json_decode($tr->ext);
                    $layanan = DB::table('service')->where('id', $data->service_id)->first();
                    $status = DB::table('status')->where('code',$tr->status)->first();
                @endphp
                <tr>
                    <td scope="row">{{$y++}}</td>
                    <td>{{ $layanan->code.'-'.$tr->order_number }}</td>
                    <td>{{ $tr->name }}</td>
                    <td>{{ $tr->weight }}</td>
                    <td>{{ $layanan->name }}</td>
                    <td>{{ 'Rp '.number_format($tr->price,'0',',','.') }}</td>
                    <td><span class="badge bg-info">{{ ($tr->payment_type == 1 )?'Lunas':'Belum Dibayar' }}</span></td>
                    {{-- <td>
                        <a href="#" class="btn btn-sm btn-primary">modal</a>
                        </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
@stop
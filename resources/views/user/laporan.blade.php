@extends('layouts.temp')
@section('content')
<input type="hidden" id="time" value={{ date('Y-m-d h:i:s', time())}}>
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
                <div class="form-group row">
                        @csrf
                        <div class="col-md-4 col-xs-12">
                            <label for="">Dari</label>
                            <input type="date" id="start" name="start" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label for="">Sampai</label>
                            <input type="date" name="end" id="end" class="form-control">
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="mt-4"></div>
                            <button type="button" onclick="Cari()" class="btn btn-info text-light d-block">Cari</button>
                        </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table" id="tables">
                    <thead>
                        <tr class="text-center">
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
                    <tbody id="datass">                        
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
<script>
    var start = $('#start');
    var end = $('#end');
    var time = $('#time').val();
    $(window).on('load', function(){
        start.val(time)
        end.val(time)
    })
    function Cari()
    {
        $.get("{{route('getLaporn')}}", {x:start.val(), y:end.val()},
            function (data) {
            data.forEach(isi => {
                console.log(isi)
                $('#datass').append(
                    `<tr class="text-center">
                        <td>${isi.created_at}</td>
                        <td>${isi.no_order}</td>
                        <td>${isi.name}</td>
                        <td>${isi.weight} Kg</td>
                        <td>Rp ${isi.total}</td>
                        <td>${isi.status}</td>
                        <td>${isi.layanan}</td>
                        <td>${isi.status}</td>
                    </tr>`
                    )
                });
            },
        );
    }
</script>
@stop

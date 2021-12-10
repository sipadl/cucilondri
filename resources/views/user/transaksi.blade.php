@extends('layouts.temp')
@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="new" aria-selected="true">Buat Transaksi</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Member Transaksi</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">List Transaksi</button>
    </li>
</ul>
  <div class="tab-content" id="myTabContent">
    {{-- New Customer --}}
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card my-2">
            {{-- <div class="alert alert-danger mx-4 my-4" role="alert">
                <strong>error</strong>
            </div> --}}
            <div class="card-header"><h6>Buat Transaksi</h6></div>
            <div class="card-body">
                <form action="{{ url('user/transaction') }}" id="new" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 col-xs-12">
                            <h5>Informasi Pelanggan</h5>
                        <hr>
                        <div class="form-group row mb-2">
                            <label for="" class="label-form-col col-md-2">Nama Pelanggan</label>
                            <div class="col-md-10">
                                <input type="text" name="name" id="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="" class="label-form-col col-md-2">No. Telpon Pelanggan</label>
                            <div class="col-md-10">
                                <input type="text" name="phone" id="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="" class="label-form-col col-md-2">Alamat Pelanggan</label>
                            <div class="col-md-10">
                                <textarea name="address" rows="4" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        <h5>Informasi Laundry</h5>
                        <hr>
                        <div class="form-group row mb-2">
                            <label for="" class="label-form-col col-md-2">Berat Laundry</label>
                            <div class="col-md-5">
                                <input type="text" name="weight" class="form-control weight">
                            </div>
                        </div>
                        <div class="form-group row mb-2" id="servicess" style="display:none">
                            <label for="" class="label-form-col col-md-2">Layanan Laundry</label>
                            <div class="col-md-5">
                                <select name="service_id" class="form-control services" onchange="run()">
                                    <option value="0">Pilih Satu Layanan</option>
                                    @foreach($service as $sec)
                                    {{-- <div class="form-check" id="servicecol">
                                        <input class="form-check-input"  value="{{$sec->id}}" type="radio" name="service_id" id="service{{$sec->id}}">
                                        <label class="form-check-label" for="service{{$sec->id}}">
                                            {{$sec->name.' (Duration '.$sec->duration.' Day)'}}
                                        </label>
                                    </div>     --}}
                                    <option value="{{ $sec->id }}">{{ $sec->name.' (Durasi '.$sec->duration.' Hari)' }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 payment" style="display:none">
                            <div class="card">
                            <div class="card-header">
                                <h5>Informasi Biaya</h5>
                            </div>
                            <div class="p-2">
                                <div class="form-group row berat">
                                    <label for="" class="label-for-col col-md-6 col-6">Berat</label>
                                    <div class="col-md-6 col-6">
                                        <span id="berat">0 Kg</span>
                                    </div>
                                </div>
                                <div class="form-group row biaya">
                                    <label for="" class="label-for-col col-md-6 col-6">Biaya Service</label>
                                    <div class="col-md-6 col-6">
                                        <span id="biaya"> /Kg</span>
                                    </div>
                                </div>
                                <div class="form-group row total">
                                    <label for="" class="label-for-col col-md-6 col-6">Total</label>
                                    <input type="hidden" name="price" class="price" value="">
                                    <div class="col-md-6 col-6">
                                        <span id="total"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row p-2">
                                <label for="" class="label-form-col col-md-6 col-12">
                                    Tipe Pembayaran
                                </label>
                                <div class="col-md-6 col-12">
                                    <select name="payment_tipe" class="form-control" id="">
                                        <option value="0">Pilih Salah Satu</option>
                                        <option value="1">Bayar Sekarang</option>
                                        <option value="2">Bayar Nanti</option>
                                    </select>
                                </div>
                            </div>
                            <div class="payment text-center" style="display: none">
                                <button class="btn btn-secondary my-2" type="submit">Buat Order</button>
                                <button class="btn btn-danger" type="reset">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            <input type="hidden" name="status" value="0">
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
            <div class="card-header">
                <h6>Member Transaksi</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('user/transaction') }}" id="new" method="post">
                    @csrf
                    <input type="hidden" name="is_member" value="1">
                    <div class="row">
                        <div class="col-md-9 col-xs-12">
                            <h5>Informasi Pelanggan</h5>
                        <hr>
                        <div class="form-group row mb-2">
                            <label for="" class="label-form-col col-md-2">Nama Pelanggan</label>
                            <div class="col-md-10">
                                <select name="member_id" class="form-control" id="">
                                    <option value="0">Pilih Member</option>
                                    @foreach($customer as $co)
                                    <option value="{{ $co->id }}">{{ $co->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h5>Informasi Laundry</h5>
                        <hr>
                        <div class="form-group row mb-2">
                            <label for="" class="label-form-col col-md-2">Berat Laundry</label>
                            <div class="col-md-5">
                                <input type="text" name="weight" class="form-control weight1">
                            </div>
                        </div>
                        <div class="form-group row mb-2" id="servicess1" style="display:none">
                            <label for="" class="label-form-col col-md-2">Layanan Laundry</label>
                            <div class="col-md-5">
                                <select name="service_id" class="form-control services1" onchange="member()">
                                    <option value="0">Pilih Satu Layanan</option>
                                    @foreach($service as $sec)
                                    <option value="{{ $sec->id }}">{{ $sec->name.' (Durasi '.$sec->duration.' Hari)' }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 payment" style="display:none">
                            <div class="card">
                            <div class="card-header">
                                <h5>Informasi Biaya</h5>
                            </div>
                            <div class="p-2">
                                <div class="form-group row berat">
                                    <label for="" class="label-for-col col-md-6 col-6">Berat</label>
                                    <div class="col-md-6 col-6">
                                        <span id="berat1">0 Kg</span>
                                    </div>
                                </div>
                                <div class="form-group row biaya">
                                    <label for="" class="label-for-col col-md-6 col-6">Biaya Service</label>
                                    <div class="col-md-6 col-6">
                                        <span id="biaya1"> /Kg</span>
                                    </div>
                                </div>
                                <div class="form-group row total">
                                    <label for="" class="label-for-col col-md-6 col-6">Total</label>
                                    <input type="hidden" name="price" class="price1" value="">
                                    <div class="col-md-6 col-6">
                                        <span id="total1"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row p-2">
                                <label for="" class="label-form-col col-md-6 col-12">
                                    Tipe Pembayaran
                                </label>
                                <div class="col-md-6 col-12">
                                    <select name="payment_tipe" class="form-control" id="">
                                        <option value="0">Pilih Salah Satu</option>
                                        <option value="1">Bayar Sekarang</option>
                                        <option value="2">Bayar Nanti</option>
                                    </select>
                                </div>
                            </div>
                            <div class="payment text-center" style="display: none">
                                <button class="btn btn-secondary my-2" type="submit">Buat Order</button>
                                <button class="btn btn-danger" type="reset">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="card">
            <div class="card-header"><h6>List Transaksi</h6></div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>No. Transaksi</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Berat</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction as $tr)
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
                            <td scope="row">{{ $layanan->code.'-'.$tr->order_number }}</td>
                            <td>{{ $tr->name }}</td>
                            <td>{{ $layanan->name }}</td>
                            <td>{{ $tr->weight.' Kg' }}</td>
                            <td>{{ 'Rp '.number_format($tr->price,'0',',','.') }}</td>
                            <td>{{ $status }}</td>
                            <td>
                                <span class="badge bg-info {{($tr->status == 4)?'d-none':''}}"><a href="{{route('proses',[$tr->order_number]) }}" class="text-light">Proses</a></span>
                                <span class="badge bg-danger {{($tr->payment_type == 1)?'d-none':''}}"><a href="javascript:;" class="text-light">Bayar</a></span>
                                <span class="badge bg-warning"><a href="{{ route('print',[$tr->order_number]) }}" target="_blank" class="text-light">Print</a></span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transaction->links() }}
            </div>
        </div>
    </div>
  </div>
  @endsection 
  @section('js')
  <script> 
  const formatRupiah = (money) => {
        return new Intl.NumberFormat('id-ID',
            { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
        ).format(money);
    }
    $('.weight').on('input', function(){
        $('#servicess').fadeIn()
    })
    $('.weight1').on('input', function(){
        $('#servicess1').fadeIn()
    })
    function run()
    {
        var e = $('.services');
        $.get(`/user/service/`+ e.val(),
            function (data) {
            console.log(data)
              if(data == 0)
              {
                 alert('Silahkan pilih layanan laundry')
              }else{
                var w = $('.weight').val()
                if(w == 0 || w == null){
                    alert('Silahkan masukan berat')
                }else{
                $('.payment').fadeIn()
                $('#berat').html(w +' Kg')
                $('#biaya').html(data.price +'/Kg')
                $('.price').val(data.price * w)
                $('#total').html(formatRupiah(data.price * w))
                }
              }
            },
        );
    }
    function member()
    {
        var e = $('.services1');
        $.get(`/user/service/`+ e.val(),
            function (data) {
            console.log(data)
              if(data == 0)
              {
                 alert('Silahkan pilih layanan laundry')
              }else{
                var w = $('.weight1').val()
                if(w == 0 || w == null){
                    alert('Silahkan masukan berat')
                }else{
                $('.payment').fadeIn()
                $('#berat1').html(w +' Kg')
                $('#biaya1').html(data.price +'/Kg')
                $('.price1').val(data.price * w)
                $('#total1').html(formatRupiah(data.price * w))
                }
              }
            },
        );
    }

  </script>
@stop
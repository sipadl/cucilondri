<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Print Invoice</title>
  </head>
  <body>
      <div class="container">
          <div class="row justify-content-left">
              <div class="col-6 p-2">
                <div class="d-flex justify-content-between">
                    <img src="https://placeimg.com/30/30/arch" alt="" class="thubmnail" height="30" width="30" style="border-radius: 4px">
                    <h5 class="mx-4">Invoice Jasa Laundry</h5>
                </div>
                <hr>
                @php
                $kembalian = $data[0]->pay_amount - $data[0]->total;
                if($kembalian < 0)
                {
                    $kembalian = 0;
                }
                @endphp
                <h6>Invoice : {{$data[0]->no_order}} </h6>
                <div class="form-group row justify-content-between">
                    <label for="" class="label-form-col col-6">
                        Pelanggan
                    </label>
                        <div class="col-6">
                            : {{$data[0]->name}}
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Tanggal Transaksi
                        </label>
                            <div class="col-6">
                                : {{$data[0]->created_at}}
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <label for="" class="label-form-col col-6">
                                Tanggal Selesai
                            </label>
                                <div class="col-6">
                                    : {{$data[0]->tanggal_ambil}}
                                </div>
                            </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Biaya
                        </label>
                        <div class="col-6">
                        : {{'Rp '.number_format($data[0]->biaya_layanan,0).'/Kg'}}
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Jumlah Bayar
                        </label>
                        <div class="col-6">
                        : {{'Rp '.number_format($data[0]->pay_amount,0)}}
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Total
                        </label>
                        <div class="col-6">
                        : {{'Rp '.number_format($data[0]->total,0)}}
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Kembalian
                        </label>
                        <div class="col-6">
                           
                         : {{'Rp '.number_format($kembalian,0) }}
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Berat
                        </label>
                        <div class="col-6">
                         : <strong>{{ $data[0]->weight.' Kg'}}</strong>
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Layanan
                        </label>
                        <div class="col-6">
                         : <strong>{{ $data[0]->layanan}}</strong>
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="" class="label-form-col col-6">
                            Status Pembayaran
                        </label>
                        <div class="col-6">
                         : <strong>{{ $data[0]->pembayaran}}</strong>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h6>Terima Kasih Menggunakan Jasa Kami</h6>
                    </div>
                </div>
              </div>
          </div>
      </div>
    <!-- Optional JavaScript; choose one of the two! -->
      <script>
          window.print();
      </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login Jasa Laundry</title>
  </head>
  <body>
      <div class="container">
          <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-12">
                <div class="card" style="box-shadow: 10px 10px 5px 0px rgba(199,199,199,0.75);
                -webkit-box-shadow: 10px 10px 5px 0px rgba(199,199,199,0.75);
                -moz-box-shadow: 10px 10px 5px 0px rgba(199,199,199,0.75); border:none !important;">
                    <h4 class="text-center p-3">Login Jasa Laundry</h4>
                    <div class="form p-4">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group row mb-2">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="" class="label-form-col col-md-3 col-xs-12 col-12">
                                    Email
                                </label>
                                <div class="col-md-9 col-xs-12 col-12">
                                    <input type="email" class="form-control" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="" class="label-form-col col-md-3 col-xs-12 col-12">
                                    Password
                                </label>
                                <div class="col-md-9 col-xs-12 col-12">
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="butons" style="float:right">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    <!-- Optional JavaScript; choose one of the two! -->
@php
@endphp
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
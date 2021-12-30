<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <title>cuci londri</title>
    @yield('css')
    <style>
      a{
        text-decoration: none;
      }
      .nav-item{
        color: whitesmoke;
      }
      .nav-item:hover{
        color: #a4bedd
      }
      .nav-primary{
        background: #4e7db6;
      }
      svg{
        display:none;
      }
      /* .relative{
        display:none;
      } */
      p {
        padding:10px;
      }
    </style>
    <div class="container">
    @include('layouts.navbar')
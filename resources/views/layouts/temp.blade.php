@include('layouts.head')
@if(session('msg'))
<div class="alert alert-success" role="alert">
    <strong>{{session('msg')}}</strong>
</div>
@endif
@yield('content')

@include('layouts.foot')
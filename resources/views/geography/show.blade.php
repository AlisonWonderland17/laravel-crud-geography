@extends('geography.layout')
@section('content')
<div class="wrapperdiv">
    @if($geography)
        <div class="row pb-5">
            <div class="col-4"></div>
            <div class="col-4">
            <div class="card" style="width: 20rem;">
  <img src="{{ asset('uploads/'.$geography->flag) }}" class="card-img-top">
  <div class="card-body">
    <h5 class="card-title">{{ $geography->country }}</h5>
    <p class="card-text">{{ $geography->continent }} | {{ $geography->capital }}</p>
  </div>
</div>
            </div>
            <div class="col-4"></div>
        </div>
    @endif
</div>
@endsection
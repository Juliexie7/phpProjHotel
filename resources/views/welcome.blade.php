@extends('layouts.main')
@section('content')

<div class="container">
  <ul class="nav nav-pills" style="position: fixed; top: 90px; z-index: 1030;" id="navbar2">
      <li class="nav-item">
        <a class="nav-link active" href="#Montreal1" onclick="navActive()">Montreal</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Toronto1" onclick="navActive()">Toronto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Vancouver1" onclick="navActive()">Vancouver</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Calgary1" onclick="navActive()">Calgary</a>
      </li>
  </ul>
</div>

<div class="container " id="hotellist" style="margin-top: 180px; margin-bottom: 100px; overflow-y: scroll;">
@if (session('successMsg'))
<div class="alert alert-success" role="alert">
    {{ session('successMsg') }}
</div>
@endif
    @php $m = $t = $v = $c = 1;@endphp
    @foreach($hotels as $hotel)
        @switch($hotel->city)
            @case('Montreal')
                <div id="{{ $hotel->city }}{{$m}}"></div>
                @php $m++; @endphp
                @break
            @case('Toronto')
                <div id="{{ $hotel->city }}{{$t}}"></div>
                @php $t++; @endphp
                @break
            @case('Vancouver')
                <div id="{{ $hotel->city }}{{$v}}"></div>
                @php $v++; @endphp
                @break
            @case('Calgary')
                <div id="{{ $hotel->city }}{{$c}}"></div>
                @php $c++; @endphp
                @break
        @endswitch

    <div class="d-flex justify-content-center">
    <!-- <div data-bs-spy="scroll" data-bs-target="#navbar2" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2 d-flex justify-content-center"> -->
        
    <div class="card mb-5" style="max-width: 840px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img
                src="{{ url($hotel->image) }}"
                alt="{{ $hotel->name }}"
                class="img-fluid rounded-start"
               />    <!--base_path() -->
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $hotel->name }}</h5>  <!-- {{ $hotel->name }} -->
                <p class="card-text">{{ $hotel->description }}</p>
                <div class="text-end">
                  <a href="{{ route('reservation', $hotel->hotel_id) }}" class="btn btn-primary">BOOK</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @endforeach

</div>
<script>
  function navActive(){
    for (let index = 0; index < document.getElementsByClassName("nav-link").length; index++) {
      document.getElementsByClassName("nav-link")[index].classList.remove("active");
    }
    window.event.srcElement.classList.add("active");
  }

  window.onload=function() {
    document.getElementById("hotellist").style.height = (screen.height-420)+'px';
  };
</script>
@endsection
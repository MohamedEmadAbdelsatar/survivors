@extends('user/app')

@section('bg-img',Storage::disk('local')->url($about->image))

@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('default/assets/user/css/prism.css')}}">
@endsection
@section('title',$about->title)
@section('subHeading',$about->subtitle)
@section('main-content')


<!-- about Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            {!! htmlspecialchars_decode($about->body) !!}
            <br>
            <hr>
          </div>
        </div>
      </div>
    </article>

    <hr>

@endsection
@section('footer')
<script type="text/javascript" src="{{asset('default/assets/user/js/prism.js')}}"></script>
@endsection

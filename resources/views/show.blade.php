@extends('app')

@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div id="showImg">
            {{--            <div class="defaultImg"><img src="{{ asset('photos/'. $filename) }}"></div>--}}
            @foreach($imgArr as $photo)
                <img src="{{ asset('photos/'.$photo) }}">
            @endforeach
        </div>
    </div>
    </div>
@endsection

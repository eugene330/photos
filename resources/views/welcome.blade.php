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

        <div class="content">
            <div class="title m-b-md">
                <p>Добро пожаловать на сайт для обработки фото</p>
            </div>
            <form action="{{ url('images') }}" method="POST" enctype="multipart/form-data" name="photo">
                <p><strong>Укажите картинку</strong></p>
                <p><input type="file" name="img" accept="image/*" max="31457280"/>
                    <input type="submit" value="Отправить"></p>
                @csrf
            </form>
        </div>
    </div>
    </div>
@endsection

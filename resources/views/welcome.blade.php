@extends('app')

@section('content')
    <!-- jsSourses скрипты -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <script src="js/jquery.iframe-transport.js"></script>
    <script src="js/jquery.fileupload.js"></script>
    <script>
        $('#fileupload').fileupload({
            /* ... */
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                    progress + '%'
                );
            }
        });
    </script>

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
                <div id="progress">
                    <div class="bar" style="width: 0%;"></div>
                </div>
                <p><input type="file" name="img" id="fileupload" accept="image/*" max="31457280"/>
                    <input type="submit" value="Отправить"></p>
                @csrf
            </form>
        </div>
    </div>
    </div>
@endsection

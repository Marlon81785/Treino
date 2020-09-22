<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sorteio</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">

        <!-- Bootstrap v4.5.3 -->
        <script src="{{ asset('bootstrap-4.5.2-dist/js/bootstrap.js') }}"></script>
        <link href="{{ asset('bootstrap-4.5.2-dist/css/bootstrap.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="position-ref full-height">
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
        </div>
        <div class="content">
            <div>
                Crie agora o seu sorteio gratuitamente!
            </div>
            <div>
                Imagem de exemplo do site
            </div>        
                
        </div>
    </body>
</html>

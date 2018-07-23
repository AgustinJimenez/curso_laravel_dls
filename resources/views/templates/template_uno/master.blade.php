<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        @section('estilos')

        @show

    </head>
    <body>
        <div class="container">

            @if($errors->any() )
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                        @foreach ($errors->all() as $message) 
                            <li class="list-group-item list-group-item-danger">{{ $message }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @yield('contenido')
        </div>
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @section('scripts')
        
        @show
    </body>
</html>
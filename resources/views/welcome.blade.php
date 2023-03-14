<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Qr Code Generator page</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">
        <div class="container">
            <h1 class="m-3">QR Code Generator Form</h1>
            
            <form name="code-gen-form" id="code-gen-form" method="POST" action="{{ url('codegen') }}">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Name</span>
                    </div>
                    <input type="text" required class="form-control" name="name" id="profile-name" value="{{ old('name') }}" aria-describedby="basic-addon3">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Linkedin URL</span>
                    </div>
                    <input type="text" required class="form-control" name="linkedin" id="profile-company-linkedin-url" value="{{ old('linkedin') }}" aria-describedby="basic-addon3">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">GitHub URL</span>
                    </div>
                    <input type="text" required class="form-control" name="github" id="profile-github-url" value="{{ old('github') }}" aria-describedby="basic-addon3">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Generate Image</button>
            </form>

        @isset($path)
            <img src="{{ $path }}" alt="qrcode">
        @endisset
        </div>
        @if(!empty($errorsI))
            <script>
                alert("{{ $errorsI }}");
            </script>
        @endif
    </body>
</html>

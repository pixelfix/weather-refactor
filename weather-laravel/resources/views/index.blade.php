<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="col-md-12 text-center mb-10">
            <h1>Welcome to {{ config('app.name') }}</h1>
        </div>
        <div class="col-md-4 offset-4 mb-10">
            <form action="{{ route('home') }}" method="POST">
                @csrf
                <div class="form-group mb-10">
                    <select name="city" id="city" class="form-control">
                        <option value="">Please select a city...</option>
                        <option value="Beijing">Beijing</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Karachi">Karachi</option>
                        <option value="London">London</option>
                        <option value="Manila">Manila</option>
                        <option value="New York">New York</option>
                        <option value="Paris">Paris</option>
                        <option value="Seoul-Incheon">Seoul-Incheon</option>
                        <option value="Shanghai">Shanghai</option>
                        <option value="Sydney">Sydney</option>
                        <option value="Tokyo">Tokyo</option>
                    </select>
                    @error('city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">View Weather</button>
                </div>
            </form>
        </div>

        @include('partials._weather-result')

    </body>
</html>

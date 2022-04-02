@if(isset($weatherResults))
<div class="col-md-4 offset-4 text-center"><h5>Weather for {{ $city }}</h5></div>
<div class="col-md-4 offset-4 row">

    @foreach ($weatherResults as $weatherResult)
        <div class="col-md-4 text-center">
            <p>{{ $weatherResult["date"] }}</p>
            <p>{{ $weatherResult["condition"] }}</p>
            <img src="{{ $weatherResult["image"] }}" alt="">
        </div>
    @endforeach
</div>
@endif

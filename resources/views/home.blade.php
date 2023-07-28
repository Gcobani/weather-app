<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="../css/app.css" rel="stylesheet">
    </head>
    <body>
    <main class="main-container">
        <div class="weather-form">
            <form class="" action="{{ route('post.getWeather') }}" method="POST">
                @csrf
                <div class="weather-form__container">
                    <label for="address">Please Enter Address</label>
                    <input class="weather-form__input" name="address" id="address" type="text" />
                    <button class="weather-form__submit" type="submit">View Weather</button>
                </div>
                @error('address') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </form>
        </div>
        @if($weather)
            <div class="location-and-date">
                <h1 class="location-and-date__location">{{ $weather['name'] }}, {{ $weather['sys']['country'] }}</h1>
                <div>{{today()->format('d M Y')}}</div>
            </div>


            <div class="current-temperature">
                <div class="current-temperature__icon-container">
                    <img src="" class="current-temperature__icon" alt="">
                </div>
                <div class="current-temperature__content-container">
                    <div class="current-temperature__value">{{ round($weather['main']['temp'], 0) }}&deg;C</div>
                </div>
            </div>
            <div class="current-stats">
                <div>
                    <div class="current-stats__value">{{$weather['main']['humidity']}}</div>
                    <div class="current-stats__label">Humidity</div>
                    <div class="current-stats__value">
                        @if(isset($weather['rain']))
                            {{ isset($weather['rain']['1hr']) ? $weather['rain']['1hr']: $weather['rain']['3hr'] }}
                        @else
                            0%
                        @endif
                    </div>
                    <div class="current-stats__label">Precipitation</div>
                </div>
                <div>
                    <div class="current-stats__value">{{ $weather['wind']['speed'] }}</div>
                    <div class="current-stats__label">Wind Speed</div>
                    <div class="current-stats__value">{{ $weather['wind']['deg'] }}&deg;</div>
                    <div class="current-stats__label">Wind Direction</div>
                </div>
                <div>
                    <div class="current-stats__value">{{ round($weather['main']['temp_min'], 0)  }}&deg;C</div>
                    <div class="current-stats__label">Min</div>
                    <div class="current-stats__value">{{ round($weather['main']['temp_max'], 0) }}&deg;C</div>
                    <div class="current-stats__label">Max</div>
                </div>
            </div>
        @endif
    </main>
    </body>
</html>

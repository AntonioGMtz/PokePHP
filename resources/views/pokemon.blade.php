<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($pokemon['name']) }}</title>
</head>
<body>
    <h1>{{ ucfirst($pokemon['name']) }}</h1>
    <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}">
    <p><strong>Altura:</strong> {{ $pokemon['height'] }}</p>
    <p><strong>Peso:</strong> {{ $pokemon['weight'] }}</p>
    <p><strong>Tipos:</strong>
        @foreach($pokemon['types'] as $type)
            {{ $type['type']['name'] }}
        @endforeach
    </p>
</body>
</html>
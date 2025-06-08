<!DOCTYPE html>
<html>
<head>
    <title>Pokédex</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    
 
</head>
<body>
    <h1 style="text-align: center;">🧩 Pokédex Inicial</h1>
    <div class="container">
        @foreach($pokemons as $pokemon)
            <div class="card">
                <h3>{{ ucfirst($pokemon['name']) }}</h3>
                <img src="{{ $pokemon['image'] }}" alt="{{ $pokemon['name'] }}">
                <p>Altura: {{ $pokemon['height'] }}</p>
                <p>Peso: {{ $pokemon['weight'] }}</p>
                <div class="types">
                    Tipos:
                    @foreach($pokemon['types'] as $type)
                        <span>{{ $type }}</span>
                    @endforeach
                </div>
                <a href="{{ url('/pokemon/' . $pokemon['name']) }}">Ver más</a>
            </div>
        @endforeach
    </div>
   
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Pokédex</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f4f4;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 30px;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 15px;
            width: 200px;
            text-align: center;
        }
        img {
            width: 100px;
        }
        .types {
            font-size: 0.9em;
            color: #555;
        }
    </style>
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
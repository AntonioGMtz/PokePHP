<!DOCTYPE html>
<html>
<head>
    <title>Pokédex</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    
 
</head>
<body>
    <h1 style="text-align: center;">🧩 Pokédex Inicial</h1>

   <div class="container">
    @foreach ($pokemons as $pokemon)
        <div class="card" onclick="showDetails({{ $pokemon['id'] }})">
            <img src="{{ $pokemon['image'] }}" alt="{{ $pokemon['name'] }}">
            <h3>{{ ucfirst($pokemon['name']) }}</h3>
            <div class="types">
                @foreach($pokemon['types'] as $type)
                    <span>{{ ucfirst($type) }}</span>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
<!-- Paginación -->
<div class="pagination">
    {{ $pokemons->links() }}
</div>
    <!-- Modal único (fuera del foreach y container) -->
    <div id="pokemonModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Pokemon">
                <div class="modal-info">
                    <h2 id="modalName"></h2>
                    <p><strong>Tipo(s):</strong> <span id="modalTypes"></span></p>
                    <p><strong>Altura:</strong> <span id="modalHeight"></span> dm</p>
                    <p><strong>Peso:</strong> <span id="modalWeight"></span> hg</p>
                    <p><strong>Habilidades:</strong> <span id="modalAbilities"></span></p>
                    <p><strong>Estadísticas:</strong></p>
                    <ul id="modalStats"></ul>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/scrips.js') }}"></script>
</body>
</html>
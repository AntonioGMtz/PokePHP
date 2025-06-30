<!DOCTYPE html>
<html>
<head>
    <title>Pokédex</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    
 
</head>
<body>
    <h1 style="text-align: center;">
  <svg xmlns="http://www.w3.org/2000/svg" width="40" viewBox="0 0 64 64" style="vertical-align: middle; margin-right: 10px;">
    <circle cx="32" cy="32" r="30" fill="white" stroke="black" stroke-width="4"/>
    <path d="M2,32 H62" stroke="black" stroke-width="4"/>
    <circle cx="32" cy="32" r="10" fill="white" stroke="black" stroke-width="4"/>
  </svg>
  Pokédex Inicial
</h1>
    <!-- Barra de búsqueda -->
    <!-- Barra de búsqueda a lo ancho -->
<div class="search-bar">
    <form method="GET" action="{{ route('pokedex') }}" class="search-form">
        <input type="text" name="search" placeholder="Buscar Pokémon..." value="{{ request('search') }}">
        <button type="submit">Buscar</button>
    </form>
</div>


<div class="filter-section">
  <h2>Filtrar por:</h2>
  <div class="type-filters">
    <a href="{{ route('pokedex', ['type' => 'fire']) }}" class="type-badge type-fire">Fuego</a>
    <a href="{{ route('pokedex', ['type' => 'water']) }}" class="type-badge type-water">Agua</a>
    <a href="{{ route('pokedex', ['type' => 'grass']) }}" class="type-badge type-grass">Planta</a>
    <a href="{{ route('pokedex', ['type' => 'electric']) }}" class="type-badge type-electric">Eléctrico</a>
    <a href="{{ route('pokedex', ['type' => 'flying']) }}" class="type-badge type-flying">Volador</a>
    <a href="{{ route('pokedex', ['type' => 'bug']) }}" class="type-badge type-bug">Bicho</a>
    <a href="{{ route('pokedex', ['type' => 'normal']) }}" class="type-badge type-normal">Normal</a>
    <a href="{{ route('pokedex', ['type' => 'psychic']) }}" class="type-badge type-psychic">Psíquico</a>
    <!-- Agrega los demás tipos -->
  </div>
</div>

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
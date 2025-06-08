<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PokeController extends Controller
{

 public function index(Request $request)
{
    $perPage = 18;
    $page = $request->get('page', 1);
    $offset = ($page - 1) * $perPage;

    // Obtener los primeros 151 Pokémon
    $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=151");
    $results = $response->json()['results'];

    // Cortar solo los que necesitamos para esta página
    $pageResults = array_slice($results, $offset, $perPage);

    $pokemons = [];

    foreach ($pageResults as $result) {
        $data = Http::get($result['url'])->json();
        $pokemons[] = [
            'id' => $data['id'],
            'name' => $data['name'],
            'image' => $data['sprites']['front_default'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'types' => array_map(fn($type) => $type['type']['name'], $data['types']),
            'abilities' => array_map(fn($ability) => $ability['ability']['name'], $data['abilities']),
            'stats' => array_map(fn($stat) => [
                'name' => $stat['stat']['name'],
                'base' => $stat['base_stat']
            ], $data['stats'])
        ];
    }

    // Crear paginador manual
    $paginator = new LengthAwarePaginator(
        $pokemons,
        count($results),
        $perPage,
        $page,
        ['path' => route('pokedex')] // Ajusta según tu ruta
    );

    return view('index', ['pokemons' => $paginator]);
}
}
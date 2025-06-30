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

    // 1) Obtener todos los resultados
    $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=151");
    $results = $response->json()['results'];

    // 2) Filtrar por nombre si hay búsqueda
    $search = $request->get('search');
    if ($search) {
        $results = array_filter($results, function($pokemon) use ($search) {
            return stripos($pokemon['name'], $search) !== false;
        });
        $results = array_values($results); // Reindexar después de filtrar
    }

    // 3) Cortar solo los que necesitamos para esta página
    $pageResults = array_slice($results, $offset, $perPage);

    // 4) Obtener datos detallados
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

    // 5) Crear paginador manual
    $paginator = new LengthAwarePaginator(
        $pokemons,
        count($results), // total filtrado
        $perPage,
        $page,
        ['path' => route('pokedex')] // Ajusta según tu ruta
    );

    return view('index', ['pokemons' => $paginator]);
}
}
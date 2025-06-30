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

    // 1) Trae todos los Pokémon
    $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=151");
    $results = $response->json()['results'];

    // 2) Filtra por nombre si hay búsqueda
    $search = $request->get('search');
    if ($search) {
        $results = array_filter($results, function ($pokemon) use ($search) {
            return stripos($pokemon['name'], $search) !== false;
        });
        $results = array_values($results);
    }

    // 3) Cortar solo los que necesitamos para esta página
    $pageResults = array_slice($results, $offset, $perPage);

    $pokemons = [];

    foreach ($pageResults as $result) {
        $data = Http::get($result['url'])->json();

        // 4) Si hay filtro por tipo, revisa los tipos del Pokémon
        $type = $request->get('type');
        if ($type) {
            $hasType = false;
            foreach ($data['types'] as $t) {
                if (strtolower($t['type']['name']) == strtolower($type)) {
                    $hasType = true;
                    break;
                }
            }
            if (!$hasType) {
                continue; // Omitir Pokémon que no tienen el tipo
            }
        }

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

    // 5) Crear paginador manual SOLO con los que pasaron ambos filtros
    $totalResults = count($pokemons);

    $paginated = array_slice($pokemons, 0, $perPage); // Paginado manual

    $paginator = new LengthAwarePaginator(
        $paginated,
        $totalResults,
        $perPage,
        $page,
        ['path' => route('pokedex')]
    );

    return view('index', ['pokemons' => $paginator]);
}
}
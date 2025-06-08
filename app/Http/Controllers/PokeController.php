<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PokeController extends Controller
{
   /* public function show($name = 'charmander')
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . strtolower($name));

        if ($response->successful()) {
            $pokemon = $response->json();
            return view('pokemon', compact('pokemon'));
        } else {
            abort(404, 'Pokémon no encontrado');
        }
    }
        */

    public function index()
    {
        // Obtener los primeros 10 Pokémon desde la API
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=18');

        $results = $response->json()['results'];

        // Obtener los datos completos de cada Pokémon
        $pokemons = [];

        foreach ($results as $result) {
            $data = Http::get($result['url'])->json();
            $pokemons[] = [
                'name' => $data['name'],
                'image' => $data['sprites']['front_default'],
                'height' => $data['height'],
                'weight' => $data['weight'],
                'types' => array_map(fn($type) => $type['type']['name'], $data['types']),
            ];
        }

        return view('index', compact('pokemons'));
    }    
}
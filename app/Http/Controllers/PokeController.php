<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PokeController extends Controller
{
    public function show($name = 'pikachu')
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . strtolower($name));

        if ($response->successful()) {
            $pokemon = $response->json();
            return view('pokemon', compact('pokemon'));
        } else {
            abort(404, 'Pokémon no encontrado');
        }
    }
}
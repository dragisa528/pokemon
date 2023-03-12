<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Services\PokemonService;
use App\Models\Pokemon;

uses(RefreshDatabase::class);

/**
 * POST /api/pokemons/import
 */
it('cannot import invalid csv file', function () 
{
    $response = $this->postJson('/api/pokemons/import',[
        'pokemon' => 'null'
    ]);

    $response->assertStatus(422);
    $errors = $response->decodeResponseJson()['errors'];
    expect($errors)
    ->toMatchArray([
        "pokemons" => [
            0 => "The pokemons field is required."
        ]
    ]);
 
})->group('pokemon', 'pokemon-import-validation');


it('can upload a .csv file containing a list of Pokémon and populate database', function () 
{

    // assert upload

    // assert database is populated

    Storage::fake(PokemonService::STORAGE_DISK);

    $csv = implode("\n", [
        'Name,Weight,Height',
        'Pikachu,60,4',
        'Blastoise,855,16',
        'Squirtle,90,5'
    ]);

    $csvFile = UploadedFile::fake()
        ->createWithContent('pokemon.csv', $csv);

    $response = $this->postJson('/api/pokemons/import',[
        'pokemons' => $csvFile
    ]);

    $response->assertOk();


    // assert the file was not uploaded with original name
    Storage::disk(PokemonService::STORAGE_DISK)
        ->assertMissing(PokemonService::UPLOAD_DIR . "/pokemon.csv");
 
})->group('pokemon', 'pokemon-import');

/**
 * GET /api/pokemons
 */
it('can fetch list of pokemon entries from the database', function () 
{
    $pokemon = Pokemon::factory()->create([
        'name'   => fake()->name(),
        'weight' => 20.2,
        'height' => 0.1
    ]);

    $response = $this->getJson("/api/pokemons");
    $response->assertOk();

    $content = $response->decodeResponseJson()['data'];
    expect($content)->toHaveCount(1); 
    expect($content[0])
        ->toMatchArray([
            'name'   => $pokemon->name,
            'weight' => $pokemon->weight,
            'height' => $pokemon->height
        ]);

})->group('pokemon', 'pokemon-index');
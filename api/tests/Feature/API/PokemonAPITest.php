<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\FakeCsvHelper;
use App\Models\Pokemon;

uses(RefreshDatabase::class);

/**
 * POST /api/pokemons/import
 */
it('cannot import invalid csv file', function () 
{

    // assert cannot import invalid file
    $response = $this->postJson('/api/pokemons/import',[
        'pokemons' => ''
    ]);
    $response->assertStatus(422);
    $errors = $response->decodeResponseJson()['errors'];
    expect($errors)
    ->toMatchArray([
        "pokemons" => [
            0 => "The pokemons field is required."
        ]
    ]);

    // assert validation fails for invalid column
    $rows = [
        'head' => ['Name', 'Weight', 'Height'],
        'row1' => ['name' => 'Pikachu',   'weight' => 'badddooo value',  'height' => 4]
    ];
    $csvFile  = FakeCsvHelper::fromRows('pokemon.csv', $rows);

    $response = $this->postJson('/api/pokemons/import', ['pokemons' => $csvFile]);
    $response->assertStatus(422);
    $errors = $response->decodeResponseJson()['errors'];

    expect($errors)
    ->toMatchArray([
        "2.weight" => [
            0 => "The weight entered at row #3 should be numeric"
        ]
    ]);
 
})->group('pokemon', 'pokemon-import-validation');

it('can upload a .csv file containing a list of Pokémon and populate database', function () 
{
    $rows = [
        'head' => ['Name', 'Weight', 'Height'],
        'row1' => ['name' => 'Pikachu',   'weight' => 60,  'height' => 4],
        'row2' => ['name' => 'Blastoise', 'weight' => 855, 'height' => 16],
        'row3' => ['name' => 'Emeka',     'weight' => 90,  'height' => 5]
    ];

    $csvFile  = FakeCsvHelper::fromRows('pokemon.csv', $rows);
    $response = $this->postJson('/api/pokemons/import',['pokemons' => $csvFile]);
    $response->assertStatus(204);

    $this->assertDatabaseHas('pokemons', ['name' => 'Pikachu',   'weight' => 60,  'height' => 4]);
    $this->assertDatabaseHas('pokemons', ['name' => 'Blastoise', 'weight' => 855, 'height' => 16]);
    $this->assertDatabaseHas('pokemons', ['name' => 'Emeka',     'weight' => 90,  'height' => 5]);
 
})->group('pokemon', 'pokemon-import');

/**
 * GET /api/pokemons
 */
it('can fetch list of pokemon entries from the database', function () 
{
    $pokemon = Pokemon::factory()->create(['name' => 'Emeka',   'weight' => 20,  'height' => 0.4]);

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
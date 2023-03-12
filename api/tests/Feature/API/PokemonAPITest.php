<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Helpers\pokemonUploader;

uses(RefreshDatabase::class);

// Acceptance Criteria
// -----------------------------------------------------------------------------
// Given I am a user of the application
// When I pass in a valid .csv file containing a list of Pokémon
// THEN The database is populated with the entries

// Given I am a user of the application
// When I request a list of Pokémon
// THEN I am shown the list of Pokémon from the database on the website

/**
 * POST /api/pokemons/upload
 */
it('can upload a .csv file containing a list of Pokémon and populate database', function () 
{
    // assert validation works

    // assert upload

    // assert database is populated

    Storage::fake(PokemonUploader::STORAGE_DISK);

    $csv = implode("\n", [
        'Name,Weight,Height',
        'Pikachu,60,4',
        'Blastoise,855,16',
        'Squirtle,90,5'
    ]);

    $csvFile = UploadedFile::fake()
        ->createWithContent('pokemon.csv', $csv);

    $response = $this->postJson('/api/pokemons/import',[
        'pokemon' => $csvFile
    ]);

    // assert the file was not uploaded with original name
    Storage::disk(PokemonUploader::STORAGE_DISK)
        ->assertMissing(PokemonUploader::UPLOAD_DIR . "/pokemon.csv");
 
})->group('pokemon', 'pokemon-upload');

/**
 * GET /api/pokemons
 */
it('can fetch list of pokemon entries from the database', function () 
{
    $response = $this->getJson("/api/pokemons");
    $response->assertOk();

})->group('pokemon', 'pokemon-index');
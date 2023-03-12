<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use App\Services\PokemonService;

uses(RefreshDatabase::class);

// it('pokemon service can import a CSV', function () 
// {
//     $csv = implode("\n", [
//         'Name,Weight,Height',
//         'Pikachu,60,4',
//         'Blastoise,855,16',
//         'Squirtle,90,5'
//     ]);

//     $csvFile = UploadedFile::fake()
//         ->createWithContent('pokemon.csv', $csv);

//     PokemonService::import($csvFile);
 
// })->group('pokemon-service', 'pokemon-service-import');

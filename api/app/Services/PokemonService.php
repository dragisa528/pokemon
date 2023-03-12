<?php 

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Imports\ImportPokemons;
use Maatwebsite\Excel\Validators\ValidationException;

class PokemonService
{
    /**
     * Maximum size of uploadable file (KB = 1024)
     * @var int
     */
    const MAX_SIZE = 10240; //10MB

    /**
     * Storage Disk
     * @var string
     */
    const STORAGE_DISK = 'local';

    /**
     * Directory where csv are uploaded
     * @var string
     */
    const UPLOAD_PATH = 'pokemons';

    /**
     * Import CSV from uploaded file
     */
    public static function import(UploadedFile $csv) 
    {
        try {
            return (new ImportPokemons)->import($csv);
        } catch (ValidationException $e) {
             
            $failures = $e->failures();
            dd($failures);
            // foreach ($failures as $index => $failure) 
            // {
            //     $error = [
            //         'row'       => $failure->row(),
            //         'attribute' => $failure->attribute(),
            //         'errors'    => $failure->errors(),
            //         'values'    =>$failure->values() 
            //     ];
            // }
        }
    }
}
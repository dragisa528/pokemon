<?php 

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Validators\ValidationException as ImportValidationException;
use App\Imports\ImportPokemons;
use App\Exceptions\PokemonImportException;

class PokemonService
{
    /**
     * Maximum size of uploadable file (KB = 1024)
     * @var int
     */
    const MAX_SIZE = 10240; //10MB

    /**
     * Import CSV from uploaded file
     * 
     * @throws ValidationException|PokemonImportException
     */
    public static function import(UploadedFile $csv) : bool
    {
        try{
            (new ImportPokemons)->import($csv);
        } catch (ImportValidationException $e) {
            throw new ValidationException($e->validator);
        } catch(Exception $e) {
            info($e->getMessage());
            throw new PokemonImportException('Unable to import file');
        }

        return true;
    }
}
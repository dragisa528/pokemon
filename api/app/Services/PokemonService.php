<?php 

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
     * Upload CSV
     */
    public static function uploadCSV(UploadedFile $csv, ?string $path, ?string $disk) : string
    {
        $filename    = Str::random();
        $uploadPath  = $path ?? self::UPLOAD_PATH;
        $storageDisk = $disk ?? self::STORAGE_DISK;

        return $csv
            ->storeAs($uploadPath, $filename, $storageDisk);
    }

    /**
     * Remove csv from storage
     */
    public static function removeCsv(string $path, ?string $disk) : bool 
    {
        $storageDisk = $disk ?? self::STORAGE_DISK;
        
        if(!Storage::disk($storageDisk)->exists($path)){
            return false;
        }

        Storage::disk($storageDisk)->delete($path);

        return true;
    }

    
}
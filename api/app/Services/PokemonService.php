<?php 

namespace App\Services;

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
     * Directory where csvs are uploaded
     * @var string
     */
    const UPLOAD_DIR = 'pokemons';
}
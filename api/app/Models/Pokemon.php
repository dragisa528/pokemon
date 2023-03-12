<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    /**
     * The table name for this model.
     * @var string
     */
    protected $table = 'pokemons';

    use HasFactory;
}

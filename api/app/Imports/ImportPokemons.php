<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Pokemon;

class ImportPokemons implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        return new Pokemon([
            'name'   => $row['name'],
            'weight' => $row['weight'],
            'height' => $row['height'],
        ]);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function rules(): array
    {
        $name   = 'required|string';
        $weight = 'required|numeric|min:1';
        $height = 'required|numeric|max:1';
        
        return [
            'name'     => $name,
            '*.name'   => $name,
            'weight'   => $weight,
            '*.weight' => $weight,
            'height'   => $height,
            '*.height' => $height
        ];
    }
}
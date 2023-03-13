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
        $pokemon = [
            'name'   => $row['name'],
            'weight' => $row['weight'],
            'height' => $row['height'],
        ];

        // avoid duplicates
        $count = Pokemon::where($pokemon)->count();
        if($count){
            return null;
        }

        return new Pokemon($pokemon);
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
        $height = 'required|numeric|min:1';
        
        return [
            'name'     => $name,
            '*.name'   => $name,
            'weight'   => $weight,
            '*.weight' => $weight,
            'height'   => $height,
            '*.height' => $height
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.weight.min'      => 'The weight entered at row #:position should be greater than zero',
            '*.height.min'      => 'The height entered at row #:position should be greater than zero',
            '*.weight.numeric'  => 'The weight entered at row #:position should be numeric',
            '*.height.numeric'  => 'The height entered at row #:position should be numeric',
            '*.name.required'   => 'The name at row #:position is required',
            '*.weight.required' => 'The weight at row #:position is required',
            '*.height.required' => 'The height at row #:position is required',
        ];
    }
}
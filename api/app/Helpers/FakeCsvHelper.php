<?php 

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class FakeCsvHelper
{
    public static function fromRows(string $filename, array $rows) : UploadedFile
    {
        foreach($rows as $index => $row) {
            if(!is_array($row)) {
                continue;
            }

            $rows[$index] = implode(',', array_values($row));
        }

        $csv = implode("\n", array_values($rows));

        return UploadedFile::fake()
            ->createWithContent($filename, $csv);
    }
}
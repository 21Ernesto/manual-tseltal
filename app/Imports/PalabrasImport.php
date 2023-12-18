<?php

namespace App\Imports;

use App\Models\Palabras;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PalabrasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{

    public function model(array $row)
    {
        return new Palabras([
            'audio' => $row['archivo'],
            'capitulo_id' => $row['seccion'],
            'ortografia' => $row['ortografia'],
            'traduccion' => $row['traduccion'],
            'observacion' => $row['observaciones_app'],
        ]);
    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }
}

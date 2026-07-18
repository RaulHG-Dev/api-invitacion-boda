<?php

namespace Database\Seeders;

use App\Models\DynamicData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatosDinamicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::transaction(function () {
                DynamicData::create([
                    'key' => 'NOMBRE_NOVIO',
                    'value' => 'DANIEL'
                ]);
                DynamicData::create([
                    'key' => 'NOMBRE_NOVIA',
                    'value' => 'BRENDA'
                ]);
                DynamicData::create([
                    'key' => 'NOMBRE_DIA',
                    'value' => 'SÁBADO'
                ]);
                DynamicData::create([
                    'key' => 'MES_BODA',
                    'value' => 'OCT'
                ]);
                DynamicData::create([
                    'key' => 'DIA_BODA',
                    'value' => '09'
                ]);
                DynamicData::create([
                    'key' => 'ANIO_BODA',
                    'value' => '2026'
                ]);
                DynamicData::create([
                    'key' => 'HORA_BODA',
                    'value' => '4 P.M.'
                ]);
                DynamicData::create([
                    'key' => 'LUGAR_BODA',
                    'value' => 'CUERNAVACA, MORELOS'
                ]);
            });
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}

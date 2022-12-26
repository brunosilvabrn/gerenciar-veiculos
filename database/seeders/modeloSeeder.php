<?php

namespace Database\Seeders;

use App\Models\Modelo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class modeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handle = fopen(resource_path('csv/modelos-carros.csv'), "r");
        $header = fgetcsv($handle, 1000, ";");

        while ($row = fgetcsv($handle, 1000, ";")) {
            $modelos[] = array_combine($header, $row);
        }

        foreach ($modelos as $marca) {
            $idMarca = [];
            foreach ($marca as $dados) {
                $idMarca[] = $dados;
            }

            DB::table('modelos')->insert([
                'id' => $idMarca[0],
                'marca_id' => $idMarca[1],
                'name' => $idMarca[2]
            ]);
        }
    }
}

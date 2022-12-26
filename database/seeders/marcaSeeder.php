<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class marcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handle = fopen(resource_path('csv/marcas-carros.csv'), "r");
        $header = fgetcsv($handle, 1000, ";");

        while ($row = fgetcsv($handle, 1000, ";")) {
            $marcas[] = array_combine($header, $row);
        }

        foreach ($marcas as $marca) {
            $idMarca = [];
            foreach ($marca as $dados) {
                $idMarca[] = $dados;
            }

            DB::table('marcas')->insert([
                'id' => $idMarca[0],
                'name' => $idMarca[1]
            ]);

        }
    }
}

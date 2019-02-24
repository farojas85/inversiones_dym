<?php

use Illuminate\Database\Seeder;
use App\TipoDocumento;
use Carbon\Carbon;

class TipoDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        TipoDocumento::create([
            'descripcion' => 'Documento Nacional de Identidad',
            'abreviatura'=>'DNI',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        TipoDocumento::create([
            'descripcion' => 'Carnet de Extranjería',
            'abreviatura'=>'CE',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

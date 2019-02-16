<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Modulo;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modulo::create([
                'nombre' => 'Dashboard',
                'slug' => 'dashboard',
                'descripcion' => 'Módulo para Resúmenes y Estadísticas',
                'icono'=>'fe-airplay',
                'estado' =>'activo'
        ]);
        
        Modulo::create([
            'nombre' => 'Sistema',
            'slug' => 'sistema',
            'descripcion' => 'Configuraciones del Sistema',
            'icono'=>'fe-cpu',
            'estado' =>'activo'
        ]);

        Modulo::create([
            'nombre' => 'Personal',
            'slug' => 'personal',
            'descripcion' => 'Registro Personal, Pagos y Adelantos, etc.',
            'icono'=>'fe-users',
            'estado' =>'activo'
        ]);

        Modulo::create([
            'nombre' => 'Préstamos',
            'slug' => 'prestamos',
            'descripcion' => 'Registro de Clientes, créditos, préstamos y cobranza',
            'icono'=>'far fa-money-bill-alt',
            'estado' =>'activo'
        ]);
    }
}

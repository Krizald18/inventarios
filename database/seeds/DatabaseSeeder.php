<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // php artisan migrate:refresh --seed
    public function run()
    {
    	Eloquent::unguard();
        /*
        $this->call('MunicipiosTableSeeder');
//      $this->call('LocalidadesTableSeeder');	// precaución! este seeder tarda mas de 20 minutos en completar
        $this->call('OficialiasTableSeeder');
        $this->call('MarcasTableSeeder');
        $this->call('ModelosTableSeeder');
        $this->call('DescripcionesTableSeeder');
        $this->call('CaracteristicasTableSeeder');
        $this->call('TiposTableSeeder');
        $this->call('InventariosTableSeeder');
        */
    }
}
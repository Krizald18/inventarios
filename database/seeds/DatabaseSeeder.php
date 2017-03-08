<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // php artisan migrate:refresh --seed
    public function run()
    {
    	Eloquent::unguard();
        $this->call('GruposTableSeeder');
        $this->call('SubgruposTableSeeder');
        $this->call('MunicipiosTableSeeder');
        $this->call('OficialiasTableSeeder');
        $this->call('CaracteristicasTableSeeder');
        $this->call('MarcasTableSeeder');
        $this->call('ModelosTableSeeder');
        $this->call('AreaTableSeeder');
        $this->call('ResponsableTableSeeder');     
        $this->call('InventariosTableSeeder');
    }
}
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // php artisan migrate:refresh --seed
    public function run()
    {
    	Eloquent::unguard();
        //$this->call('ResponsablesTableSeeder');
    }
}

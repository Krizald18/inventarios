<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // php artisan migrate:refresh --seed
    public function run()
    {
    	Eloquent::unguard();
        $users = array(
            array(
                'id' => 1,
                'nombre' => 'admin',
                'username' => 'admin',
                'password' => '$2y$10$jOxAPe2zvtDswmu0RIYG0ePVxrYp1tFkc51Uc2h3foYStSfm8VuhC',
                'perfil_id' => 1,
                'created_at' => \Carbon\Carbon::now()
                )
            );
        DB::table('users')->insert($users);

        $admin = array(
            array(
                'user_id' => 1,
                'token' => '$2y$10$JlGQ3r3IqpiVsZx/4jFJ2eySJcn5hZHkEp5Paz5sZTaQpddFzpBua',
                'created_at' => \Carbon\Carbon::now()
                )
            );
        DB::table('admins')->insert($admin);

        $this->call('GruposTableSeeder');
        $this->call('SubgruposTableSeeder');
        $this->call('MunicipiosTableSeeder');
        $this->call('OficialiasTableSeeder');
        $this->call('CaracteristicasTableSeeder');
        $this->call('MarcasTableSeeder');
        $this->call('MarcasSubgruposTableSeeder');
        $this->call('ModelosTableSeeder');
        $this->call('AreaTableSeeder');
        $this->call('ResponsableTableSeeder');     
        $this->call('InventariosTableSeeder');
        $this->call('PerfilesTableSeeder');
    }
}
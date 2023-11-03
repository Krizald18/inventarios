<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class AreaTableSeeder extends Seeder {
	public function run() {
		$now = Carbon::now();
		//DB::table('areas')->delete();
		// datos de prueba
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [1,'ACLARACIONES',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [2,'ADMINISTRATIVA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [3,'ARCHIVO',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [4,'ARCHIVO REGISTRO CIIVL',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [5,'BODEGA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [6,'CURP',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [7,'DIF',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [8,'DIRECCION',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [9,'GOBIERNO',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [10,'HOSPITAL DE LA MUJER',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [11,'MATRIMONIOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [12,'NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [13,'OFICINA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [14,'REGISTRO DE NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [15,'SISTEMAS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [16,'UNIDAD ADMINISTRATIVA',$now]);
	}
}
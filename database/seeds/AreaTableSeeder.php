<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class AreaTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('areas')->delete();
		// datos de prueba
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [1,'ACLARACIONES',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [2,'ADMINISTRATIVA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [3,'ARCHIVO',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [4,'ARCHIVO REGISTRO CIIVL',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [5,'CURP',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [6,'DIF',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [7,'DIRECCION',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [8,'GOBIERNO',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [9,'HOSPITAL DE LA MUJER',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [10,'MATRIMONIOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [11,'NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [12,'OFICINA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [13,'OFICIAL MATRIMONIOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [14,'OFICIAL REGISTRO DE NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [15,'REGISTRO DE NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [16,'REGISTRO NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [17,'SISTEMAS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [18,'UNIDAD ADMINISTRATIVA',$now]);
	}
}
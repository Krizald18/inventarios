<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class MunicipiosTableSeeder extends Seeder {
	public function run() {
		$now = Carbon::now();
		//DB::table('municipios')->delete();
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [1,'AHOME',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [2,'ANGOSTURA',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [3,'BADIRAGUATO',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [4,'CONCORDIA',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [5,'COSALA',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [6,'CULIACAN',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [7,'CHOIX',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [8,'ELOTA',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [9,'ESCUINAPA',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [10,'EL FUERTE',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [11,'GUASAVE',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [12,'MAZATLAN',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [13,'MOCORITO',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [14,'ROSARIO',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [15,'SALVADOR ALVARADO',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [16,'SAN IGNACIO',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [17,'SINALOA',$now]);
		DB::insert('insert into municipios (id, municipio, created_at) values (?, ?, ?)', [18,'NAVOLATO',$now]);
	}
}
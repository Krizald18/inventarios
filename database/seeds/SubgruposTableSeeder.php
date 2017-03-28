<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class SubgruposTableSeeder extends Seeder {
	public function run() {
		$now = Carbon::now();
		DB::table('subgrupos')->delete();
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [1,'CPU', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [2,'COMPUTADORA ESCRITORIO', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [3,'DETECTOR HUELLA DP', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [4,'DISPLAY', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [6,'HUB', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [7,'IMPRESORA', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [8,'KIT DE COMUNICACION', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [9,'KIT DE COMUNICACION INALAMBRICA', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [10,'COMPUTADORA PORTATIL', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [11,'MONITOR', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [12,'MOUSE', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [13,'NO BREAK', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [14,'REGULADOR', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [15,'ROUTER', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [17,'SCANNER', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [18,'SERVIDOR', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [20,'SWITCH', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [21,'TECLADO', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [22,'TELEFONO ANALOGICO', 1, $now]);
		DB::insert('insert into subgrupos (id, subgrupo, grupo_id, created_at) values (?,?,?,?)', [23,'TELEFONO IP', 1, $now]);
	}
}
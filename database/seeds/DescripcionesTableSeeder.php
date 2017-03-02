<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class DescripcionesTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('descripciones')->delete();
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [1,'C.P.U.',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [2,'COMPUTADORA PORTATIL',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [3,'DETECTOR HUELLA DP',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [4,'DISPLAY',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [5,'ESCANER',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [6,'HUB',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [7,'IMPRESORA',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [8,'KIT DE COMUNICACION',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [9,'KIT DE COMUNICACION INALAMBRICA',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [10,'LAPTOP',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [11,'MONITOR',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [12,'MOUSE',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [13,'NO BREAK',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [14,'REGULADOR',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [15,'ROUTER',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [16,'SCANJET',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [17,'SCANNER',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [18,'SERVIDOR',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [19,'SERVIDOR ',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [20,'SWITCH',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [21,'TECLADO',$now]);
		DB::insert('insert into descripciones (id, descripcion, created_at) values (?, ?, ?)', [22,'TELEFONO',$now]);

	}
}
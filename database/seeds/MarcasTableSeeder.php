<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class MarcasTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('marcas')->delete();
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [1,'3COM',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [2,'ACER',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [3,'ALCATEL',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [4,'BTC',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [5,'CDP',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [6,'CENTRA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [7,'CISCO',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [8,'COMPAQ',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [9,'DATASHIELD',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [10,'DELL',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [11,'DIGITAL',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [12,'DTK',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [13,'ENCORE',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [14,'EPSON',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [15,'ERICSSON',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [16,'HP',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [17,'KODAK',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [18,'KYOCERA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [19,'LENOVO',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [20,'MICROSOFT',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [21,'KONICA MINOLTA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [22,'MOTOROLA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [23,'OCTEK',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [24,'Q-MATIC',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [25,'SOLA BASIC',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [26,'TATUNG',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [27,'TREKKER',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [28,'VICA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [29,'VIEW SONIC',$now]);
	}
}
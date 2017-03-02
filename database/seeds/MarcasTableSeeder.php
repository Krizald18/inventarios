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
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [4,'BALDWIN',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [5,'BTC',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [6,'CDP',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [7,'CENTRA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [8,'CISCO',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [9,'COMPAQ',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [10,'DATASHIELD',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [11,'DELL',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [12,'DIGITAL',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [13,'DTK',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [14,'ENCORE',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [15,'EPSON',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [16,'ERICSON',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [17,'HP',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [18,'KODAK',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [19,'KYOCERA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [20,'LENOVO',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [21,'MICROSOFT',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [22,'MICROVOLT',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [23,'MINOLTA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [24,'MOTOROLA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [25,'NO REGISTRADA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [26,'OKTEC',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [27,'ORINOCO',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [28,'PUSH',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [29,'Q-MATIC',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [30,'SIN MARCA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [31,'SOLA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [32,'SOLA BASIC',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [33,'TATUNG',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [34,'TREKKER',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [35,'VICA',$now]);
		DB::insert('insert into marcas (id, marca, created_at) values (?, ?, ?)', [36,'VIEW SONIC',$now]);
	}
}
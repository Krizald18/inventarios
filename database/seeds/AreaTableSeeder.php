<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class AreaTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('areas')->delete();
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [1,'ACLARACIONES',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [2,'ADMINISTRATIVA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [3,'ARCHIVO',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [4,'ARCHIVO REGISTRO CIIVL',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [5,'CAJA 1',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [6,'CAJA 10',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [7,'CAJA 11',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [8,'CAJA 12',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [9,'CAJA 13',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [10,'CAJA 14',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [11,'CAJA 15',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [12,'CAJA 2',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [13,'CAJA 3',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [14,'CAJA 4',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [15,'CAJA 5',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [16,'CAJA 6',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [17,'CAJA 60',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [18,'CAJA 61',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [19,'CAJA 62',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [20,'CAJA 63',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [21,'CAJA 64',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [22,'CAJA 65',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [23,'CAJA 66',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [24,'CAJA 67',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [25,'CAJA 68',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [26,'CAJA 69',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [27,'CAJA 7',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [28,'CAJA 70',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [29,'CAJA 8',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [30,'CAJA 9',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [31,'CAJA 91',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [32,'CAJA 92',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [33,'CAJA 93',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [34,'CAJA 94',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [35,'CAJA 95',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [36,'COL. AGRICOLA INDEPENDENCIA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [37,'COL. AGRICOLA MEXICO',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [38,'COL. BENITO JUAREZ',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [39,'COL. BENITO JUAREZ ',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [40,'COL. JUAREZ',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [41,'CURP',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [42,'DEPTO. DE TELECOMUNICACIONES, C.G.D.T.',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [43,'DIF',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [44,'DIRECCION',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [45,'GOBIERNO',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [46,'HOSPITAL DE LA MUJER',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [47,'IMSS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [48,'INNOVATECNOLOGIA Y PROCESOS ',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [49,'MATRIMONIOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [50,'NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [51,'OFICIAL MATRIMONIOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [52,'OFICIAL REGISTRO DE NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [53,'REGISTRO DE NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [54,'REGISTRO NACIMIENTOS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [55,'SISTEMAS',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [56,'SISTEMAS(DAÑADA)',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [57,'SISTEMAS(SERVIDORES)',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [58,'SISTEMAS(SOPORTE TECNICO)',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [59,'SOPORTE',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [60,'UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [61,'USE',$now]);
		DB::insert('insert into areas (id, area, created_at) values (?, ?, ?)', [62,'VISITADORA',$now]);
	}
}
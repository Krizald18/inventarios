<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class ModelosTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('modelos')->delete();
		/* pruebas caracteristica repetida en dos modelos diferentes
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [1,16,'6005',1,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [2,16,'6006',1,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [3,16,'Officejet Pro 8100',2,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [4,16,'ProDesk 405 G1',3,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [12,23,'N895',12,1,$now]);
		*/
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [2,16,'Officejet Pro 8100',2,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [3,16,'ProDesk 405 G1',3,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [4,16,'s5502',4,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [5,16,'D220',5,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [6,16,'DC5850',6,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [7,16,'DC7600',7,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [8,16,'DX2000',8,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [9,16,'EVO D510',9,1,$now]);
		//DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [10,16,'D220',10,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [11,16,'L1710',11,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [12,23,'N895',12,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [13,16,'VECTRA VL400',13,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [14,16,'VECTRA VL420',14,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [15,16,'LaserJet 1100 (C4224A)',15,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [16,16,'LaserJet 1200',16,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [17,16,'LaserJet 2035 / P2035',17,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [18,16,'LaserJet 2420n / dn',18,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [19,16,'LaserJet 4050n',19,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [20,16,'LaserJet P3005',20,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [21,16,'LaserJet 2200',21,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [22,16,'LaserJet 2300',22,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [23,16,'Compaq dc5700',23,1,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [24,16,'LaserJet P2015',24,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [25,16,'V203p',25,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [26,16,'S1933',26,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [27,8,'W1952a',27,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [28,27,'062-00097',28,12,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [29,16,'MO42KC',29,12,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [30,16,'M-S34',30,12,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [31,25,'SR2000VA',31,13,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [32,25,'SR INET 480',32,13,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [33,25,'Microvolt INET',33,14,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [34,25,'Microvolt 2KVA (DN-21-202)',34,14,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [35,25,'PC 500',35,14,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [36,14,'GT 10000+ (G650B)',36,17,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [37,21,'PS7000',37,17,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [38,16,'ScanJet 7400C',38,17,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [39,8,'KB-0133',39,21,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [40,11,'KB-5926',40,21,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [41,16,'KB-9970',41,21,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [42,20,'RT9410',42,21,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [43,7,'Unified IP Phone 7911G',43,23,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [44,7,'Unified IP Phone 7941G',44,23,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [45,16,'L1520',45,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [46,16,'54',46,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [47,26,'C5D1E-T02',47,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [48,16,'s7540',48,11,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [49,28,'OFFICE 500VA',49,13,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [50,5,'B-Smart 706',50,13,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [51,13,'ENH908-NWY',51,20,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [52,1,'OfficeConnect 8/TPO',52,6,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [53,15,'Dialog 3105MW',53,22,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [54,6,'500VA',54,13,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [55,24,'BP 2884',55,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [56,15,'Dialog 4222 Office',56,22,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [57,7,'1811',57,15,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [58,18,'FS-1200',58,7,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [59,16,'Compaq 6535b',59,10,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [60,1,'3C17206-US',60,20,$now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [61,16,'Server tc2110',61,18,$now]);
	}
}
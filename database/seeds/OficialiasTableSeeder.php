<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class OficialiasTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('oficialias')->delete();
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01001','VILLA DE AHOME',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01002','VILLA GUSTAVO DIAZ ORDAZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01003','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01004','TOPOLOBAMPO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01005','SAN MIGUEL ZAPOTITLAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01006','HIGUERAS DE ZARAGOZA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01007','HERIBERTO VALDEZ ROMERO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01008','PLAZA FATIMA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01009','I.M.S.S.',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01010','I.M.S.S. VILLA DE AHOME',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01885','SAN MIGUEL ZAPOTITLAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01886','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01887','TOPOLOBAMPO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01888','PLAZA FATIMA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01993','SAN MIGUEL ZAPOTITLAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01994','VILLA DE AHOME',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01996','VILLA GUSTAVO DIAZ ORDAZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01997','I.M.S.S.',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01998','PLAZA FATIMA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['01999','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02001','ANGOSTURA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02002','ALHUEY',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02003','COL. AGRICOLA MEXICO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02004','COL. AGRICOLA INDEPENDENCIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02005','GUSTAVO DIAZ ORDAZ (CPO. PLATA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02006','LA ILAMA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02007','LA REFORMA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02887','LA REFORMA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02888','ANGOSTURA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02998','LA REFORMA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['02999','ANGOSTURA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03001','BADIRAGUATO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03002','CIENEGA DE LOS LARA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03003','HIGUERA DE ALVAREZ DE BORBOA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03004','GUATENIPA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03005','OTATILLOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03006','SURUTATO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03007','SAN JOSE DEL LLANO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03008','SAN LUIS GONZAGA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03009','SAN NICOLAS DEL SITIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03010','TAMEAPA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03011','SAN JAVIER',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03888','BADIRAGUATO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['03999','BADIRAGUATO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04001','CONCORDIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04002','TEPUXTA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04003','AGUACALIENTE DE GARATE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04004','ZAVALA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04005','COPALA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04006','PANUCO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04007','MESILLAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04008','EL VERDE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04009','SANTA LUCIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04887','EL VERDE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04888','CONCORDIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['04999','CONCORDIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['05001','COSALA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['05002','LA ILAMA (COMEDERO)',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['05003','SAN JOSE DE LAS BOCAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['05004','GUADALUPE DE LOS REYES',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['05005','SANTA CRUZ DE ALAYA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['05888','COSALA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['05999','COSALA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06000','DIRECCION DEL REGISTRO CIVIL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06001','CENTRO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06002','EL SALADO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06003','COSTA RICA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06004','BAILA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06005','SANALONA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06006','AGUARUTO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06007','COL. TIERRA BLANCA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06008','I.M.S.S.',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06009','ELDORADO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06012','COL. LOMAS DE BOULEVARD',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06013','SAN LORENZO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06015','JESUS MARIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06016','COL. SINALOA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06018','HIGUERAS DE ABUYA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06020','QUILA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06021','VILLA ADOLFO LOPEZ MATEOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06022','CULIACANCITO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06023','IMALA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06024','LAS TAPIAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06025','TEPUCHE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06026','EMILIANO ZAPATA (EST. OBISPO)',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06027','TACUICHAMONA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06666','DIRECCION DE REGISTRO CIVIL (ACLARACIONES)',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06770','DIRECCION DEL REGISTRO CIVIL (MODULO DF)',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06777','MODULO TIJUANA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06778','DIRECCION DEL REGISTRO CIVIL (MODULO DF)',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06885','QUILA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06886','AGUARUTO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06887','I.M.S.S.',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06888','DIRECCION DE REGISTRO CIVIL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06990','QUILA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06991','MOD. PLAZA SUR',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06992','MOD. TIJUANA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06993','AGUARUTO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06994','MOD. UDO RC',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06995','MOD. PLAZA AMERICAS RC',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06996','MOD. H. AYUNTAMIENTO RC',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06997','MOD. PLAZA FIESTA RC',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06998','I.M.S.S.',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['06999','DIRECCION DEL REGISTRO CIVIL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07001','CHOIX',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07002','AGUACALIENTE GRANDE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07003','BACA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07004','PICACHOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07005','YECORATO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07006','SAN JAVIER',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07007','EL TORO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07888','CHOIX',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['07999','CHOIX',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['08001','ELOTA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['08002','ZOQUITITAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['08003','LA CRUZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['08004','EL ESPINAL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['08888','LA CRUZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['08999','LA CRUZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['09001','ESCUINAPA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['09002','LA CONCHA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['09003','PALMILLAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['09004','TEACAPAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['09888','ESCUINAPA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['09999','ESCUINAPA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10001','TEHUECO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10002','MOCHICAHUI',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10003','CHINOBAMPO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10004','SAN BLAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10005','CHARAY',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10006','EL FUERTE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10007','TETAROBA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10008','JAHUARA II',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10886','MOCHICAHUI',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10887','SAN BLAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10888','EL FUERTE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10997','SAN BLAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10998','MOCHICAHUI',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['10999','EL FUERTE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11001','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11002','BAMOA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11003','ADOLFO RUIZ CORTINEZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11004','TAMAZULA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11005','LEON FONSECA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11006','JUAN JOSE RIOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11007','LA TRINIDAD',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11008','LA BRECHA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11009','EL BURRION',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11010','DIF',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11011','NIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11012','SAN RAFAEL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11013','IMSS JUAN JOSE RIOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11886','DIF',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11887','JUAN JOSE RIOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11888','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11996','DIF',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11997','MOD. PLAZA CRISTINA GVE.',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11998','JUAN JOSE RIOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['11999','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12001','LA NORIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12002','COLONIA BENITO JUAREZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12003','EL QUELITE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12004','VILLA UNION',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12005','EL RECODO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12006','MARMOL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12007','SIQUEROS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12008','EL ROBLE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12009','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12010','IMSS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12011','ISLAS MARIAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12886','IMSS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12887','COLONIA BENITO JUAREZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12888','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12997','IMSS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12998','COLONIA BENITO JUAREZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['12999','UNIDAD ADMINISTRATIVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13001','MOCORITO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13002','EL VALLE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13003','CERRO AGUDO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13004','PERICOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13005','SAN BENITO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13006','ROSA MORADA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13007','MELCHOR OCAMPO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13887','PERICOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13888','MOCORITO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13998','PERICOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['13999','MOCORITO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14001','EL ROSARIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14002','POTRERILLOS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14003','POZOLE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14004','CHAMETLA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14005','CACALOTAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14006','MATATAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14007','MALOYA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14008','LA RASTRA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14009','AGUAVERDE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14888','EL ROSARIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['14999','EL ROSARIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['15001','GUAMUCHIL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['15002','VILLA BENITO JUAREZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['15888','GUAMUCHIL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['15999','GUAMUCHIL',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16001','SAN IGNACIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16002','SAN JUAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16003','SAN JAVIER',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16004','IXPALINO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16005','ESTACION DIMAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16006','AJOYA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16007','CONTRAESTACA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16008','COYOTITAN',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16009','PIAXTLA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16888','SAN IGNACIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['16999','SAN IGNACIO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17001','SINALOA DE LEYVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17002','OCORONI',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17003','SAN JOSE DE GRACIA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17004','GABRIEL LEYVA V. (TEMUCHINA)',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17005','LLANO GRANDE',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17006','ESTACION NARANJO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17007','BACUBIRITO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17008','SAN JOSE DE LAS DELICIAS',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17887','ESTACION NARANJO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17888','SINALOA DE LEYVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17998','ESTACION NARANJO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['17999','SINALOA DE LEYVA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['18001','NAVOLATO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['18002','SAN PEDRO',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['18003','VILLA ANGEL FLORES',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['18004','VILLA BENITO JUAREZ',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['18005','ALTATA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['18006','SATAYA',$now]);
		DB::insert('insert into oficialias (id, oficialia, created_at) values (?, ?, ?)', ['18007','JUAN ALDAMA',$now]);
	}
}
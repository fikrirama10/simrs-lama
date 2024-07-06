<?php
namespace common\components;
use yii\base\Component;
use Yii;
use common\models\TransaksiDetail;
use common\models\TransaksiDetailRinci;
use common\models\ObatMutasi;
use common\models\ObatKartustok;
use common\models\ObatDropingKartustok;
use common\models\ObatDropingMutasi;
use common\models\BarangAmprahMutasi;
use common\models\GudangInventori;
use common\models\RuanganBed;
use common\models\SettingSimrsBridging;

class FikriFunction extends Component{
    public static function allowedDomains()
	{
		return [
		   '*' ,  // star allows all domains
		   'http://localhost:3000',
		];
	}  
	function fetchApiData($url, $retryCount = 3, $retryDelay = 1) {
    $attempt = 0;
    
    while ($attempt < $retryCount) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // Adjust the timeout as needed
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Adjust the timeout as needed
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200) {
            return $response;
            } else {
                // Increment attempt counter and wait before retrying
                $attempt++;
                sleep($retryDelay);
            }
        }
        
        return false; // Return false if all attempts fail
    }
	function updatestatusRanap($kondisi){
		if($kondisi == 3){
			$model = 8;
		}else if($kondisi == 4){
			$model = 9;
		}else{
			$model = 4;
		}
		return $model;
	}
	function updateBed($idbed){
		$model = RuanganBed::findOne($idbed);
		$model->terisi = 0;
		$model->save();
		Yii::$app->vclaim->updateKamar();
	}
	function hitungLos($awal,$akhir){
		$date1=date_create($awal);
		$date2=date_create($akhir);
		$diff=date_diff($date1,$date2);
		if($diff->format("%d") < 1){
			return $diff->format("%d") + 1;
		}else{
			return $diff->format("%d");
		}
		
	}
	function mutasiamprah($idbarang,$mutasis,$jenis,$stok_awal,$qty,$asal,$dari){
		$mutasi = new BarangAmprahMutasi();
		$mutasi->tgl = date('Y-m-d H:i:s',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))));
		$mutasi->idbarang = $idbarang;
		$mutasi->idmutasi = $mutasis;
		$mutasi->idjenismutasi = $jenis;
		$mutasi->stok_awal = $stok_awal;
		$mutasi->qty = $qty;
		$mutasi->asal = $asal;
		$mutasi->dari = $dari;
		if($mutasis == 1){
			$mutasi->stok_akhir = $stok_awal - $qty;
		}else{
			$mutasi->stok_akhir = $stok_awal + $qty;
		}
		$mutasi->save(false);
		
	}
	
	function gudangStok($idgudang,$idobat,$jumlah,$tgl,$jenis){
		$gudang = GudangInventori::find()->where(['idgudang'=>$idgudang])->andwhere(['idobat'=>$idobat])->one();
		if($gudang){
			if($jenis == 1){
				$gudang->stok = $gudang->stok - $jumlah;
			}else{
				$gudang->stok = $gudang->stok + $jumlah;
			}
			
			$gudang->tgl_update = $tgl;
			$gudang->save(false);
		}else{
			$gudang_new = new GudangInventori();
			$gudang_new->idgudang = $idgudang;
			$gudang_new->idobat = $idobat;
			$gudang_new->stok = $jumlah;
			$gudang_new->tgl_update = $tgl;
			$gudang_new->save(false);
		}
	}
	function dropingkartuStok($idobat,$idbacth,$jumlah,$jenis){
		$model = new ObatDropingKartustok();
		$model->idobat = $idobat;
		$model->idbacth = $idbacth;
		$model->jumlah = $jumlah;
		$model->jenis = $jenis;
		$model->tgl = date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))));
		$model->save(false);
	}
	function dropingmutasiStok($idobat,$idbacth,$jenis_mutasi,$sub_mutasi,$jumlah,$keterangan,$stokawal){
		$model = new ObatDropingMutasi();
		$model->idobat = $idobat;
		$model->idbacth = $idbacth;
		$model->jumlah = $jumlah;
		$model->idjenis = $jenis_mutasi;
		$model->idsubmutasi = $sub_mutasi;
		$model->tgl =date('Y-m-d H:i:s',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))));
		$model->stok_awal = $stokawal;
		$model->keterangan = $keterangan;
		if($jenis_mutasi == 1 || $jenis_mutasi == 5){
			$model->stok_akhir = $stokawal - $jumlah;
		}else if($jenis_mutasi == 2 || $jenis_mutasi == 3 || $jenis_mutasi == 4){
			$model->stok_akhir = $stokawal + $jumlah;
		}
		$model->save(false);
		
	}
	
	
	// function kartuStokSo(){
		
	// }
	function kartuStok($idobat,$idbacth,$idasal,$jumlah,$jenis){
		$model = new ObatKartustok();
		$model->idobat = $idobat;
		$model->idbatch = $idbacth;
		$model->idasal = $idasal;
		$model->jumlah = $jumlah;
		$model->jenis = $jenis;
		$model->tgl =date('Y-m-d',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))));
		$model->save(false);
	}
	function mutasiStok($idobat,$idbacth,$jenis_mutasi,$sub_mutasi,$jumlah,$idtrx,$stokawal,$idgudang){
		$model = new ObatMutasi();
		$model->idobat = $idobat;
		$model->idtransaksi = $idtrx;
		$model->idgudang = $idgudang;
		$model->idbacth = $idbacth;
		$model->idjenismutasi = $jenis_mutasi;
		$model->idsubmutasi = $sub_mutasi;
		$model->tgl =date('Y-m-d H:i:s',strtotime('+6 hour',strtotime(date('Y-m-d H:i:s'))));
		$model->jumlah = $jumlah;
		$model->stokawal = $stokawal;
		if($jenis_mutasi == 1 || $jenis_mutasi == 5){
			$model->stokakhir = $stokawal - $jumlah;
		}else if($jenis_mutasi == 2 || $jenis_mutasi == 3 || $jenis_mutasi == 4){
			$model->stokakhir = $stokawal + $jumlah;
		}
		$model->save(false);
		
	}
	function trantindakan($idtrx,$idkunjungan,$idrawat,$idpelayanan,$tgl,$nama_tindakan,$tarif,$jenis,$idtindakan,$idbayar,$idjenispelayanan){
		$trxdetail = new TransaksiDetail();
		$trxdetail->idtransaksi = $idtrx;
		$trxdetail->idrawat = $idrawat;
		$trxdetail->idkunjungan = $idkunjungan;
		$trxdetail->idpelayanan = $idpelayanan;
		$trxdetail->tgl = $tgl;
		$trxdetail->nama_tindakan= $nama_tindakan;
		$trxdetail->tarif = $tarif;
		$trxdetail->total = $tarif * 1;
		$trxdetail->jumlah = 1;
		$trxdetail->status = 1;
		$trxdetail->idjenispelayanan = $idjenispelayanan;
		$trxdetail->jenis = $jenis;
		$trxdetail->idtindakan = $idtindakan;
		$trxdetail->idbayar = $idbayar;
		$trxdetail->save(false);
	}
	function tranruangan($idtrx,$idkunjungan,$idrawat,$idpelayanan,$tgl,$nama_tindakan,$tarif,$jenis,$idtindakan,$idbayar,$jumlah,$idjenispelayanan){
		$trxdetail = new TransaksiDetail();
		$trxdetail->idtransaksi = $idtrx;
		$trxdetail->idrawat = $idrawat;
		$trxdetail->idkunjungan = $idkunjungan;
		$trxdetail->idpelayanan = $idpelayanan;
		$trxdetail->tgl = $tgl;
		$trxdetail->nama_tindakan= $nama_tindakan;
		$trxdetail->tarif = $tarif;
		$trxdetail->total = $tarif * $jumlah;
		$trxdetail->jumlah = $jumlah;
		$trxdetail->status = 1;
		$trxdetail->idjenispelayanan = $idjenispelayanan;
		$trxdetail->jenis = $jenis;
		$trxdetail->idtindakan = $idtindakan;
		$trxdetail->idbayar = $idbayar;
		$trxdetail->save(false);
	}
	function tranruanganrinci($idtrx,$idrawat,$tgl,$tarif,$harga,$idbayar,$jumlah){
		$tarif_trx = new TransaksiDetailRinci();
		$tarif_trx->tgl = $tgl;
		$tarif_trx->idpaket = 0;
		$tarif_trx->idbayar = $idbayar;
		$tarif_trx->idjenis = 0;
		$tarif_trx->idrawat = $idrawat;
		$tarif_trx->idtransaksi = $idtrx;
		$tarif_trx->idtarif = $tarif;
		$tarif_trx->tarif = $harga * $jumlah;
		$tarif_trx->save(false);
	}
	function getSbb($usia,$jk,$hub){
	    $model='';
		if($usia < 1 ){
			$model = 'By';
		}else if($usia > 0 && $usia < 17){
			$model = 'An';
		}else if($usia > 16 ){
			if($jk == 'L'){
				$model = 'Tn';
			}else if($jk == 'P'){
				if($hub == 2){
					$model = 'Nn';
				}else{
					$model = 'Ny';
				}
			}
		}
		return $model; 
	}
	function getTgl($day){
		$result=substr($day,8,2)."-".substr($day,5,2)."-".substr($day,0,4);
		return $result;
	}
	function content_noid($url) {
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rs = curl_exec($ch);
		if(empty($rs)){
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}


	function bpjs_contentr($url, $post = '') {
	
		$data = '29855';
		$secretKey = '3rU307868B';
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

		if ($post)
		{
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rs = curl_exec($ch);
		
		if(empty($rs)){
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}
		function kamar($url, $post = '') 
		{
	
		$data = '22587';
		$secretKey = '1nCADB48DE';
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

		if ($post)
		{
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rs = curl_exec($ch);
		
		if(empty($rs)){
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}
	function kamarsulaiman($url, $post = '') 
	{
// 		$setting = SettingSimrsBridging::findOne(1);
		$data = '29855';
		$secretKey = '3rU307868B';
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
		$encodedSignature = base64_encode($signature);
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = "X-cons-id: " .$data. " ";
		$header[] = "X-timestamp: " .$tStamp. " ";
		$header[] = "X-signature: " .$encodedSignature. " ";
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

		if ($post)
		{
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rs = curl_exec($ch);
		
		if(empty($rs)){
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}
// 	{
	
// 		$data = '29855';
// 		$secretKey = '3rU307868B';
//         date_default_timezone_set('UTC');
//         $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
// 		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
// 		$encodedSignature = base64_encode($signature);
// 		$usecookie = __DIR__ . "/cookie.txt";
// 		$header[] = "X-cons-id: " .$data. " ";
// 		$header[] = "X-timestamp: " .$tStamp. " ";
// 		$header[] = "X-signature: " .$encodedSignature. " ";
// 		$header[] = 'Content-Type: application/json;charset=utf-8';
// 		$header[] = "Accept-Encoding: gzip, deflate";
// 		$header[] = "Cache-Control: max-age=0";
// 		$header[] = "Connection: keep-alive";
// 		$header[] = "Accept-Language:  en-US,en;q=0.8,id;q=0.6";
		
		
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, $url);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
// 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// 		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
// 		curl_setopt($ch, CURLOPT_HEADER, false);
// 		curl_setopt($ch, CURLOPT_VERBOSE, false);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// 		curl_setopt($ch, CURLOPT_ENCODING, true);
// 		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
// 		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

// 		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

// 		if ($post)
// 		{
// 			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// 			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
// 			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// 		}

// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// 		$rs = curl_exec($ch);
		
// 		if(empty($rs)){
// 			curl_close($ch);
// 			return false;
// 		}
// 		curl_close($ch);
// 		return $rs;
// 	}
}





?>
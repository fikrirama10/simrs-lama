<?php

namespace backend\controllers;

use Yii;
use common\models\Usg;
use common\models\Usgdetail;
use common\models\UsgSearch;
use yii\web\Controller;
use kartik\mpdf\Pdf;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter; 

/**
 * UsgController implements the CRUD actions for Usg model.
 */
class SistemInformasiController extends Controller
{
    public function actionKegiatanUgd($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kegiatan-ugd?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kegiatan-ugd?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('kegiatan-ugd',['json'=>$json,'bulan'=>$bulan]);
	}
	public function actionGetKegiatanUgd($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kegiatan-ugd?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kegiatan-ugd?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->renderAjax('get-kegiatan-ugd',['json'=>$json,'bulan'=>$bulan]);
	}
	public function actionLaporanKegiatan($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kegiatan-ugd?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kegiatan-ugd?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content= file_get_contents($url);
		$json = json_decode($content, true);
		$contentt = $this->renderPartial('print-ku',
		[
			'json'=>$json,
			'bulan'=>$bulan
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $contentt,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	}
	
	
	public function actionPenerimaanResep($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penerimaan-resep?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penerimaan-resep?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('penerimaan-resep',['json'=>$json,'bulan'=>$bulan]);
	}
	public function actionGetPenerimaanResep($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penerimaan-resep?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penerimaan-resep?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->renderAjax('get-penerimaan-resep',['json'=>$json,'bulan'=>$bulan]);
	}
	public function actionLaporanResep($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penerimaan-resep?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penerimaan-resep?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content2 = file_get_contents($url);
		$json = json_decode($content2, true);
		$content = $this->renderPartial('resep',
		[
			'json'=>$json,
			'bulan'=>$bulan
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	}
    public function actionPenyakitGigi($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penyakit-gigi?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penyakit-gigi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		
		return $this->render('penyakit-gigi',['json'=>$json]);
	}
	public function actionGetPenyakitGigi($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penyakit-gigi?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penyakit-gigi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		
		return $this->renderAjax('get-penyakit-gigi',['json'=>$json]);
	}
	
	public function actionLaporanPm($start='',$end='',$cek='') {
	  //tampilkan bukti proses		
		if($start !== '' && $end !== '' && $cek !== ''){			
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penyakit-gigi?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/penyakit-gigi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$content = $this->renderPartial('print-pm',
		[
			'json'=>$json,
			'bulan'=>$bulan
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	
	public function actionKunjungan($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			
			$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbul-rj?awal='.$start.'&akhir='.$end.'&jenis='.$search;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbul-rj?awal='.date('Y-m-d').'&akhir='.date('Y-m-d').'&jenis=1';
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('kunjungan',['json'=>$json,'bulan'=>$bulan]);
	}
	public function actionGetKunjungan($start='',$end='',$cek='',$search=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			if($search == 1){
				$title = 'POLIKLINIK';
			}else{
				$title = 'UGD';
			}
			$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbul-rj?awal='.$start.'&akhir='.$end.'&jenis='.$search;
			$bulan = date('F Y',strtotime($start));
		}else{
			if($search == 1){
				$title = 'Poliklinik';
			}else{
				$title = 'UGD';
			}
			$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbul-rj?awal='.date('Y-m-d').'&akhir='.date('Y-m-d').'&jenis=1';
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->renderAjax('get-kunjungan',['json'=>$json,'bulan'=>$bulan,'title'=>$title]);
	}
	
	public function actionLaporanKunjungan($start='',$end='',$cek='',$search='') {
	  //tampilkan bukti proses		
		if($start !== '' && $end !== '' && $cek !== ''){
			if($search == 1){
				$title = 'POLIKLINIK';
			}else{
				$title = 'UGD';
			}
			$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbul-rj?awal='.$start.'&akhir='.$end.'&jenis='.$search;
			$bulan = date('F Y',strtotime($start));
		}else{
			if($search == 1){
				$title = 'Poliklinik';
			}else{
				$title = 'UGD';
			}
			$url = 'https://simrs.rsausulaiman.com/dashboard/lapbul/lapbul-rj?awal='.date('Y-m-d').'&akhir='.date('Y-m-d').'&jenis=1';
			$bulan = date('F Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$content = $this->renderPartial('print-k',
		[
			'json'=>$json,
			'bulan'=>$bulan,
			'title'=>$title
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	
	
	public function actionKelahiran($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kelahiran?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kelahiran?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('kelahiran',['json'=>$json,'bulan'=>$bulan]);
	}
	public function actionGetKelahiran($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kelahiran?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kelahiran?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->renderAjax('get-kelahiran',['json'=>$json,'bulan'=>$bulan]);
	}
	
	public function actionLaporanKelahiran($start='',$end='',$cek='') {
	  //tampilkan bukti proses		
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kelahiran?awal='.$start.'&akhir='.$end;
			$bulan = date('F Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/kelahiran?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
			$bulan = date('F Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$content = $this->renderPartial('print-kl',
		[
			'json'=>$json,
			'bulan'=>$bulan
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	
	public function actionPartologiKlinik($start='',$end='', $cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/lab?awal='.$start.'&akhir='.$end;
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/lab?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
		} 
		$content2 = file_get_contents($url2);
		$json = json_decode($content2, true);
	
		return $this->render('partologi-klinik',['json'=>$json]);
	}
	public function actionGetPartologiKlinik($start='',$end='', $cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/lab?awal='.$start.'&akhir='.$end;
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/lab?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
		} 
		$content2 = file_get_contents($url2);
		$json = json_decode($content2, true);
	
		return $this->renderAjax('get-partologi-klinik',['json'=>$json]);
	}
	public function actionLaporanLab($start='',$end='',$cek=''){ 
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/lab?awal='.$start.'&akhir='.$end;
		$title = 'Bulan '.Yii::$app->algo->tglIndobuk(date('F',strtotime($start))).' Tahun '.date('Y',strtotime($start));
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/lab?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
		$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		 $content2 = file_get_contents($url2);
		$json = json_decode($content2, true);
		$content = $this->renderPartial('print-lab',
		[
			'title'=>$title,
			'json'=>$json,
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 
	  'marginTop' => '3',
	  'marginBottom' => '1',
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render();  
	}  
	public function actionKunjunganGigi($start='',$end='', $cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/kunjungan-gigi?awal='.$start.'&akhir='.$end;
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/kunjungan-gigi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
		}
		$content2 = file_get_contents($url2);
		$json = json_decode($content2, true);
	
		return $this->render('kunjungan-gigi',['json'=>$json]);
	}
	
	public function actionGetKunjunganGigi($start='',$end='', $cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/kunjungan-gigi?awal='.$start.'&akhir='.$end;
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/kunjungan-gigi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
		}
		$content2 = file_get_contents($url2);
		$json = json_decode($content2, true);
	
		return $this->renderAjax('get-kunjungan-gigi',['json'=>$json]);
	}
	public function actionLaporanKg($start='',$end='',$cek=''){ 
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/kunjungan-gigi?awal='.$start.'&akhir='.$end;
		$title = 'Bulan '.Yii::$app->algo->tglIndobuk(date('F',strtotime($start))).' Tahun '.date('Y',strtotime($start));
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/kunjungan-gigi?awal='.date('Y-m-d').'&akhir='.date('Y-m-d');
		$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		 $content2 = file_get_contents($url2);
		$json = json_decode($content2, true);
		$content = $this->renderPartial('print-kg',
		[
			'title'=>$title,
			'json'=>$json,
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 
	  'marginTop' => '3',
	  'marginBottom' => '1',
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render();  
	}  
	
	public function actionPengobatanGigi($start='',$end='',$cek=''){ 
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/pengobatan-gigi-kat?start='.$start.'&end='.$end;
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/pengobatan-gigi-kat?start='.date('Y-m-d').'&end='.date('Y-m-d');
		}
		$content2 = file_get_contents($url2);
		$json2 = json_decode($content2, true);
	
		return $this->render('pengobatan-gigi',['json2'=>$json2]);
	}  
	public function actionGetPengobatanGigi($start='',$end='',$cek=''){ 
		if($start !== '' && $end !== '' && $cek !== ''){
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/pengobatan-gigi-kat?start='.$start.'&end='.$end;
		}else{
		$url2 = 'https://simrs.rsausulaiman.com/dashboard/rest/pengobatan-gigi-kat?start='.date('Y-m-d').'&end='.date('Y-m-d');
		}
		$content2 = file_get_contents($url2);
		$json2 = json_decode($content2, true);
	 
		return $this->renderAjax('get-pengobatan-gigi',['json2'=>$json2]); 
	}  
	
	public function actionLaporanPg($start='',$end='',$cek=''){ 
		if($start !== '' && $end !== '' && $cek !== ''){
		$start = date('Y-m-d',strtotime($start));
		$end = date('Y-m-d',strtotime($end));
		$title = 'Bulan '.Yii::$app->algo->tglIndobuk(date('F',strtotime($start))).' Tahun '.date('Y',strtotime($start));
		}else{
		$start = date('Y-m-d');
		$end = date('Y-m-d');
		$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		  
		$content = $this->renderPartial('print-pg',
		[
			'title'=>$title,
			'start'=>$start,
			'end'=>$end,  
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 
	  'marginTop' => '3',
	  'marginBottom' => '1',
	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render();  
	}  
	public function actionMacamPenyakit($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/macam-penyakit?start='.$start.'&end='.$end;
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/macam-penyakit?start='.date('Y-m-d').'&end='.date('Y-m-d');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('macam-penyakit',['json'=>$json]);
	}
	public function actionGetMacamPenyakit($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/macam-penyakit?start='.$start.'&end='.$end;
		$title = 'Bulan '.date('F',strtotime($start)).' Tahun '.date('Y',strtotime($start)); 
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/macam-penyakit?start='.date('Y-m-d').'&end='.date('Y-m-d');
			
			$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->renderAjax('get-macam-penyakit',['json'=>$json,'title'=>$title]);
	}
	 public function actionLaporanMp($start='',$end='',$cek='') {
	  //tampilkan bukti proses		
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/macam-penyakit?start='.$start.'&end='.$end;
			$title = 'Bulan '.Yii::$app->algo->tglIndobuk(date('F',strtotime($start))).' Tahun '.date('Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/macam-penyakit?start='.date('Y-m-d').'&end='.date('Y-m-d');
			$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$content = $this->renderPartial('print-mp',
		[
			'json'=>$json,
			'title'=>$title,
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_PORTRAIT, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
	
	public function actionPelayananRanap($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pelayanan-ranap?start='.$start.'&end='.$end;
			$title = 'Bulan '.date('F',strtotime($start)).' Tahun '.date('Y',strtotime($start)); 
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pelayanan-ranap?start='.date('Y-m-d').'&end='.date('Y-m-d');
			
			$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->render('pelayanan-ranap',['json'=>$json]);
	}
	
	public function actionGetPelayananRanap($start='',$end='',$cek=''){
		if($start !== '' && $end !== '' && $cek !== ''){
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pelayanan-ranap?start='.$start.'&end='.$end;
		$title = 'Bulan '.date('F',strtotime($start)).' Tahun '.date('Y',strtotime($start)); 
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pelayanan-ranap?start='.date('Y-m-d').'&end='.date('Y-m-d');
			
			$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		return $this->renderAjax('get-pelayanan-ranap',['json'=>$json,'title'=>$title]);
	}
	 public function actionLaporanPr($start='',$end='',$cek='') {
	  //tampilkan bukti proses		
		if($start !== '' && $end !== '' && $cek !== ''){
				$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pelayanan-ranap?start='.$start.'&end='.$end;
			$title = 'Bulan '.Yii::$app->algo->tglIndobuk(date('F',strtotime($start))).' Tahun '.date('Y',strtotime($start));
		}else{
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pelayanan-ranap?start='.date('Y-m-d').'&end='.date('Y-m-d');
			$title = 'Bulan '.date('F').' Tahun '.date('Y');
		}
		 
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$content = $this->renderPartial('print-pr',
		[
			'json'=>$json, 
			'title'=>$title,
		]);
		
	  // setup kartik\mpdf\Pdf component
	  $pdf = new Pdf([
	   'mode' => Pdf::MODE_CORE,
	   'destination' => Pdf::DEST_BROWSER,
	   'format' => Pdf::FORMAT_A4, 
	   'orientation' => Pdf::ORIENT_LANDSCAPE, 

	   'content' => $content,  
	   'cssFile' => '@frontend/web/css/paper.css',
		//'options' => ['title' => 'Bukti Permohonan Informasi'],
	   ]);
		 $response = Yii::$app->response;
			$response->format = \yii\web\Response::FORMAT_RAW;
			$headers = Yii::$app->response->headers;
			$headers->add('Content-Type', 'application/pdf');
	  
	  // return the pdf output as per the destination setting
	  return $pdf->render(); 
	 }
}

<?php 
use yii\helpers\Html;
use common\models\Pekerjaan;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

$pekerjaan = Pekerjaan::find()->where(['idpasien'=>$model->no_rekmed])->count();
?>
<div class='header1'>
	<div class='logo'>
	<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/LOGO RUMKIT BARU.jpg',['class' => 'img img-responsive']);?>
	</div>
	<div class='header2'>
	<h3>RSAU dr.NORMAN T.LUBIS</h3>
	<h5>Jalan Terusan Kopo No 500<br> 
	Telp (022) 5409608</h5>
	</div>
	<div class='headerbr'> 
		
		<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?>
			<div style='font-size:15px; letter-spacing: 4px;'>
			RM : <?= $model->no_rekmed ?> 
			</div>
	</div>
</div>

<div class='bodi'>
<h4>IDENTITAS PASIEN</h4>
	<h5>A. Data Pasien</h5> 
	<div class='npa'><h5><b>Nama Pasien : </b><?= $model->nama_pasien?> (<?= $model->sbb?>)</h5></div>
	<div class='npd'><h5><b>Jenis Kelamin :</b> ( <?= $model->jenis_kelamin?> )</h5></div>
	<div class='npd'><h5><b>Gol darah :</b> ( <?= $model->gol_darah?> )</h5></div>
	<div class='ttl'><h5><b>Tempat, Tanggal Lahir :</b> <?= $model->tempat_lahir?>, <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> </h5></div>
	<div class='npd'><h5><b>Umur :</b> ( <?= $model->usia?> Th )</h5></div>
	<div class='npd'><h5><b>Status :</b> ( <?= $model->idStatus->status_hub ?> )</h5></div>
	<div class='agama'><h5><b>Agaama :</b><br> ( <?= $model->agama?>  )</h5></div>
	<div class='alamat'><h5><b>Alamat :</b> <?= $model->alamat ?>,<br> <b>No Tlp :</b> <?= $model->nohp ?></h5></div>
	<div class='keyakinan'><b style='font-size:12;'>Nilai nilai Keyakinan<b><h5><?php if($model->nilaikeyakinan == 1){echo'Ada';}else{echo'Tidak						';}?></h5> </div>
	<div class='npd2'>
	    <h5><b>Pekerjaan :
	    <?php if($pekerjaan < 1){echo'';}else{ ?>
	    </b>
	    <?php if($model->idpekerjaan != null){ ?>
	    <?= $model->pekerjaan->jenis ?>
    	    <?php }else{ ?>
    	    -
    	    <?php } ?>
	    <?php } ?>
	    </h5>
	</div>
	<div class='npd2'>
	    <h5><b>Pangkat :</b> 
	   <?php if($pekerjaan < 1){echo'';}else{ ?>
	    </b>
	    <?php if($model->idpekerjaan != null){ ?>
	    <?= $model->kerja->pangkat ?>
    	    <?php }else{ ?>
    	    -
    	    <?php } ?>
	    <?php } ?>
	    </h5>
	</div>
	<div class='npd2'><h5><b>Kesatuan :</b>
	     <?php if($pekerjaan < 1){echo'';}else{ ?>
	    </b>
	    <?php if($model->idpekerjaan != null){ ?>
	    <?= $model->kerja->kesatuan ?>
    	    <?php }else{ ?>
    	    -
    	    <?php } ?>
	    <?php } ?>
	</h5></div>
	<div class='npd2'><h5><b>Nrp :</b>  
	<?php if($pekerjaan < 1){echo'';}else{ ?>
	    </b>
	    <?php if($model->idpekerjaan != null){ ?>
	    <?= $model->kerja->nrp ?>
    	    <?php }else{ ?>
    	    -
    	    <?php } ?>
	    <?php } ?>
	</h5></div>
	<?php if($rawatjalan->idjenisrawat == 3){?>
	<h5>B. Data <?= $rawatjalan->jerawat->jenisrawat ?></h5>
	<div class='rawat'><h5><b>No rawat :</b> <?= $rawatjalan->idrawat ?></h5><?= '<img style="padding-bottom:10px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($rawatjalan->idrawat, $generator::TYPE_CODE_128)) . '">'; ?></div><div class='daftar'><h5><b>Tanggal Daftar / Masuk : </b><?= date('d F Y',strtotime($rawatjalan->tgldaftar)) ?></h5>
	<h5><b>Jam Daftar / Masuk : </b><?= date('g:i A',strtotime($rawatjalan->tgldaftar)) ?></h5>
	</div>
	<?php if($rawatjalan->idjenisrawat == 1){?>
	<div class='npd'><h5><b>Poli : </b><?= $rawatjalan->polii->namapoli ?> </h5></div>
	<div class='npa'><h5><b>Dokter :</b> <?= $rawatjalan->dokter->namadokter?> </h5></div>
	<div class='npd'><h5><b>cara bayar :</b><?= $rawatjalan->carabayar->jenisbayar?> </h5></div>
	<?php }else if($rawatjalan->idjenisrawat == 2){?>
	<div class='ttl'><h5><b>Penanggung : </b><?php if($rawatjalan->penanggung == null){echo" - ";}else{ echo $rawatjalan->penanggung;}?> </h5></div>
	<div class='hub'><h5><b>Hubungan Penanggung : </b><?php if($rawatjalan->hubungan == null){echo" - ";}else{ echo $rawatjalan->hub->hubungan;}?> </h5></div>
	<div class='ttl'><h5><b>Alamat Penanggung : </b><?php if($rawatjalan->penanggung == null){echo" - ";}else{ echo $rawatjalan->penanggung;}?> </h5></div>
	<div class='hub'><h5><b>No Telp Penanggung  : </b><?php if($rawatjalan->hubungan == null){echo" - ";}else{ echo $rawatjalan->hubungan;}?> </h5></div>
	<div class='ttl'><h5><b>Dokter  : </b><?php if($rawatjalan->iddokter == null){echo" - ";}else{ echo $rawatjalan->dokter->namadokter;}?> </h5></div>
	<div class='npd'><h5><b>Ruangan :</b> <?= $rawatjalan->kamar->namaruangan ?></h5></div>
	<div class='npd'><h5><b>Kelas :</b> <?= $rawatjalan->kelas->namakelas ?></h5></div>
	<?php }else if($rawatjalan->idjenisrawat == 3){ ?>
	<div class='ttl'><h5><b>Penanggung : </b><?php if($rawatjalan->penanggung == null){echo" - ";}else{ echo $rawatjalan->penanggung;}?> </h5></div>
	<div class='hub'><h5><b>Hubungan Penanggung : </b><?php if($rawatjalan->hubungan == null){echo" - ";}else{ echo $rawatjalan->hub->hubungan;}?> </h5></div>
	<div class='ttl'><h5><b>Alamat Penanggung : </b><?php if($rawatjalan->penanggung == null){echo" - ";}else{ echo $rawatjalan->alamat_penanggung;}?> </h5></div>
	<div class='hub'><h5><b>No Telp Penanggung  : </b><?php if($rawatjalan->hubungan == null){echo" - ";}else{ echo $rawatjalan->notlp;}?> </h5></div>
	
	<?php } ?>
	
	<?php } ?>
	<div class='npo'><h5><b>Jenis Bayar :</b><?= $rawatjalan->carabayar->jenisbayar ?> </h5></div>
	
</div>
<?php if($rawatjalan->anggota == 1){ echo '<div style="width:100px; float:right; height:50px; border-radius:100%; border:1px solid #4287f5;"><h4 style="color:#4287f5;" align=center> Anggota </h4></div>'; } ?>   
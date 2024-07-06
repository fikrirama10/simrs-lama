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
	<?php if($rawatjalan->anggota == 1){ echo '<div style="width:100px; float:right; height:50px; border-radius:100%; border:1px solid #4287f5;"><h4 style="color:#4287f5;" align=center> Anggota </h4></div>'; } ?>   
	</div>
	
</div>
<table>
  <tr>
    <th colspan=3>Formulir Identitas Pasien</th>
  </tr>
  <tr>
    <td width=220>NAMA PASIEN</td>
    <td colspan=2><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></td>
  </tr>
  <tr>
    <td>NO REKAMMEDIS</td>
    <td ><span class='rm'><?= $model->no_rekmed?></span></td>
	<td width=80><div class='barcode'><?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div></td>
  </tr>
   <tr>
    <td>TEMPAT , TANGGAL LAHIR</td>
    <td colspan=2><?= $model->tempat_lahir ?> , <?= Yii::$app->algo->tglIndoNoTime($model->tanggal_lahir); ?></td>
  </tr>
  <tr>
    <td>usia</td>
    <td colspan=2><?= $model->usia?> Thn</td>
  </tr>
  <tr>
    <td>Agama</td>
    <td colspan=2><?= $model->agama?></td>
  </tr>
  <tr>
    <td>Pekerjaan</td>
    <td colspan=2>
		<?php if($pekerjaan < 1){echo'';}else{ ?>
	    </b>
	    <?php if($model->idpekerjaan != null){ ?>
	    <?= $model->pekerjaan->jenis ?>
    	    <?php }else{ ?>
    	    -
    	    <?php } ?>
	    <?php } ?>
	</td>
  </tr>
  	<?php if($rawatjalan->anggota == 1){ ?>
	    <tr>
            <td width=220>PANGKAT</td>
            <td colspan=2>
               <?php if($pekerjaan < 1){echo'';}else{ ?>
        	    </b>
        	    <?php if($model->idpekerjaan != null){ ?>
        	    <?= $model->kerja->pangkat ?>
            	    <?php }else{ ?>
            	    -
             	    <?php } ?>
	         <?php } ?>
            </td>
        </tr>
        <tr>
            <td width=220>Kesatuan</td>
            <td colspan=2>
              <?php if($pekerjaan < 1){echo'';}else{ ?>
        	    </b>
        	    <?php if($model->idpekerjaan != null){ ?>
        	    <?= $model->kerja->kesatuan ?>
            	    <?php }else{ ?>
            	    -
            	    <?php } ?>
        	    <?php } ?>
            </td>
        </tr>
        <tr>
            <td width=220>NRP</td>
            <td colspan=2>
              	<?php if($pekerjaan < 1){echo'';}else{ ?>
        	    </b>
        	    <?php if($model->idpekerjaan != null){ ?>
        	    <?= $model->kerja->nrp ?>
            	    <?php }else{ ?>
            	    -
            	    <?php } ?>
        	    <?php } ?>
            </td>
        </tr>
	<?php } ?>
  <tr>
    <td>Golongan Darah</td>
    <td colspan=2><?= $model->gol_darah?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td colspan=2>
		<?= $model->alamat ?>
	</td>
  </tr>
  <tr>
    <td>No Telpon / HP</td>
    <td colspan=2><?= $model->nohp ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td colspan=2><?= $model->email?></td>
  </tr>
  <tr>
    <td>Tgl Daftar</td>
    <td colspan=2><?= $rawatjalan->tgldaftar?> </td>
  </tr>
  <tr>
    <td width=220>Penanggung</td>
    <td colspan=2><?= $rawatjalan->carabayar->jenisbayar ?></b></td>
  </tr>
</table>
<hr>
<?php if($rawatjalan->idjenisrawat == 3){ ?>
<table>
  <tr>
    <th colspan=3>Data <?= $rawatjalan->jerawat->jenisrawat ?></th>
  </tr>
  <tr>
    <td width=220>penanggung jawab</td>
    <td colspan=2><?= $rawatjalan->penanggung?> </b></td>
  </tr>
  <tr>
    <td width=220>Hubungan</td>
    <td colspan=2><?= $rawatjalan->hub->hubungan ?> </b></td>
  </tr>
  <tr>
    <td width=220>Alamat</td>
    <td colspan=2><?= $rawatjalan->alamat_penanggung ?> </b></td>
  </tr>
  <tr>
    <td width=220>No Telpon</td>
    <td colspan=2><?= $rawatjalan->notlp ?> </b></td>
  </tr>
  
</table>
<?php } ?>

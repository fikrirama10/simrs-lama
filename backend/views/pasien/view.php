<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use common\models\Jenisbayar;
use common\models\Dokter;
use yii\helpers\ArrayHelper;
use common\models\Poli;
use yii\web\View;
use common\models\Rawatjalan;
use common\models\Rekamedis;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$time = date('H:i:s');
$hrj = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 1])->count();
$hri = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 2])->count();
$igd = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->andwhere(['idjenisrawat'=> 3])->count();
$rawat = Rawatjalan::find()->where(['no_rekmed'=> $model->no_rekmed])->orderby(['tgldaftar'=>SORT_DESC])->all();
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasisens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasisen-view">
<?php // \inquid\signature\SignatureWidget::widget(['clear' => true,'save_png'=>true, 'undo' => true, 'change_color' => true, 'url' => 'test', 'save_server' => true]) ?>
    <h1><?= Html::encode($this->title) ?>
	<?php 
	$rm = Rekamedis::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
	if($rm > 0 ){
		$rma = Rekamedis::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
		echo "(Status Sedang di luar , Di ".$rma->peminjam.")";
	}else{echo"";} ?>
	
	</h1>
	<div class="rawatjalan-form">
		<div class='container-fluid'>
			<div class='box box-info'>
				<div class='box box-header'>
					<h3>Detail Pasien</h3>
					
				</div>
				<div class='box box-body'>
					<div class='row'>
						<div class='col-xs-8'>
							<a class='nama_pasien'><?= $model->sbb ?>. <?= $model->nama_pasien ?></a> <a class='jenis_kelamin'>( <?= $model->jenis_kelamin ?> )</a> , <a class='jenis_kelamin'>( <?= $model->idStatus->status_hub ?> )</a> , 
						</div>
						<div class='col-xs-4 cs'>
							
							<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?>
						</div>
						
						<div class='col-md-12 bt10' >
						RM : <a style='padding-right:20px;'><?= $model->no_rekmed ?></a>   No bPJS :<a style='padding-right:20px;'> <?= $model->nobpjs ?>	</a></a>   Tanggal Daftar :<a> <?= $model->created_at ?>	</a>
						</div>		
					</div>
					<div class='row'>
						<div class='col-md-4 gol_darah'>
							<b style='font-size:15px;'><?= $model->tempat_lahir?>, <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th )</b><br>
							
							<?= $model->alamat ?>,
							<?php if($model->idkel == null && $model->idkel == null && $model->idkel == null){echo "";}else{ ?>
							<?= $model->kel->nama ?> , <?= $model->kec->nama ?> , <?= $model->kab->nama ?>
							<?php } ?>
						</div>
						<div class='col-md-2' style=' text-align:center; padding-top:25px; border-right:1px solid #eee;'>
							<a style='font-size:40px;'><?= $hrj ?>x</a><br>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-obat">
              Rawatjalan
              </button>
						</div>
						<div class='col-md-2' style=' text-align:center; padding-top:25px; border-right:1px solid #eee;'>
							<a style='font-size:40px;'><?= $hri ?>x</a><br> <a class='btn btn-warning' href=''>Rawat Inap</a>
						</div>
						<div class='col-md-2' style=' text-align:center; padding-top:25px; border-right:1px solid #eee;'>
							<a style='font-size:40px;'><?= $igd ?>x</a><br> <a class='btn btn-danger' href='<?= Url::to(['pasien/igd/'.$model->id]) ?>'>IGD</a>
						</div>
				
					</div>
					</div>
				</div>
				<div class='box box-danger'>
				<div class='box box-body'>
				<?= Html::a('Print Rekamedik', ['hdiagnosa', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm pt-10','target' => '_blank']) ?>
					<h3>Data Rekamedik</h3>
					<div class='row'>
						<?php foreach($rawat as $r):?>
						<div class='col-md-12'>
					
							<div class='box box-body'>
							<h3><?= date('d F Y',strtotime($r->tgldaftar)) ?> <?php if($r->idjenisrawat == 2){echo' | '. date('d F Y',strtotime($r->tglkeluar));}else{echo'';}?></h3>
							
							<a style='color:grey;'><?= $r->no_rekmed ?> , <?= $r->idrawat?>,<?= $r->carabayar->jenisbayar?>,<?= $r->nosep?></a>
							<h6><?= $r->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($r->pasien->tanggal_lahir)) ?> ,<?=$r->pasien->usia?> th</h6>
							<a><?php if($r->idjenisrawat == 1){echo $r->jerawat->jenisrawat .' , '. $r->polii->namapoli;}
							else if($r->idjenisrawat == 2){echo $r->jerawat->jenisrawat .','. $r->idkelas;}else{echo $r->jerawat->jenisrawat;} 
							?><?php if($r->idkb == null){echo'';}else if($r->idkb == 1){ ?>
							<b>( Berobat Baru )</b>
							<?php }else{echo'(Kontrol)';} ?>
							</a>
							<?php if(Yii::$app->user->identity->idpriv <= 4){ ?>
							<a class='btn btn-primary pull-right' href='<?= Url::to(['rawatjalan/'.$r->id]) ?>' >Lihat</a>
							<?php if($r->idjenisrawat == 1){ ?>
							<a class='btn btn-warning pull-right' href='<?= Url::to(['pasien/kontrol/'.$model->id]) ?>' >Kontrol</a>
							<?php }else if($r->idjenisrawat == 3){ ?>
							<a class='btn btn-danger pull-right' href='<?= Url::to(['pasien/kontroligd/'.$model->id]) ?>' >Kontrol IGD</a>
							<?php }else{echo'';}  ?>
							<?php }else{echo'-';} ?>
						</div>
						
						</div>
						<?php endforeach; ?>
					
				</div>
				
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-obat">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rawatjalan</h4>
              </div>
    <div class="modal-body">
	<div class = "container-fluid">
		  <div class='row'>
							 <?php $form = ActiveForm::begin(); ?>
							<?= $form->field($rawatjalan, 'no_rekmed')->textInput(['value'=>$model->no_rekmed]) ?>
						<?= $form->field($lograwat, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
						<?php if($model->jenis_kelamin == 'L'){ ?>
							<?php if($model->usia <=17){ ?>
							<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['between','id',1,4])->andwhere(['anak'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php }else{ ?>
									<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['between','id',1,4])->andwhere(['dewasa'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php } ?>
						<?php }else{ ?>
							<?php if($model->usia <=16){ ?>
							<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['anak'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php }else{ ?>
									<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['dewasa'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php } ?>
						<?php } ?>
						<?= $form->field($rawatjalan, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['id'=>0])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatjalan, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
					<?= $form->field($rawatjalan, 'ketrj')->textarea(['rows'=>6])->label("Keterangan") ?>
					<?=$form->field($rawatjalan, 'anggota', [
						'template' => '{input}{label}{error}{hint}',
						'labelOptions' => ['class' => 'cbx-label']
						])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Anggota ?'); 
					?>
					<?=$form->field($rawatjalan, 'rencranap', [
						'template' => '{input}{label}{error}{hint}',
						'labelOptions' => ['class' => 'cbx-label']
						])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Rawat  ?'); 
					?> 
								
								
								
							</div>
	</div>
             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
				<?php ActiveForm::end(); ?>
              </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<div class="modal fade" id="modal-igd">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">IGD</h4>
              </div>
    <div class="modal-body">
	<div class = "container-fluid">
		  <div class='row'>
					
								
							</div>
	</div>
             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               
              </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
	  
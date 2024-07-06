<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\widgets\TabularInput;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\TargetPenerimaanDetail;
use common\models\Pagu;
$pagu = Pagu::find()->where(['kodepagu'=>$model->kodepagu])->one();
$detail = TargetPenerimaanDetail::find()->where(['kodetarget'=>$model->id])->all();
$no = 1;
$pg = $pagu->nilaipagu/12;
/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-barang-view">
<?php if($model->status != 1){ ?>
<?php $form = ActiveForm::begin(); ?>
<div class='box box-body'>       
	<h4>Target Penerimaan <?= $pagu->bayar->jenisbayar ?></h4>
	<hr>
	
	<hr>
	   <div class="row">
                <div class="col-lg-6">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th class="col-lg-3">Nama</th>
                        <th class="col-lg-3">Persentase</th>
                        <th class="col-lg-3">#</th>
                        </tr>
                        </thead>
                        <?=
                          TabularInput::widget([
                            'id' => 'detail-grid',
                            'model' => \common\models\TargetPenerimaanDetail::className(),  // <---- ini
                            'allModels' => $aNilai,  // <---- dan ini
                            'options' => ['tag' => 'tbody'],
                            'itemOptions' => ['tag' => 'tr'],
                            'itemView' => '_item_detail',
                        ])
                        ?>
                    </table>
                </div>
        </div>
        <div class="row">
                <div class="col-lg-6">
                    <div class="box-footer">
                    <?= Html::submitButton('Create',['class' => 'btn btn-success']) ?>
                    </div>
                </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
<?php }else{ ?>
<div class='box'>
	<div class='box-header'>
	<h4>Detail rencana penerimaan <?= $pagu->bayar->jenisbayar ?> FKTL bulan <?= date('F',strtotime($model->tahun.'-'.$model->bulan.'-01')) ?> tahun 2021</h4>
	</div>
	<div class='box-body'>
		<table class='table table-hover table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Jenis Penerimaan</th>
					<th>Nilai Pagu</th>
					<th>Detail</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$no=1;
				if($detail){
					foreach($detail as $t):
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $t->penerimaan ?></td>
				<td>Rp. <?=  Yii::$app->algo->IndoCurr(floor(($t->nilaipagu / 100) * $pg))  ?></td>
				<td><a href='<?= Url::to(['pagu/rincian-target?id='.$t->id]) ?>'>Lihat detail >>> </a></td>
			</tr>
			<?php endforeach;?>
			
			<?php }else{ ?>
			<tr>
				<td colspan=3>Belum ada data</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
		<a href='<?= Url::to(['pagu/'.$pagu->id]) ?>'>Kembali >>> </a>
	</div>
</div>
<?php } ?>
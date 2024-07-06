<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\widgets\TabularInput;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\TargetPenerimaan;
use common\models\TargetPenerimaanRincian;
use common\models\Pagu;
$pagu = TargetPenerimaan::find()->where(['id'=>$detail->kodetarget])->one();
$rincian = TargetPenerimaanRincian::find()->where(['kodetarget'=>$detail->id])->all();
$no = 1;
$pg = ( $detail->nilaipagu / 100)* $pagu->nilaipagu;
/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarang */

$this->title = $detail->id;
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $pg ?>
<div class="permintaan-barang-view">
<?php if($detail->status != 1){ ?>
<?php $form = ActiveForm::begin(); ?>
<div class='box box-body'>       
	<h4>Rincian Target Penerimaan </h4>
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
                            'model' => \common\models\TargetPenerimaanRincian::className(),  // <---- ini
                            'allModels' => $aNilai,  // <---- dan ini
                            'options' => ['tag' => 'tbody'],
                            'itemOptions' => ['tag' => 'tr'],
                            'itemView' => '_item_rincian',
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
				if($rincian){
					foreach($rincian as $t):
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $t->penerimaan ?></td>
				<td>Rp. <?=  Yii::$app->algo->IndoCurr(floor(($t->nilaipagu / 100) * $pg))  ?></td>
				<td></td>
			</tr>
			<?php endforeach;?>
			
			<?php }else{ ?>
			<tr>
				<td colspan=3>Belum ada data</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
		<a href='<?= Url::to(['pagu/detail-target?id='.$pagu->id]) ?>'>Kembali >>> </a>
	</div>
</div>
<?php } ?>

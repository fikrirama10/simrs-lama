<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use common\models\Kattindakanlab;
use common\models\Subkattindakanlab;
use \unclead\multipleinput\examples\models\Item;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\Pemriklab;
use mdm\widgets\TabularInput;
$periklab = Pemriklab::find()->where(['kodelab'=>$model->kodelab])->andwhere(['labid'=>$model->id])->all();
//$hermatologi = Pemriklab::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisp'=>$model->idjenisp])->all();
?>
<?php if($model->status == 1){ ?>
<div class='box box-body'>       
<h1><?= $model->katlab->nama ?></h1><hr>
	<table class='table table-bordered'>
		<tr>
			<th>Nama Pemeriksaan</th>
			<th>Hasil</th>
			<th>Satuan</th>
			<th>Nilai Normal</th>
			<th>Edit</th>
		</tr>
		<?php foreach($periklab as $pl): ?>
		<tr>
			<td><?= $pl->kat->nama?></td>
			<td><?= $pl->hasil ?></td>
			<td><?= $pl->kat->satuan ?></td>
			<td>L: <?= $pl->kat->l?> | P: <?= $pl->kat->p?></td>
			<td><a href='<?= Url::to(['lab/editlab/'.$pl->id]) ?>'><span class="label label-success">Edit</span></a></td>
		</tr>
		<?php endforeach ; ?>
	</table>
	<br><hr>
	<a class='btn btn-warning btn-md' href='<?= Url::to(['/orderlab/'.$model->orlab->id]) ?>'>Selesai</span></a>
</div>
<?php }else{ ?>
<?php $form = ActiveForm::begin(); ?>
<div class='box box-body'>       
<h1><?= $model->katlab->nama ?></h1><hr>
	   <div class="row">
                <div class="col-lg-6">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th class="col-lg-3">Nama</th>
                        <th class="col-lg-3">NIlai</th>
                        <th class="col-lg-3">Satuan</th>
                        <th class="col-lg-3">Nilai Normal</th>
                        </tr>
                        </thead>
                        <?=
                          TabularInput::widget([
                            'id' => 'detail-grid',
                            'model' => \common\models\Pemriklab::className(),  // <---- ini
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
<?php } ?>
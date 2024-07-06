<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\RikkesRadiologi */

$this->title = $model->namakegiatan;
$this->params['breadcrumbs'][] = ['label' => 'Rikkes Radiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rikkes-radiologi-view box box-body">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'namakegiatan',
			'tanggal',
			'jenis',
		],
	]) ?>
	<h3>Data Rikkes</h3>

	<hr>
	<p>
		<?= Html::a('Print Label', ['rikkes-radiologi/label?id=' . $model->id], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Print Hasil', ['rikkes-radiologi/printtni?id=' . $model->id], ['class' => 'btn btn-warning']) ?>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-obat"> + </button>
	</p>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		//'id' => 'ajax_gridview',
		'hover' => true,
		'bordered' => false,
		'columns' => [
			['class' => 'kartik\grid\SerialColumn'],
			'nomer_tes',
			'nofoto',
			'nama',
			[
				'attribute' => 'Usia',
				'format' => 'raw',
				'hAlign' => 'center',
				'value' => function ($model, $key, $index) {
					return $model->usia . 'Th';
				},
			],


			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{edit}{hapus}',
				'buttons' => [



					'edit' => function ($url, $model) {
						return Html::a(
							'<span class="label label-primary"><span class="fa fa-pencil">Edit</span></span>',
							$url
						);
					},
					'hapus' => function ($url, $model) {
						return Html::a(
							'<span class="label label-danger"><span class="fa fa-trash"></span></span>',
							$url,
							[
								'title' => Yii::t('yii', 'Delete'),
								'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
								'data-method' => 'post',
							]
						);
					},



				],
			],



		],
	]); ?>

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
				<div class="container-fluid">
					<div class='row'>
						<?php $form = ActiveForm::begin(); ?>
						<?= $form->field($rikes, 'idrikes')->hiddenInput(['maxlength' => true, 'value' => $model->id])->label(false) ?>
						<?= $form->field($rikes, 'nama')->textInput(['maxlength' => true]) ?>
						<?= $form->field($rikes, 'nofoto')->textInput(['maxlength' => true]) ?>
						<?= $form->field($rikes, 'usia')->textInput() ?>
						<button type="button" id="tesstb" class="btn btn-info" data-toggle="modal" data-target="#mdTemplate"><i class='fa fa-search'></i>Template</button>
						<br><label>Pemeriksaan</label>
						<textarea class='form-control' rows='6' name="RikkesRadiologiDetail[pemeriksaan]" id="rikkesradiologidetail-pemeriksaan">
Cor tidak membesar.
Sinuses, dan diafragma normal.
Pulmo :
- Hili normal.
- Corakan bronkhovaskuler normal.
- Tidak tampak infiltrat.
									    
									</textarea>
						<label>Kesan</label>
						<textarea class='form-control' rows='6' name="RikkesRadiologiDetail[kesan]" id="rikkesradiologidetail-kesan">
Pulmo tidak tampak kelainan.
Tidak tampak kardiomegali.
									    
									</textarea>
						<?= $form->field($rikes, 'kualifikasi')->textInput() ?>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id' => 'confirm']) ?>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<?php

$this->registerJs("

	
	$('#testb').on('click',function(){
		$('#rikkesradiologidetail-pemeriksaan').val('Cor sinuses dan diafragma normal Pulmo : Hilli normal Corakan bronkhovaskuler normal. Tidak tampak infiltrat');
		$('#rikkesradiologidetail-kesan').val('Cor dan Pulmo tidak tampak kelainan');
		
	});
	
	
", View::POS_READY);
?>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Klpcm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Klpcms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="klpcm-view box box-body">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'no_rekmed',
            'tdklengkap:ntext',
            'jform:ntext',
            'tanggal',
        ],
    ]) ?>
	<?php if($model->dokumen != null){ ?>
								<hr>
									<div class="PDF">
									   <object data="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$model->dokumen;?>" type="application/pdf" width="750" height="750">
										   alt : <a href="<?= Yii::$app->params['baseUrl'].'/frontend/upload/documents/'.$model->dokumen;?>"><?= $model->dokumen;?></a>
									   </object>
									</div>
						
	<?php }else{ ?>
	<h3>Upload Dokumen</h3><hr>
	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'dokumen')->widget(FileInput::classname(), [
						'options' => ['accept' => 'dokemen/*'],
						'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png','pdf','xps','doc','docx','xls','xlsx','ppt','pptx','rar','zip','jpeg','mp3','wav','txt']]]);?>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
	<?php } ?>
</div>

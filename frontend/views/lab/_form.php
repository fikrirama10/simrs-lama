<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Daflab;
use common\models\Kattindakanlab;
use common\models\Dokter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Lab;
$lab = Lab::find()->where(['idrawat'=>$rj->idrawat])->all();
/* @var $this yii\web\View */
/* @var $model common\models\Lab */
/* @var $form yii\widgets\ActiveForm */
$no = 1;
?>

<div class="lab-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'no_rekmed')->textInput(['value'=>$rj->no_rekmed,'maxlength' => true]) ?>
    <?= $form->field($model, 'idrawat')->textInput(['value'=>$rj->idrawat,'maxlength' => true]) ?>
    <?= $form->field($model, 'idpengirim')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label("Dokter Pemeriksa")?>
 <?= $form->field($model, 'idjenisp')->dropDownList(ArrayHelper::map(Daflab::find()->all(), 'id', 'namapemeriksaan'),['prompt'=>'- Tindakan Lab -','onchange'=>'$.get("'.Url::toRoute('lab/lablist/').'",{ id: $(this).val() }).done(function( data ) 
                {
                  $( "select#lab-idkatjenisp" ).html( data );
                });
                '])?> 
                   <?= $form->field($model, 'idkatjenisp')->dropDownList(ArrayHelper::map(Kattindakanlab::find()->where(['kat'=>0])->all(), 'id', 'nama'))?>

    <div class="form-group">
        <?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class='box box-body'>
<table class='table table-responsive table-bordered'>
    <tr>
        <th>#</th>
        <th>Nama Pemeriksaan Lab</th>
        <th>Pengirim</th>
        <th>No RM</th>
        <th>Id Rawat</th>
        <th>Tanggal</th>
    </tr>
    <?php foreach ($lab as $l ): ?>
    <tr>
        <td><?= $no++?></td>        
        <td><?= $l->katlab->nama ?></td>        
        <td><?= $l->dokter->namadokter ?></td>        
        <td><?= $l->no_rekmed?></td>        
        <td><?= $l->idrawat ?></td>        
        <td><?= date('d F Y , G:i A',strtotime($l->tanggal_req))?></td>        
    </tr>
    <?php endforeach; ?>
</table>
<a href='<?= Url::to(['/lab'])?>' class='btn btn-success'>Order</a>
</div>

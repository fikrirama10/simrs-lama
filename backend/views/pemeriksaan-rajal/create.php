<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRajal */

$this->title = 'Pemeriksaan Poliklinik';
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Rajals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
	<div class='box box-header'>
	<h1><?= Html::encode($this->title) ?></h1>
	</div>
    

    <?= $this->render('_form', [
        'model' => $model,
        'rajal' => $rajal,
    ]) ?>

</div>

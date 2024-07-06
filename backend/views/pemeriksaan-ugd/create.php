<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanIgd */

$this->title = 'Pemeriksaan UGD';
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Igds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-igd-create">
	<div class='box'>
	<div class='box box-header'>
			<h1><?= Html::encode($this->title) ?></h1>
	</div>
    

    <?= $this->render('_form', [
        'model' => $model,
        'rajal' => $rajal,
    ]) ?>

	</div>
</div>

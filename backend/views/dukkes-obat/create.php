<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DukkesObat */

$this->title = 'Tambah Obat Dukkes';
$this->params['breadcrumbs'][] = ['label' => 'Dukkes Obats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-obat-create">
	<div class='panel panel-default'>
		<div class='panel-heading'><h1><?= Html::encode($this->title) ?></h1></div>
		<div class='panel-body'>
			<?= $this->render('_form', [
			'model' => $model,
			]) ?>
		</div>
	</div>
   

    

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Jenispengaduan;
use common\models\Penilaian;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PengaduanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengaduan Rsau dr.Norman T.Lubis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengaduan-index"  style='margin-bottom:20px;'>
		<?= Html::a('Buat Pengaduan', ['create'],['class' => 'btn btn-success btn-sm pt-10']) ?>
</div>

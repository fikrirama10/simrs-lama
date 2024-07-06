<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\widgets\TabularInput;
use yii\widgets\ActiveForm;
use common\models\BarangMasukdetail;
use yii\helpers\Url;
$no = 1;
/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarang */

$this->params['breadcrumbs'][] = ['label' => 'Permintaan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-barang-view">
<?php $form = ActiveForm::begin(); ?>
<div class='box box-body'>       
	<h4>Penerimaan Obat / Alkes </h4>
	<hr>
	<table class='table table-bordered'>
		<tr>
			<td width=200>Nomer Register Gudang</td>
			<td width=20>:</td>
			<td><?= $masuk->idtrx?></td>
		</tr>
		<tr>
			<td width=200>Nomer Usul Pesan</td>
			<td width=20>:</td>
			<td><?= $model->idpermintaan?></td>
		</tr>
		<tr>
			<td width=200>Nomer Faktur</td>
			<td width=20>:</td>
			<td><?= $masuk->faktur?></td>
		</tr>
		<tr>
			<td width=200>Jenis Penerimaan</td>
			<td width=20>:</td>
			<td><?= $masuk->bayar->jenisbayar?></td>
		</tr>
		<tr>
			<td width=200>Tgl Penerimaan</td>
			<td width=20>:</td>
			<td><?= $masuk->tanggal?></td>
		</tr>
	</table>
	<hr>
	   <div class="row">
                <div class="col-lg-8">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th class="col-lg-3">Nama</th>
                        <th class="col-lg-1">Permintaan</th>
                        <th class="col-lg-2">Jumlah</th>
                        <th class="col-lg-3">Kadaluarsa</th>
                        </tr>
                        </thead>
                        <?=
                          TabularInput::widget([
                            'id' => 'detail-grid',
                            'model' => \common\models\BarangMasukdetail::className(),  // <---- ini
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


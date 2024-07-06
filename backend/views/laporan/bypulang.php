<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\date\DatePicker;
use common\models\Jenisbayar;
use common\models\Jenisrawat;

$bayar = Jenisbayar::find()->all();
$jenisrawat = Jenisrawat::find()->all();
/* @var $this yii\web\View */
/* @var $model common\models\Daftaronline */

?>
<div class='box box-body'>
<h4>Pasien Pulang By Tanggal Pulang</h4><hr>
<form role="search" action="<?= Url::to(['billing/report'])?>" method="get">
							<div class="form-group">
								<div class='row'>
									<div class='col-md-12'>
										<div class='row'>
											<div class='col-md-3'><label>Tanggal Awal</label>
												<?= DatePicker::widget([
												'id' => 'awal',
												'name' => 'start',
												//'value' => $start,
												'options' => ['placeholder' => 'awal'],
												'removeButton' => false,
												'pluginOptions' => [
													'format' => 'yyyy-mm-dd',
													'todayHighlight' => true
												]
												]); ?>
											
											</div>
											<div class='col-md-3'><label>Tanggal Akhir</label>
												<?= DatePicker::widget([
												'id' => 'akhir',
												'name' => 'end',
												//'value' => $start,
												'options' => ['placeholder' => 'Akhir'],
												'removeButton' => false,
												'pluginOptions' => [
													'format' => 'yyyy-mm-dd',
													'todayHighlight' => true
												]
												]); ?>
											
											</div>
											<div class='col-md-3'><label>Jenis Rawat</label>
											    <select  class="form-control" name='cek' id='textsearch' >
                        									<option value=''>Jenis Rawat</option>
                        									<?php foreach($jenisrawat as $jrawat ): ?>
                        									<option value="<?= $jrawat->id ?>"><?= $jrawat->jenisrawat ?></option>
                        									<?php endforeach; ?>
                        						</select>
											</div>
											<div class='col-md-3'><label>Jenis Bayar</label>
											    <select  class="form-control" name='search' id='textsearch'>
                        									<option value=''>Jenis Bayar</option>
                        									<?php foreach($bayar as $b ): ?>
                        									<option value="<?= $b->id ?>"><?= $b->jenisbayar ?></option>
                        									<?php endforeach; ?>
                        						</select>
											</div>
										</div><br>
										 <button type="submit"  class= 'btn btn-success' formtarget="_blank">Submit</button>
										 
										
									</div>
									
									
							
								</div>
								
								
								
							</div>
							
							</form>
							</div>

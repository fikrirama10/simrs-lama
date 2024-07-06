<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use common\models\Jenisbayar;
use common\models\Daftaronline;
use common\models\Poli;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $pasien common\models\Daftaronline */
$daftaronline = Daftaronline::find()->where(['tanggal'=>date('Y-m-d')])->all();
?>

<div class="daftaronline-view">
<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>	
		
				<?php if(empty($query)):?>
					<div class='alert alert-warning'>
					Data  <b><?php echo $_GET['norm'];?></b> tidak ada
					</div>
					
				<?php else:?>
				<h2>Data Di temukan RM <?= $_GET['norm'] ?> </h2><hr>
					<div class='row'>
						<div class='col-md-6'>
						    <div class="medilife-contact-card mb-50">

                            <div class="single-contact d-flex align-items-center">
                                <div class="contact-icon mr-30">
                                    <i class="icon-doctor"></i>
                                </div>
                                <div class="contact-meta">
                                    <p>Nama: <?= $query->nama_pasien?></p>
                                </div>
                            </div>

                            <div class="single-contact d-flex align-items-center">
                                <div class="contact-icon mr-30">
                                    <i class="icon-doctor"></i>
                                </div>
                                <div class="contact-meta">
                                    <p>Tanggal Lahir: <?= date('d F Y',strtotime($query->tanggal_lahir)) ?> ( <?= $query->usia ?> )th</p>
                                </div>
                            </div>
							<div class="single-contact d-flex align-items-center">
                                <div class="contact-icon mr-30">
                                    <i class="icon-doctor"></i>
                                </div>
                                <div class="contact-meta">
                                    <p>Alamat: <?= $query->alamat ?></p>
                                </div>
                            </div>
							<div class="single-contact d-flex align-items-center">
                                <div class="contact-icon mr-30">
                                    <i class="icon-doctor"></i>
                                </div>
                                <div class="contact-meta">
                                    <p>Gender: <?= $query->jenis_kelamin ?></p>
                                </div>
                            </div>

                            <div class="single-contact d-flex align-items-center">
                                <div class="contact-icon mr-30">
                                    <i class="icon-doctor"></i>
                                </div>
                                <div class="contact-meta">
                                    <p>Telepon: <?= $query->nohp?></p>
                                </div>
                            </div>


                          
                        </div>
						 <div class="panel single-accordion">
                            <h6><a role="button" class="" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Perhatian
                                    <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    </a></h6>
                            <div id="collapseOne" class="accordion-content collapse show">
                                
								<p>
								<b>Untuk Pasien BPJS</b><br>
								- Untuk Bisa Melakukan Pendaftaran Online Pasien Harus Sudah Memiliki Rujukan Dari Faskes 1 <br>
								- Harap Membawa FC Surat Rujukan , Kartu keluarga, KTP , dan kartu BPJS  saat melakukan verivikasi</p>
                            </div>
                        </div>
					</div>
					<div class='col-md-6'  style=' background:#081f3e; padding:10px 10px 10px 10px; color:#ececec;'>
					<h3 style='color:#fff;'>Form Kelengkapan data</h3><hr>
						<?php $form = ActiveForm::begin(); ?>
						<?php ($online->noregistrasi)? $online->noregistrasi : $online->genKode()?>
						<?= $form->field($online, 'no_rekmed')->hiddeninput(['value'=>$query->no_rekmed])->label(false) ?>
						<?= $form->field($online, 'noregistrasi')->textInput(['readonly'=>true])->label('no registrasi') ?>
						<?= $form->field($online, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->where(['between', 'id', 4, 5])->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label('Jenis Bayar')?>
						<?= $form->field($online, 'nokartu',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['placeholder' => "Di isi jika pasien bpjs"],['maxlength' => true])->label('No Kartu BPJS') ?>
						<?= $form->field($online, 'norujukan',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['placeholder' => "Di isi jika pasien bpjs"],['maxlength' => true])->label('No Rujukan') ?>
						<select id="pasienonline-idpoli" class="form-control" name='Pasienonline[idpoli]' aria-invalid="false">
						<?php foreach($daftaronline as $df): ?>
							<option value='<?= $df->id?>'><?= $df->polie->namapoli?></option>
						<?php endforeach; ?>
							</select>
						<?= $form->field($online, 'nohp')->textInput(['placeholder' => "No Hp Yang Bisa Di hubingi"],['maxlength' => true])->label('No Telepon') ?>
						<div class="form-group">
						<?= Html::submitButton('Daftar', ['class' => 'btn btn-success btn-lg']) ?>
						</div>
						<?php ActiveForm::end(); ?>

					</div>
					</div>
				<?php endif;?>
				</div>
				</section>
				
<?php 


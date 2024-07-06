<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Rawatjalan;
use common\models\Ppi;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Dokter */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$rj = Rawatjalan::find()->where(['iddokter'=>$model->id])->andwhere('status > 2')->orderby(['tgldaftar' => SORT_DESC])->all();
$countrj = Rawatjalan::find()->where(['iddokter'=>$model->id])->groupby(['no_rekmed'])->andwhere('status > 2')->count();

?>


  <div class="">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4 col-xs-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            
              <h3 class="profile-username text-center"><?= $model->namadokter?></h3>

              <p class="text-muted text-center">Spesialis</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Pasien</b> <a class="pull-right"><?= $countrj ?></a>
                </li>
              
                <li class="list-group-item">
                  
				 

				<!-- Generated markup by the plugin -->
				<div class="tooltip bs-tooltip-top" role="tooltip">
				  <div class="arrow"></div>
				  <div class="tooltip-inner">
					
				  </div>
				</div>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8 col-xs-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Pasien</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
				<div class='row'>
				<?php foreach($rj as $r):?>
					<div class='col-md-12'>
						<div class='box box-body'>
							<h3><?= $r->pasien->sbb ?>, <?= $r->pasien->nama_pasien?> ( <?= $r->pasien->jenis_kelamin ?> )</h3>
							<a style='color:grey;'><?= $r->no_rekmed ?> - Kode Rawat <?= $r->idrawat ?> (<?= $r->jerawat->jenisrawat?>)</a>
							<h6><?= $r->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($r->pasien->tanggal_lahir)) ?> ,<?=$r->pasien->usia?> th</h6>
							<a class='btn btn-primary pull-right' href='<?= Url::to(['rawatjalan/'.$r->id]) ?>'>Lihat</a>
						</div>
					</div>
				<?php endforeach;?>
				</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                 
				  <li class="time-label">
                        <span class="bg-blue">
                        
                        </span>
                  </li>
				
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#"></h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                      </div>
                    </div>
					
					 <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">PPI</a> </h3>
					   
                  <!-- END timeline item -->
                  <!-- timeline item -->
                 
                  <!-- END timeline item -->
                  <!-- timeline item -->
					
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

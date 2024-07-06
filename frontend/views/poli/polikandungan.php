<?php
$date = date('d F Y');
?>
<div class='container-fluid'>
	        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#timeline" data-toggle="tab">Daftar Pasien Poli</a></li>
            
            </ul>
            <div class="tab-content">
        
              <!-- /.tab-pane -->
              <div class="active  tab-pane" id="timeline">
                <!-- The timeline -->
				<h3>Pasien Poli Kandungan</h3><hr>
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
				  
                  <?php foreach($model as $a): ?>
					
                 
				  <li class="time-label">
                        <span class="bg-blue">
                       <?= $a->idrawat ?>
                        </span>
                  </li>
				  
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
			
                    <i class="fa fa-stethoscope bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time">RM <?= $a->no_rekmed?></span>

                      <h3 class="timeline-header"><a href="#"><?= $a->pasien->nama_pasien ?></a></h3>

                      <div class="timeline-body">
                       <b><?= $a->dokter->namadokter?></b>
                      </div>
                      <div class="timeline-footer">
                        <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/awalkandungan/'.$a->id?>' class="btn btn-success btn-xs">Periksa</a>
                        <a class="btn btn-warning btn-xs">Poli Kandungan</a>
                      </div>
                    </div>
                  </li>
				  <li>
				    <i class="fa fa-money bg-gray"></i>
					<div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><?= $a->carabayar->jenisbayar?>
                      </h3>
                    </div>
				  </li>
				   <?php endforeach; ?>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                 
                  <!-- END timeline item -->
                  <!-- timeline item -->

                  <!-- END timeline item -->
                  <!-- timeline time label -->
                 
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
					<div class="timeline-item">
                

                      <h3 class="timeline-header no-border"><?= $date?>
                      </h3>
                    </div>
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
	
		
		
	
</div>

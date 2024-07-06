<?php
$date = date('d F Y');
?>
<div class='container-fluid'>
	        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Update</a></li>
            </ul>
            <div class="tab-content">
        
              <!-- /.tab-pane -->
              <div class="active  tab-pane" id="timeline">
                <!-- The timeline -->
				<h3>Pasien IGD</h3><hr>
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
				  
                  <?php foreach($model as $a): ?>
					
                 
				  <li class="time-label">
                        <span class="bg-purple">
                       <?= $a->idrawat ?>
                        </span>
                  </li>
				  
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
			
                    <i class="fa fa-ambulance bg-red"></i>

                    <div class="timeline-item">
                      <span class="time">RM <?= $a->no_rekmed?></span>

                      <h3 class="timeline-header"><a href="#"><?= $a->pasien->nama_pasien ?></h3>

                      <div class="timeline-body">
                       
                      </div>
                      <div class="timeline-footer">
                        <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/awaligd/'.$a->id?>' class="btn btn-success btn-xs">Periksa</a>
                        <a class="btn btn-danger btn-xs">IGD</a>
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
				<!-- The timeline -->
				<h3>Pasien IGD</h3><hr>
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
				  
                  <?php foreach($model2 as $a2): ?>
					
                 
				  <li class="time-label">
                        <span class="bg-purple">
                       <?= $a2->idrawat ?>
                        </span>
                  </li>
				  
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
			
                    <i class="fa fa-ambulance bg-red"></i>

                    <div class="timeline-item">
                      <span class="time">RM <?= $a2->no_rekmed?></span>

                      <h3 class="timeline-header"><a href="#"><?= $a2->pasien->nama_pasien ?></h3>

                      <div class="timeline-body">
                       
                      </div>
                      <div class="timeline-footer">
                        <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/update/'.$a2->id?>' class="btn btn-success btn-xs">Edit</a>
                        <a class="btn btn-danger btn-xs">IGD</a>
                      </div>
                    </div>
                  </li>
				  <li>
				    <i class="fa fa-money bg-gray"></i>
					<div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><?= $a2->carabayar->jenisbayar?>
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
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
	
		
		
	
</div>

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <!-- START ALERTS AND CALLOUTS -->
    <h1 class="page-header">
       &nbsp;<i class="fa fa-dashboard"></i> <b>REPORT</b>
    </h1>
    <div class="row">
    	 <?php
				
				$url1 = array('Admin','DetailedReport','full');
				
				$url2 = array('Admin','DetailedReport','trouble');
				
        $url5 = array('Admin','DetailedReport','processing');

				$url3 = array('Admin','DetailedReport','complete');
				
				$url4= array('Admin','DetailedReport','leftover');
				?>
      <div class="col-md-8">

        <div class="col-md-2 col-sm-2 col-md-offset-0.75 box0">
          <div class="box1">
            <center>
            <h3><a href="<?php echo site_url($url1); ?>" class="btn btn-lg btn-primary">dikirim</a></h3>
            <!-- <span class="glyphicon glyphicon-list-alt"></span> -->
            <h3><?php echo $wo ?></h3>
            </center>
          </div>
        </div> <!-- /.box0 -->

        <div class="col-md-2 col-sm-2 col-md-offset-0.75 box0">
          <div class="box1">
          <center>
            <h3><a href="<?php echo site_url($url5); ?>" class="btn btn-lg btn-info">diproses</a></h3>
            <!-- <span class="glyphicon glyphicon-list-alt"></span> -->
            <h3><?php echo $wop ?></h3>
            </center>
          </div>
        </div> <!-- /.box0 -->

        <div class="col-md-2 col-sm-2 col-md-offset-0.75 box0">
          <div class="box1">
            <center>
            <h3><a href="<?php echo site_url($url2); ?>" style ="text-align : center" class="btn btn-lg btn-danger">terkendala</a></h3>
            <!-- <span class="glyphicon glyphicon-list-alt"></span> -->
            <h3><?php echo $wot ?></h3>
            </center>
          </div>
        </div> <!-- /.box0 -->

        <div class="col-md-2 col-sm-2 col-md-offset-0.75 box0">
          <div class="box1">
          <center>
            <h3><a href="<?php echo site_url($url3); ?>" class="btn btn-lg btn-success">complete</a></h3>
            <!-- <span class="glyphicon glyphicon-list-alt"></span> -->
            <h3><?php echo $woc ?></h3>
            </center>
          </div>
        </div> <!-- /.box0 -->

       <div class="col-md-2 col-sm-2 col-md-offset-0.75 box0">
          <div class="box1">
          <center>
            <h3><a href="<?php echo site_url($url4); ?>" class="btn btn-lg btn-warning">sisa</a></h3>
              <!-- <span class="glyphicon glyphicon-list-alt"></span> -->
            <h3><?php echo $wos ?></h3>
            </center>
          </div>
        </div> <!-- /.box0 -->
        
      </div>

      <br /><br />    
  </section>
</div>
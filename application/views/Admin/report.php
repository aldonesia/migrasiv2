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
<div class="container">
        <br />
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Fase</th>
                    <th>Jumlah</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
 
<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list_fase')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

</script>
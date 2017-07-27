<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             &nbsp;<i class="fa fa-book"></i><?php echo $page_header ?>
          </h1>
        </section>
        
         <section class="content">
          <div class="row">
          	<div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                       	<th>NO</th>
                       	<th>TANGGAL</th>
		          		<th>ND</th>
		          		<th>STO</th>
		          		<th>RK</th>
		          		<th>DP</th>
		          		<th>FASE</th>
		          		<th>STATUS</th>
		          		<th>TEKNISI</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php
                        $no = 1;
						if($flag) {
                        foreach ($query as $object) {
                          echo '<tr>';
						echo '<td>' .$no. '</td>';
						echo '<td>' .$object->tanggal_transaksi . '</td>';
						echo '<td>' .$object->ND_transaksi . '</td>';
						echo '<td>' .$object->STO_transaksi . '</td>';
						echo '<td>' .$object->RK_transaksi . '</td>';
						echo '<td>' .$object->DP_transaksi . '</td>';
						foreach ($query_fase as $object_fase) {
							if($object->id_fase_transaksi==$object_fase->id_fase)
							{
								echo '<td>' .$object_fase->nama_fase . '</td>';
							}
						}
						foreach ($query_status as $object_status) {
							if($object->id_status_transaksi==$object_status->id_status)
							{
								echo '<td>' .$object_status->nama_status . '</td>';
							}
						}
						if(!is_null($object->id_user_transaksi)) {
							foreach($query_teknisi as $object_teknisi) {
								if($object->id_user_transaksi == $object_teknisi->id_user) echo '<td>' . $object_teknisi->nama_user . '</td>';
							}
						}
						else {
							if(!$query_teknisi) {
								echo '<td>Tidak ada teknisi! Daftarkan dulu teknisinya, klik </td>';
								$url = array('User/AddTeknisi');
								echo anchor(site_url($url),'ini','rel="nofollow"') . '<br/>';
							}
							else {
								#echo 'Mau diassign ke siapa? -> ';
								echo form_open();
								echo '<td>' . form_dropdown('teknisi', $select) . form_submit('mysubmit','Submit'). '</td>';
								echo form_hidden('idt',$object->id_transaksi);
								$url_sent_from = current_url();
								echo form_hidden('url',$url_sent_from);
								echo form_hidden('flag',TRUE);
								#echo form_submit('mysubmit','Submit');
								echo form_close();
							}
						}
                           echo '</tr>';        
                          $no++;
                        }
                    }else {
							echo ' ';
						}
                        ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->	

			</div>


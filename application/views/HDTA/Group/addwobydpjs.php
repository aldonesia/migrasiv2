<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="container">
            <div class="alert alert-success" style="display: none;"></div>
        <div class="row">
            <div class="col-md-offset-3 col-lg-6">
                <h1 class="text-center">Tambah WO per DP</h1>
                <form id="AddForm" action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="sto">STO</label>
                        <select class="form-control" name="sto" id="sto">
                            <option value="">Select STO</option>
                            <?php foreach($query_STO as $object): ?>
                                <option value="<?php echo $object->CAREA; ?>"><?php echo $object->CAREA; ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="rk">RK</label>
                        <select class="form-control" name="rk" id="rk" disabled="">
                            <option value="">Select RK</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="dp">DP</label>
                        <select class="form-control" name="dp" id="dp" disabled="">
                            <option value="">Select DP</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <select class="form-control" name="mitra" id="mitra" disabled="">
                            <option value="">Select Mitra</option>
                                <?php 
                                #                             !vCHANGEv!
                                    foreach($select_mitra as $object => $value) {
                                        $object = htmlspecialchars($object); 
                                        echo '<option value="'. $object .'">'. $value .'</option>';
                                    }
                                ?>
                        </select>
                      </div>
                </form>
                  <button type="button" id="btnAdd" class="btn btn-primary" disabled>Tambah</button>
            </div>
        </div>
        <!-- /.row -->

    </div>
</div>
    <div id="confirmation" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
            <label>
            Apakah anda yakin?
            </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">YAAA!</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- jQuery Version 1.11.1 -->
    

    <!-- Bootstrap Core JavaScript 
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>-->
    <script type="text/javascript">
        $('#btnAdd').click(function(){
            $('#confirmation').modal('show');
            $('#AddForm').attr('action', '<?php echo base_url() ?>HDTA/addWO_js');
        });
        $('#btnSave').click(function(){
            var url = $('#AddForm').attr('action');
            var data = $('#AddForm').serialize();
            //validate form
           
            $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#confirmation').modal('hide');
                            $('#AddForm')[0].reset();
                            if(response.type=='add'){
                                var type = 'added'
                            }
                            $('.alert-success').html('WO '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('Could not add data');
                    }
                });
            });
        $(document).ready(function(){
           $('#sto').on('change', function(){
                var sto = $(this).val();
                if(sto == '')
                {
                    $('#rk').prop('disabled', true);
                }
                else
                {
                    $('#rk').prop('disabled', false);
                    $('#dp').prop('disabled', true);
                    $('#mitra').prop('disabled', true);
                    $.ajax({
                        url:"<?php echo base_url() ?>HDTA/getRK_js",
                        type: "POST",
                        data: {'sto_post' : sto},
                        dataType: 'json',
                        success: function(data){
                           $('#rk').html(data);
                        },
                        error: function(){
                            alert('Error occur...!!');
                        }
                    });
                }
           }); 
           $('#rk').on('change', function(){
                var rk = $(this).val();
                if(rk == '')
                {
                    $('#dp').prop('disabled', true);
                    $('#mitra').prop('disabled', true);
                }
                else
                {
                    $('#dp').prop('disabled', false);
                    $('#mitra').prop('disabled', false);
                    $.ajax({
                        url:"<?php echo base_url() ?>HDTA/getDP_js",
                        type: "POST",
                        data: {'rk_post' : rk},
                        dataType: 'json',
                        success: function(data){
                           $('#dp').html(data);
                        },
                        error: function(){
                            alert('Error occur...!!');
                        }
                    });
                }
           });
           $('#dp').on('change', function(){
                var dp = $(this).val();
            });
           $('#mitra').on('change', function(){
                var mitra = $(this).val();
                $('#btnAdd').prop('disabled', false);
            });
        });
    </script>

</body>

</html>

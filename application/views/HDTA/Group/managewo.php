    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Kembali</a></li>
            
            <li class="active">Kelola WO</li>
          </ol>
        <h3>Data wo</h3>
        <div class="alert alert-success" style="display:none;"></div>
        <br />
        <button class="btn btn-success" onclick="add_wo()"><i class="glyphicon glyphicon-plus"></i> Add to WO</button>
        <button class="btn btn-danger" id="uncheck"><i class="glyphicon glyphicon-minus"></i> Uncheck</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" class="chkbox" id="check-all"></th>
                    <th>ND</th>
                    <th>CAREA</th>
                    <th>RK</th>
                    <th>DP</th>
                    <th>UIM SERVICE STATUS</th>
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
    $('#uncheck').click(function(){
    $("input:checkbox").attr('checked', false);
  });
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('HDTA/ajax_list')?>",
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

function add_wo()
{
    var list_id = [];
    var temp = '';
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure add this '+list_id.length+' data?'))
        {       
            $('#modal_form').modal('show');
            $('#form').attr('action','<?php echo base_url()?>HDTA/ajax_add_wos');
            $('#btnAdd').click(function(){
            var url = $('#form').attr('action');
            var mitra = $('#form').serialize();
            //validate form
           
            $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: {"id":list_id,"mitra":mitra},
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#modal_form').modal('hide');
                            $('#form')[0].reset();
                            $('input:checkbox').attr('checked',false);
                            while(list_id.length != 0) {
                                list_id.pop();
                            }
                            if(response.type=='add'){
                                var type = 'added'
                            }
                            $('.alert-success').html('WO '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                            reload_table();
                        }else{
                            alert('Error');
                        }
                    }
                });
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add WO Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Mitra</label>
                            <div class="col-md-9">
                                <select name="id_mitra" class="form-control" placeholder="mitra">
                                    <option value="">Pilih Mitra</option>
                                    <?php 
                                        foreach($select_mitra as $object => $value) {
                                            $object = htmlspecialchars($object); 
                                            echo '<option value="'. $object .'">'. $value .'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAdd" class="btn btn-primary">Add WO</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
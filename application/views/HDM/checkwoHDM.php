<div class="container">
        <div class="alert alert-success" style="display: none;"></div>
        <br />
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Data Masuk</th>
                    <th>ND</th>
                    <th>Tanggal Input Teknisi</th>
                    <th>Teknisi</th>
                    <th>Fase</th>
                    <th>Status</th>
                    <th>Kendala</th>
                    <th>Keterangan</th>
                    <th>ODP</th>
                    <th>SN</th>
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
            "url": "<?php echo site_url('HDM/ajax_list')?>",
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

function add_teknisi(id)
{
    save_method = 'addteknisi';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('HDM/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="ND"]').val(data.ND);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Add Teknisi'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function add_sn_odp(id)
{
    save_method = 'addsnodp';
    $('#form2')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('HDM/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="ND"]').val(data.ND);
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Add SN ODP'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function ChangeFase(id)
{
    save_method = 'ChangeFase';
    $('#form5')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('HDM/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="ND"]').val(data.ND);
            $('#modal_form5').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Rubah Fase'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function ChangeKendala(id)
{
    save_method = 'ChangeKendala';
    $('#form6')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('HDM/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="ND"]').val(data.ND);
            $('#modal_form6').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Tambah Kendala'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });   
}

function add_keterangan(id)
{
    save_method = 'addketerangan';
    $('#form3')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('HDM/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="ND"]').val(data.ND);
            $('#modal_form3').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Add Keterangan'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function detail(nd)
{
    $('#form4')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('HDM/ajax_detail/')?>/" + nd,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //ND','NAMA','CAREA','RK','DP'
            $('[name="ND"]').val(data.ND);
            $('[name="NAMA"]').val(data.NAMA);
            $('[name="CAREA"]').val(data.CAREA);
            $('[name="RK"]').val(data.RK);
            $('[name="DP"]').val(data.DP);
            $('#modal_form4').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function cancel_order(nd)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('HDM/ajax_cancel_order')?>/"+nd,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                $('.alert-success').html('Cancel Order Sukses').fadeIn().delay(4000).fadeOut('slow');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'addteknisi') {
        url = "<?php echo site_url('HDM/ajax_add_teknisi')?>";
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
     
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    $('.alert-success').html('teknisi sukses ditambahkan').fadeIn().delay(4000).fadeOut('slow');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
            }
        });
    }
    else if(save_method == 'addsnodp')
    {
        url = "<?php echo site_url('HDM/ajax_add_sn_odp')?>";
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form2').serialize(),
            dataType: "JSON",
            success: function(data)
            {
     
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form2').modal('hide');
                    $('.alert-success').html('data sno dan odp berhasil ditambahkan').fadeIn().delay(4000).fadeOut('slow');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
            }
        });
    }
    else if(save_method == 'addketerangan')
    {
        url = "<?php echo site_url('HDM/ajax_add_keterangan')?>";
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form3').serialize(),
            dataType: "JSON",
            success: function(data)
            {
     
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form3').modal('hide');
                    $('.alert-success').html('keterangan sukses ditambahkan').fadeIn().delay(4000).fadeOut('slow');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
            }
        });
    }
    else if (save_method == 'ChangeFase')
    {
        url = "<?php echo site_url('HDM/ajax_change_fase')?>";
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form5').serialize(),
            dataType: "JSON",
            success: function(data)
            {
     
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form5').modal('hide');
                    $('.alert-success').html('fase sukses dirubah').fadeIn().delay(4000).fadeOut('slow');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
            }
        });
    }
    else if (save_method == 'ChangeKendala')
    {
        url = "<?php echo site_url('HDM/ajax_change_kendala')?>";
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form6').serialize(),
            dataType: "JSON",
            success: function(data)
            {
     
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form6').modal('hide');
                    $('.alert-success').html('kendala sukses dirubah').fadeIn().delay(4000).fadeOut('slow');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
     
            }
        });
    }
}
 
</script>
 
<!-- Bootstrap modal Tambah Teknisi -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">tambah teknisi</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">ND</label>
                            <div class="col-md-9">
                                <input name="ND" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">TEKNISI</label>
                            <div class="col-md-9">
                                <select name="idteknisi" class="form-control">
                                    <option value="">Pilih Teknisi</option>
                                    <?php 
                                        foreach($select_teknisi as $object => $value) {
                                            $object = htmlspecialchars($object); 
                                            echo '<option value="'. $object .'">'. $value .'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <input name="Keterangan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal add teknisi-->

<!-- Bootstrap modal add sn odp -->
<div class="modal fade" id="modal_form2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">ND</label>
                            <div class="col-md-9">
                                <input name="ND" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">SN</label>
                            <div class="col-md-9">
                                <input name="SN" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ODP</label>
                            <div class="col-md-9">
                                <input name="ODP" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <input name="Keterangan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal add sn odp-->

<!-- Bootstrap modal add Keterangan -->
<div class="modal fade" id="modal_form3" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Keterangan</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form3" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">ND</label>
                            <div class="col-md-9">
                                <input name="ND" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <input name="Keterangan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal add Keterangan-->

<!-- Bootstrap modal detail pelanggan --> 
<div class="modal fade" id="modal_form4" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">DETAIL PELANGGAN</h3>
            </div>
            <!-- ND','NAMA','CAREA','RK','DP' -->
            <div class="modal-body form">
                <form action="#" id="form4" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">ND</label>
                            <div class="col-md-9">
                                <textarea name="ND" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Pelanggan</label>
                            <div class="col-md-9">
                                <textarea name="NAMA" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">STO</label>
                            <div class="col-md-9">
                                <textarea name="CAREA" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">RK</label>
                            <div class="col-md-9">
                                <textarea name="RK" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">DP</label>
                            <div class="col-md-9">
                                <textarea name="DP" class="form-control" type="text"> </textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">BACK</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal add Keterangan-->

<!-- Bootstrap modal CHANGE FASE -->
<div class="modal fade" id="modal_form5" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Rubah Fase</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form5" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">ND</label>
                            <div class="col-md-9">
                                <input name="ND" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">FASE</label>
                            <div class="col-md-9">
                                <select name="Fase" class="form-control">
                                    <option value="">Pilih Fase</option>
                                    <?php 
                                        foreach($select_fase as $object => $value) {
                                            $object = htmlspecialchars($object); 
                                            echo '<option value="'. $object .'">'. $value .'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <input name="Keterangan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal CHANGE FASE-->

<!-- Bootstrap modal CHANGE Kendala -->
<div class="modal fade" id="modal_form6" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Masukan Kendala</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form6" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">ND</label>
                            <div class="col-md-9">
                                <input name="ND" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kendala</label>
                            <div class="col-md-9">
                                <select name="Kendala" class="form-control">
                                    <option value="">Pilih Kendala</option>
                                    <?php 
                                        foreach($select_status as $object => $value) {
                                            $object = htmlspecialchars($object); 
                                            echo '<option value="'. $object .'">'. $value .'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <input name="Keterangan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal tambah kendala-->
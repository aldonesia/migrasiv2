<div class="container">
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
                    <th>Fase</th>
                    <th>Eskalasi Kendala</th>
                    <th>Keterangan Tambahan</th>
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
            "url": "<?php echo site_url('Group/ajax_list')?>",
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

function detail(nd)
{
    $('#form4')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Group/ajax_detail/')?>/" + nd,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //ND','NAMA','CAREA','RK','DP'
            $('[name="tgl_data_masuk"]').val(data.TGL_DATA_MASUK);
            $('[name="fase"]').val(data.FASE_TRANSAKSI);
            $('[name="mitra"]').val(data.MITRA);
            $('[name="teknisi"]').val(data.ID_TEKNISI);
            $('[name="tgl_input_teknisi"]').val(data.TGL_INPUT_TEKNISI);
            $('[name="pelanggan"]').val(data.NAMA_PELANGGAN);
            $('[name="ND"]').val(data.ND);
            $('[name="internet"]').val(data.USER_INTERNET);
            $('[name="ODP"]').val(data.ODP);
            $('[name="STO"]').val(data.STO);
            $('[name="password"]').val(data.PASSWORD_VOICE);
            $('[name="SN"]').val(data.SN);
            $('[name="grup"]').val(data.HD_GRUP);
            $('[name="lapangan"]').val(data.KEDETECT_LAPANGAN);
            $('[name="maincore"]').val(data.MAINCORE);
            $('[name="status"]').val(data.STATUS);
            $('[name="onu"]').val(data.ONU_ID);
            $('[name="update"]').val(data.UPDATE_LAYANAN);
            $('[name="tgl_layanan_up"]').val(data.TGL_LAYANAN_UP);
            $('[name="logic"]').val(data.HD_LOGIC);
            $('[name="kendala"]').val(data.ESKALASI_KENDALA);
            $('[name="dp"]').val(data.STATUS_DP);
            $('[name="keterangan"]').val(data.KETERANGAN_TAMBAHAN);
            $('[name="layanan"]').val(data.LAYANAN);
            $('[name="SC"]').val(data.SC);
            $('[name="input"]').val(data.HD_INPUTER);
            $('[name="tgl_input"]').val(data.TGL_INPUT);
            $('[name="ps"]').val(data.HD_PS);
            $('[name="statusps"]').val(data.STATUS_PS);
            $('[name="tgl_ps"]').val(data.TGL_PS);
            $('[name="cp"]').val(data.CP);
            $('[name="prioritas"]').val(data.PRIORITAS);
            $('#modal_form4').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
</script>

<!-- Bootstrap modal detail pelanggan --> 
<div class="modal fade" id="modal_form4" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">DETAIL ND</h3>
            </div>
            <!-- ND','NAMA','CAREA','RK','DP' -->
            <div class="modal-body form">
                <form action="#" id="form4" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Data Masuk</label>
                            <div class="col-md-9">
                                <textarea name="tgl_data_masuk" class="form-control" type="text" disabled=""></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fase</label>
                            <div class="col-md-9">
                                <textarea name="fase" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Mitra</label>
                            <div class="col-md-9">
                                <textarea name="mitra" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Teknisi</label>
                            <div class="col-md-9">
                                <textarea name="teknisi" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Input Teknisi</label>
                            <div class="col-md-9">
                                <textarea name="tgl_input_teknisi" class="form-control" type="text"> </textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Pelanggan</label>
                            <div class="col-md-9">
                                <textarea name="pelanggan" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ND</label>
                            <div class="col-md-9">
                                <textarea name="ND" class="form-control" type="text" style="background-color:red" ></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ND REFERENCES</label>
                            <div class="col-md-9">
                                <textarea name="internet" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ODP</label>
                            <div class="col-md-9">
                                <textarea name="ODP" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">STO</label>
                            <div class="col-md-9">
                                <textarea name="STO" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <textarea name="password" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">SN</label>
                            <div class="col-md-9">
                                <textarea name="SN" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">HD GRUP</label>
                            <div class="col-md-9">
                                <textarea name="grup" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kedetect Lapangan</label>
                            <div class="col-md-9">
                                <textarea name="lapangan" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Maincore</label>
                            <div class="col-md-9">
                                <textarea name="maincore" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <textarea name="status" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ONU ID</label>
                            <div class="col-md-9">
                                <textarea name="onu" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Update Layanan Up</label>
                            <div class="col-md-9">
                                <textarea name="update" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Layanan Up</label>
                            <div class="col-md-9">
                                <textarea name="tgl_layanan_up" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">HD Logic</label>
                            <div class="col-md-9">
                                <textarea name="logic" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Eskalasi Kendala</label>
                            <div class="col-md-9">
                                <textarea name="kendala" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status DP</label>
                            <div class="col-md-9">
                                <textarea name="DP" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan Tambahan</label>
                            <div class="col-md-9">
                                <textarea name="keterangan" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Layanan</label>
                            <div class="col-md-9">
                                <textarea name="layanan" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">SC</label>
                            <div class="col-md-9">
                                <textarea name="SC" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">HD Input</label>
                            <div class="col-md-9">
                                <textarea name="input" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Input</label>
                            <div class="col-md-9">
                                <textarea name="tgl_input" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">HD PS</label>
                            <div class="col-md-9">
                                <textarea name="ps" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status PS</label>
                            <div class="col-md-9">
                                <textarea name="statusps" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal PS</label>
                            <div class="col-md-9">
                                <textarea name="tgl_ps" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">CP</label>
                            <div class="col-md-9">
                                <textarea name="cp" class="form-control" type="text"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Prioritas</label>
                            <div class="col-md-9">
                                <textarea name="prioritas" class="form-control" type="text"></textarea>
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
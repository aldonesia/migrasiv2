<?php if($temp == 'leftover') { ?>
    <div class="container">
    <h1 id="judul"></h1>
        <br />
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ND</th>
                    <th>Nama</th>
                    <th>STO</th>
                    <th>RK</th>
                    <th>DP</th>
                    <th>Data UIM</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<?php } 
else { ?>
    <div class="container">
    <h1 id="judul"></h1>
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
                    <th>Status</th>
                    <th>Tanggal Layanan Up</th>
                    <th>Update Layanan</th>
                    <th>Kendala</th>
                    <th>Status DP</th>
                    <th>Keterangan</th>
                    <th>Tanggal Input</th>
                    <th>Tanggal Ps</th>
                    <th>STATUS PS</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<?php } ?>
 
<script type="text/javascript">
 
var save_method; //for save method string
var table;
var temp = '<?php echo $temp; ?>';
$(document).ready(function() {
 
    if(temp == 'full') 
    {
        document.getElementById("judul").innerHTML = "Work Order Yang Dikirim";
        table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list_full')?>",
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
    }
    else if(temp == 'trouble') 
    {
        document.h1 = 'Work Order Yang Terkendala'
        table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list_trouble')?>",
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
    }
    else if(temp == 'complete') 
    {
        document.getElementById("judul").innerHTML = "Work Order Yang Telah selesai";
        table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list_complete')?>",
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
    }
    else if(temp == 'processing') 
    {
        document.getElementById("judul").innerHTML = "Work Order Yang Tengah Dikerjakan";
        table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list_processing')?>",
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
    }
    else if(temp == 'leftover') 
    {
        document.getElementById("judul").innerHTML = "Data Yang Belum Di Assign Ke Mitra";
        table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list_leftover')?>",
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
    }
 
 
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
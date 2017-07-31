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
                    <th>Mitra</th>
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

 
<script type="text/javascript">
 
var save_method; //for save method string
var table;
var temp = '<?php echo $temp; ?>';

$(document).ready(function() {
 
    if(temp != null) 
    {
        document.getElementById("judul").innerHTML = "Detail Fase";
        table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list_id_fase/')?>"+ temp,
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
});
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
</script>
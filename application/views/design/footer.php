   <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0 &nbsp;&nbsp;
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
        <strong>Copyright &copy; <a href=""><?php echo $this->apps->copyright ?></a>.</strong> All rights reserved.
    </footer>


    </div><!-- ./wrapper -->
    <script src="<?php echo base_url()."assets2/" ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>plugins/fastclick/fastclick.min.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>dist/js/app.min.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>dist/js/demo.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>js/zabuto_calendar.js"></script> 
    <script src="<?php echo base_url()."assets2/" ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()."assets2/" ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!--
    <script src="assets2/js/jquery.js"></script>
    <script class="include" type="text/javascript" src="assets2/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets2/js/jquery.scrollTo.min.js"></script>
    <script src="assets2/js/jquery.nicescroll.js" type="text/javascript"></script    <script src="assets2/js/jquery.sparkline.js"></script>
    -->
 xvx  
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
    <script>
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
    })
    </script>
    <script>
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    
    $(document).ready( function() {
        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
    });
    </script>
  </body>
</html>
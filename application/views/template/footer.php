<!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
   

        <script src="<?php echo base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="<?php echo base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="<?php echo base_url(); ?>assets/js/off-canvas.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/hoverable-collapse.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/lightgallery-all.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/light-gallery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/todolist.js"></script>

       
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
        <script>
            $('.select2').select2();
        </script>
        <!-- End custom js for this page -->

        <script type="text/javascript">
            $(document).ready( function () {
                $('#myTable').DataTable();

                $('#saleslist').DataTable({
                    "aaSorting": [[ 0, "desc" ]]
                });

                 $('#viewitem').DataTable({
                    "aaSorting": [[ 0, "desc" ]]
                });
            });

            $(document).ready(function() {
                $('#example').DataTable( {
                    serverSide: true,
                    ordering: true,
                    searching: true,
                    ajax: function ( data, callback, settings ) {
                        var out = [];
             
                        for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {
                            out.push( [ i+'-1', i+'-2', i+'-3', i+'-4', i+'-5' ] );
                        }
             
                        setTimeout( function () {
                            callback( {
                                draw: data.draw,
                                data: out,
                                recordsTotal: 5000000,
                                recordsFiltered: 5000000
                            } );
                        }, 50 );
                    },
                    scrollY: 400,
                    scroller: {
                        loadingIndicator: true
                    },
                } );
            } );
        </script>

        <script>
            $(document).ready(function () {
                $("#sidebar").hover(
                    function () {
                        $("body").removeClass("sidebar-icon-only");
                    },
                    function () {
                        $("body").addClass("sidebar-icon-only");
                    }
                );
            });
        </script>

        <script type="text/javascript">
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            function printDiv2(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            function return_damage_redirect(baseurl,return_id){
                window.open(baseurl+'returns/return_damage/'+return_id, '_blank');
            }

            function bs_adjustment_redirect(baseurl,billing_id){
                window.open(baseurl+'reports/adjustment_list/'+billing_id, '_blank');
            }
        </script>
        <!-- <script type="text/javascript">
            $('.extra-fields-customer').click(function() {

                $('.customer_records').clone().appendTo('.customer_records_dynamic');
                $('.customer_records_dynamic .customer_records').addClass('single remove');
                $('.single .extra-fields-customer').remove();
                $('.single').append('<a href="#" class="remove-field btn-remove-customer">Remove Fields</a>');
                $('.customer_records_dynamic > .single').attr("class", "remove");

                $('.customer_records_dynamic input').each(function() {
                    var count = 0;
                    var fieldname = $(this).attr("name");
                    $(this).attr('name', fieldname + count);
                    count++;
                  });

            });

            $(document).on('click', '.remove-field', function(e) {
              $(this).parent('.remove').remove();
              e.preventDefault();
            });
        </script> -->
     
    </body>
</html>
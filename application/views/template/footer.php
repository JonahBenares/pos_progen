<!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
        </div>
        <script src="<?php echo base_url(); ?>assets/js/billing.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/receive.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/sales.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="<?php echo base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="<?php echo base_url(); ?>assets/js/off-canvas.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/hoverable-collapse.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/todolist.js"></script>

       
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <!-- End custom js for this page -->

        <script type="text/javascript">
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );

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
        <script>
            function loadTransactions() {
                var x = document.getElementById("loadTransactions");
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            }
        </script>
    </body>
</html>
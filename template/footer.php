 <?php
   include '../snippet/waiting-dialog.php';
   include '../snippet/transaction-message.php';
?>
   <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Vocabulary and Reading Comprehension for Grade 11 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../snippet/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

   
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript
    <script src="../vendor/chart.js/Chart.min.js"></script>-->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>
   <!-- <script src="../js/demo/chart-area-demo.js"></script>-->

    <!-- date picker -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript" src="../js/dropzone.js"></script>
    <style type="text/css">
      
        .datepicker {
            font-size: 0.875em;
        }      
        .datepicker td, .datepicker th {
            width: 1.5em;
            height: 1.5em;
        }
        
    </style>
    <script type="text/javascript">
        $('#datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date());
    </script>

    <script type="text/javascript">
      // var sessionErr = '<?php echo $_SESSION['ERR']; ?>';
    //  var sessionErrrefresh = '<?php $_SESSION['ERR']=''; ?>';
      
      /*

      if(sessionErr == ''){
       
          processingSuccess();      
       
          
       }else{
         processingError();
      
       }
*/

//alert(countSession);
      function processingSuccess(){

        $('.modal').modal('hide');
        $('#pleasewait').modal('show');  
         setTimeout(function() {
           $('.progress-bar').css('width', '98%');
        }, 1000); 
        setTimeout(function() {
           $('#pleasewait').modal('hide');
        }, 2000);
        setTimeout(function() {
           $('#messageSuccess').modal('show');
        }, 3000);
        setTimeout(function() {
           $('#messageSuccess').modal('hide');
        }, 4500);
         var incrementCount = '<?php echo $_SESSION["countPopUp"] = 'not empty '; ?>';
      }
       function processingError(){

        $('.modal').modal('hide');
        $('#pleasewait').modal('show');  
         setTimeout(function() {
           $('.progress-bar').css('width', '98%');
        }, 1000); 
        setTimeout(function() {
           $('#pleasewait').modal('hide');
        }, 2000);
        setTimeout(function() {
           $('#messageError').modal('show');
        }, 3000);       
         var incrementCount = '<?php echo $_SESSION["countPopUp"] = 1; ?>';
      }

      //upload image js
      $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {
            
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
          
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });   
      });

      $(document).ready(function() {
      
         $('#datetimepicker').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
        });
        
          // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    
    });
    </script>

  </body>

</html>

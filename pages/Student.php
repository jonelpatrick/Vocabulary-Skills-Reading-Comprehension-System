<?php
	include '../template/header.php';
?>

  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">Student</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>         

       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of student</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Approve</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Approve</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    $sql = "SELECT 
                            student.id id,
                            firstname,
                            middlename,
                            lastname,
                            email_address,
                            physical_address,
                            active,
                            approved 
                            FROM student 
                            INNER JOIN account
                            ON student.account_id = account.id
                            WHERE student.deleted = 0";

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                          $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                          $status = $row['active'];
                          $id = $row["id"];
                          $approved = $row['approved'];
                          $email = $row['email_address'];
                          $address = $row['physical_address'];

                          echo '<tr>'; 
                          echo '<td>'.$name.'</td>';
                          echo '<td>'.$email.'</td>';
                           echo '<td>'.$address.'</td>';
                          if($status == 1){
                            $status = 'active';
                            echo '<td style="width:35px;"><span class="status-ac">'.$status.'</span></td>';
                          }else{
                            $status = 'inactive';
                             echo '<td style="width:35px;"><span class="status-in">'.$status.'</span></td>';
                          }
                          if($approved == 0){                            
                            echo '<td style="width:15px;text-align:center;"><input type="checkbox" disabled></td>';
                          }else{
                            echo '<td style="width:15px;text-align:center;"><input type="checkbox" checked disabled></td>';
                          }
                        
                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditStudent('.$id.');" > <i class="fas fa-eye"></i>'.''.'</button></td>';
                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteStudent('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                          echo '</tr>';
                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Student Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <div class="student-body">
        <div class="modal-body">
    
        
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button  type="submit" class="btn btn-primary">Save changes</button>           
        </div>

      </form>   
    </div>
    </div>
  </div>
</div>

<?php 
  include '../snippet/transaction-message.php';
?>
<style type="text/css">
  input[type=checkbox]{
      width: 30px;
      height: 30px;
  }
</style>
<script type="text/javascript">

  function showEditStudent(id){    
      var id = id;            
      $('.modal-body').load('../snippet/student-modal.php?id=' + id,function(){           
          $('#studentModal').modal({show:true}); 
         
      });                    
  }
  function showDeleteStudent(id){    
      var id = id;            
      var table = "student";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>
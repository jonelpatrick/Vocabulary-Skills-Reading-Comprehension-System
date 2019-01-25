<?php
	include '../template/header.php';
?>

  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="client-list.php">School Coordinator</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>   

       <div class="btn-container">  
        <button class="btn btn-primary" data-toggle="modal" data-target="#coordinatorModal">Add New</button>
       
      </div>
       <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Coordinator</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Address</th>
                      <th>Status</th>                      
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
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    $sql = "SELECT 
                            school_coordinator.id id,
                            firstname,
                            middlename,
                            lastname,
                            email_address,
                            physical_address,
                            active                            
                            FROM school_coordinator 
                            INNER JOIN co_account
                            ON school_coordinator.co_account_id = co_account.id
                            WHERE school_coordinator.deleted = 0";

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {

                          $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                          $status = $row['active'];
                          $id = $row["id"];                          
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
                        
                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="showEditCoordinator('.$id.');" > <i class="fas fa-edit"></i>'.''.'</button></td>';
                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteCoordinator('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';
                          echo '</tr>';
                         }
                      }
                  ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div>
          
          </div>

    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="coordinatorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">School coordinator Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <div class="coordinator-body">
        <div class="modal-body">
    		<input type="hidden" value="addCoordinatorAccount" name="action">			
			  
			     <div class="form-group">          
			      <input type="text" class="form-control"  name="firstname" placeholder="Firstname" >
			    </div>
			     <div class="form-group">          
			      <input type="text" class="form-control"  name="middlename"  placeholder="middlename">
			    </div>
			     <div class="form-group">        
			      <input type="text" class="form-control"  name="lastname"  placeholder="lastname">
			    </div>
			     <div class="form-group">          
			      <input type="text" class="form-control"  data-date-format="yyyy-mm-dd" id="datepicker"  name="birthday"  placeholder="birthday">
			    </div>
			   <div class="form-group inline-layout">
				    <label class="radio-inline">Sex: </label>
				    <label class="radio-inline">
				      <input type="radio" name="formRadioSex" value="0" checked>Male
				    </label>
				    <label class="radio-inline">
				      <input type="radio" name="formRadioSex" value="1">Female
				    </label>
				</div>
			    <div class="form-group">          
			      <input type="text" class="form-control"  name="phone" placeholder="Phone">
			    </div>
			    <div class="form-group">          
			      <textarea name="address" class="form-control" placeholder="Address"></textarea>
			    </div>
			   
			       <div class="form-group">          
			        <input type="email" class="form-control" name="email" placeholder="Email" >          
			      </div>       
			      <div class="form-group">          
			        <input type="text" class="form-control"  name="password" placeholder="Password">
			      </div>
			 
			 <div class="jumbotron mybox">
			     <div class="form-group inline-layout">
			        <label class="radio-inline">Status: </label>
			        <label class="radio-inline">
			          <input type="radio" name="status" value="1" checked="">Active
			        </label>
			        <label class="radio-inline">
			          <input type="radio" name="status" value="0" >Inactive
			        </label>
			    </div>   
			    <hr>

			</div>
                 
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
  <!-- modal -->
<div class="modal fade firstmodal" id="editcoordinatorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">School coordinator Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" id="myform" >
      <div class="coordinator-body">
        <div class="modal-body edit-body">
    		
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

  function showEditCoordinator(id){    
      var id = id;            
      $('.edit-body').load('../snippet/coordinator-modal.php?id=' + id,function(){           
          $('#editcoordinatorModal').modal({show:true}); 
         
      });                    
  }
  function showDeleteCoordinator(id){    
      var id = id;            
      var table = "school_coordinator";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }

 
</script>
<?php
	include '../template/footer.php';
?>
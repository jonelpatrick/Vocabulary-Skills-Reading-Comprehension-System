<?php
  include '../template/header.php';
?>
<style type="text/css">
  .small{
        border: 1px solid rgba(0,0,0,0.2);
    padding: 6px 25px;
    border-radius: 4px;
    margin-left: 1em;
  }
  table tr td,table th{
    text-align: center;
  }
</style>
  <div id="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="assign-class.php">Assign Class</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>         

        <div class="row">
          <div class="col-lg-7">
            <div class="card mb-3" >
              <div class="card-header">
                <i class="fas fa-info-circle"></i>
                Class - section & subject
              </div>
          <form method="POST" action="../cli/functions.php" > 
          <input type="hidden" name="action" value="createClass">   
            <div style="margin-left: 1em;">
              <div class="form-group inline-layout" style="margin-top: 1em;">  
                <label class="radio-inline attach-property-label">Select Teacher: </label> 
                <select class="custom-select radio-inline" name="teacher" style="display: inline;width:80%;">
                    <?php
                      $sql = "SELECT id,firstname,middlename,lastname FROM teacher WHERE deleted = 0 AND active = 1";
                       $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) { 
                           while($row = mysqli_fetch_assoc($result)) {
                            $name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                            $id  = $row['id'];
                            echo '<option value="'.$id.'">'.$name.'</option>';
                           }
                        }
                    ?>                    
                </select>
              </div>
            </div>
             <div style="margin-left: 1em;">
              <div class="form-group inline-layout">  
                <label class="radio-inline attach-property-label" style="background: #a465d2;color:#fff;">Select Section: </label> 
                <select class="custom-select radio-inline" name="section" style="display: inline;width:80%;">
                    <?php
                      $sql = "SELECT id,name,comment FROM section WHERE deleted = 0 ";
                       $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) { 
                           while($row = mysqli_fetch_assoc($result)) {
                            $name = $row['name'];
                            $id  = $row['id'];
                            $comment = $row['comment'];
                            echo '<option value="'.$id.'">'.$name.' - '.$comment.'</option>';
                           }
                        }
                    ?>                    
                </select>
              </div>
            </div>
            <div style="margin-left: 1em;">
              <div class="form-group inline-layout">  
                <label class="radio-inline " >Subject: <span class="small" id="subjectname"><i  style="color:red;"> *Please select on the subject list*</i></span> </label>   
                <input type="hidden" name="subject" id="subjectId">           
              </div>
            </div>
            <div style="margin-left: 1em;">
              <div class="form-group inline-layout"> 
                <label class="radio-inline " >Time [24H Format]:<br> hh:mm:s </label>
                <label class="small" style="width: 22%;">
                  From: <input type="text" name="time_from" placeholder="ex. 16:00:00" class="form-control">
                </label> 
                <label class="small" style="width: 22%;">
                  To: <input type="text" name="time_to" placeholder="ex. 08:00:00"  class="form-control">
                </label>  
                <br>
                <label class="radio-inline " >Day </label> 
                <label class="small">
                  <input type="checkbox" name="day" value="Everyday" checked> Everyday            
                </label>
              </div>
            </div>

            <div class="form-group" style="margin-left: 1em;">
              <input type="submit" name="submit" value="Create Class" class="btn btn-primary">
            </div>
          </form>
            <hr>
            <!-- table -->
          <div class="table-responsive" style="padding: 0 15px;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>                
                  <th>Teacher</th>
                  <th>Section</th>                      
                  <th>Subject</th>                                       
                  <th>Status</th>
                  <th></th>                                
                  <th></th>                                
              </thead>
              <tbody>
                 <?php
         
                    $sql = " SELECT 
                             class.id id,
                             section.name section,
                             subject.name subj,
                             teacher.firstname fname,
                             teacher.middlename mname,
                             teacher.lastname lname,
                             class.status statu 
                             FROM class 
                             INNER JOIN section 
                             ON class.section_id = section.id 
                             INNER JOIN subject 
                             ON class.subject_id = subject.id 
                             INNER JOIN teacher 
                             ON class.teacher_id = teacher.id 
                             WHERE class.deleted = 0";                   

                     $result = mysqli_query($mysqli,$sql);
                      if (mysqli_num_rows($result) > 0) { 
                         while($row = mysqli_fetch_assoc($result)) {
                          $name = $row['fname'].' '.$row['mname'].' '.$row['lname'];
                          $section = $row['section'];
                          $subject = $row['subj'];
                          $id = $row["id"]; 
                          $status = $row['statu'];                         

                          echo '<tr>'; 
                          echo '<td id="tblName'.$id.'">'.$name.'</td>';
                          echo '<td>'.$section.'</td>';                           
                          echo '<td>'.$subject.'</td>';  
                          if($status == 1){
                            $status = 'active';
                            echo '<td style="width:35px;"><span class="status-ac">'.$status.'</span></td>';
                          }else{
                            $status = 'inactive';
                             echo '<td style="width:35px;"><span class="status-in">'.$status.'</span></td>';
                          }                         
                                                   
                                                
                          echo '<td style="width:15px;"><button class="toolbar-edit" onclick="selectClass('.$id.');" > <i class="fas fa-edit"></i>'.''.'</button></td>';  
                          echo '<td style="width:15px;"><button class="toolbar-delete" onclick="showDeleteClass('.$id.');" ><i class="fa fa-trash" aria-hidden="true"></i>'.''.'</button</td>';                         
                          echo '</tr>';
                         }
                      }
                  ?>
                
              </tbody>
            </table>
          </div>
            <!-- end table -->
          </div><!-- mb card--> 
          </div><!--col-lg-6 -->
          <div class="col-lg-5">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Select subject</div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Description</th>                      
                        <th></th>
                                          
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Description</th>                      
                        <th></th>
                        
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      $sql = "SELECT 
                              id,
                              name,
                              description                            
                              FROM subject
                              WHERE deleted = 0";

                       $result = mysqli_query($mysqli,$sql);
                        if (mysqli_num_rows($result) > 0) { 
                           while($row = mysqli_fetch_assoc($result)) {
                            $nameTbl = $row['name'];
                            $descriptionTbl = $row['description'];
                            $idTbl = $row["id"];                          

                            echo '<tr>'; 
                            echo '<td id="tblNameSubj'.$idTbl.'">'.$nameTbl.'</td>';
                            echo '<td>'.$descriptionTbl.'</td>';                           
                                                  
                            echo '<td style="width:15px;"><button class="toolbar-edit" onclick="selectSubject('.$idTbl.');" > <i class="fas fa-mouse-pointer"></i>'.''.'</button></td>';                           
                            echo '</tr>';
                           }
                        }
                    ?>
                                        
                  </tbody>
                </table>
              </div>
            </div>            
          </div><!-- mb card-->
        </div><!--col-lg-6 -->
    </div><!-- row -->
    </div>
</div>

<!-- modal -->
<div class="modal fade firstmodal" id="classModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 46%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Class Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" action="../cli/functions.php" >      
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

<script type="text/javascript">

  function selectSubject(id){
    var idl = id;
    var namel = $('#tblNameSubj'+idl).text();

    $('#subjectId').val(idl);
    $('#subjectname').text(namel);
  }

  function selectClass(id){    
      var id = id;            
      $('.modal-body').load('../snippet/assign-class-modal.php?id=' + id,function(){           
          $('#classModal').modal({show:true}); 
         
      });                    
  }

  function showDeleteClass(id){    
      var id = id;            
      var table = "class";
      $('#tableId').val(id);
      $('#dbtable').val(table);
      $('#confirmationDelete').modal({show:true}); 
     
  }
</script>
<?php 
  include '../snippet/transaction-message.php';
?>

<?php
  include '../template/footer.php';
?>
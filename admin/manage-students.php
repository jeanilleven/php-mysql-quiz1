<?php
  include '../all/connect_to_db.php';
  include 'form-handler.php';

  if(isset($_GET['remove-student-btn'])){
    removeStudent($_GET['id'], $conn);
  }

  if(isset($_GET['add-student-btn'])){
    addStudent($_GET['fname'], $_GET['lname'], $_GET['gender'], $_GET['course'], $_GET['year'], $conn);
  }
  
?>
  
  <?php include 'pageheader.php'; ?>
    <div class="container" style="margin-top: 20px;">
      <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>STUDENTS</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;"type="button" class="btn btn-success" data-toggle="modal" data-target="#add-student-modal">
                    Add Student
                </button>
                  
                  <!-- ADD STUDENT MODAL -->
                  <div class="modal fade" id="add-student-modal" tabindex="-1" role="dialog" aria-labelledby="add-student-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="add-student-modal">Add Student</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <form action="manage-students.php" method="get">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="fname"><i class='fas fa-user-alt'></i></span>
                            </div>
                            <input required name="fname" type="text" class="form-control" placeholder="First Name" aria-label="fname" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lname"><i class='fas fa-user-alt'></i></span>
                            </div>
                            <input required name="lname" type="text" class="form-control" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3" >
                            <div class="input-group-prepend" >
                              <span class="input-group-text" id="gender"><i class='	fa fa-venus-mars'></i></span>
                            </div>
                            <div class="form-check form-check-inline" style="margin-right: 4px;">
                              <input required name="gender"class="form-check-input" type="radio"  value="Male">
                              <label class="form-check-label" for="inlineCheckbox1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input required  name="gender" class="form-check-input" type="radio" value="Female">
                              <label class="form-check-label" for="inlineCheckbox2">Female</label>
                            </div>
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="start_term"><i class='fas fa-graduation-cap'></i></span>
                            </div>
                            <select required  name="course" class="form-control">
                              <option value="">Programme</option>
                              <option value="Computer Science">Computer Science</option>
                              <option value="Information Science">Information Science</option>
                              <option value="Information Technology">Information Technology</option>
                              <option value="Mathematics">Mathematics</option>
                            </select>
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="start_term"><i class='far fa-calendar-times'></i></span>
                            </div>
                            <select required name="year" class="form-control">
                              <option value="">Year Level</option>
                              <option value="1">First Year</option>
                              <option value="2">Second Year</option>
                              <option value="3">Third Year</option>
                              <option value="4">Fourth Year</option>
                              <option value="5">Fifth Year</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="add-student-btn" value="1" class="btn btn-success">Add</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
            </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="table-card">
            <div class="card-body">
              <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Program</th>
                    <th scope="col">Year</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $students = mysqli_query($conn, "select * from students order by last_name asc");
                    foreach($students as $s){
                        if($s['deleted_at']==null || $s['deleted_at']=='0000-00-00'){
                          echo "
                            <tr id='S".$s['id']."'>
                              <th scope='col' style=' text-align: left;'>".$s['id']."</th>
                              <td style=' text-align: left;'>".$s['first_name']." ".$s['last_name']."</td>
                              <td style=' text-align: left;'>".$s['course']."</td>
                              <td style=' text-align: left;'>".$s['year']."</td>
                              <td style='text-align: left;'></td>
                              <td style=' text-align: right;'>
                                <button onclick='getID(this.id)' id='S".$s['id']."' type='button' value='".$s['id']."' class='btn btn-danger' data-toggle='modal' data-target='#delete-student-modal'>
                                  <i class='far fa-trash-alt'></i>
                                </button></td>
                              </td>
                            </tr>
                          ";
                        } 
                      };
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="delete-student-modal" tabindex="-1" role="dialog" aria-labelledby="delete-student-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this student?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <form action="manage-students.php" method="get">
                <input type="hidden" class="id" name="id" value="">
                <button type="submit" name="remove-student-btn" value="1"class="btn btn-danger">Remove</button>
              </form>
            </div>
          </div>
        </div>
      </div>  
  </body> 
</html>
<script>
  function getID(i){
    var value = $('#'+i+" td:nth-child(6) button").attr('value');
    $('.id').val(value);
    // $('.name').val($('#'+i+" td:nth-child(1)").html());
    // $('.capacity').val($('#'+i+" td:nth-child(2)").html());
  }
</script>
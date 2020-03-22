<?php
  include '../connect_to_db.php';
  include 'form-handler.php';


  if(isset($_GET['add-faculty-btn'])){
    addFaculty($_GET['fname'], $_GET['lname'], $_GET['email'], $_GET['gender'], $_GET['term'], $_GET['year'], $conn);
  }
?>
      <?php include 'pageheader.php';?>

      <div class="container" style="margin-top: 20px;">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>FACULTY</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;"type="button" class="btn btn-success" data-toggle="modal" data-target="#add-faculty-modal">
                    Add Faculty
                </button>
                  
                  <!-- Add Faculty Modal -->
                  <div class="modal fade" id="add-faculty-modal" tabindex="-1" role="dialog" aria-labelledby="add-faculty-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="add-faculty-modal">Add Faculty</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <form action="manage-faculty.php" method="get">
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
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="email"><i class='far fa-envelope'></i></span>
                            </div>
                            <input required name="email" type="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3" >
                            <div class="input-group-prepend" >
                              <span class="input-group-text" id="gender"><i class='	fa fa-venus-mars'></i></span>
                            </div>
                            <div class="form-check form-check-inline" style="margin-right: 4px;">
                              <input name="gender"class="form-check-input" type="radio"  value="Male">
                              <label class="form-check-label" for="inlineCheckbox1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input required name="gender" class="form-check-input" type="radio" value="Female">
                              <label class="form-check-label" for="inlineCheckbox2">Female</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="start_term"><i class='far fa-calendar-alt'></i></span>
                            </div>
                            <select required name="year" class="form-control">
                              <option >Start Year</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                            </select>
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="start_term"><i class='far fa-clock'></i></span>
                            </div>
                            <select required name="term" class="form-control">
                              <option >Start Term</option>
                              <option value="First Semester">First Semester</option>
                              <option value="Second Semester">Second Semester</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="add-faculty-btn" value="1" class="btn btn-success">Add</button>
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
                        <th scope="col">Start Year</th>
                        <th scope="col">Start Term</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $faculty = mysqli_query($conn, "select * from faculty ");
                        foreach($faculty as $f){
                          if($f['deleted_at']==null || $f['deleted_at']=='0000-00-00'){
                            echo "
                              <tr id='F".$f['id']."'>
                                <td style=' text-align: left;'>".$f['id']."</td>
                                <td style=' text-align: left;'>".$f['first_name']." ".$f['last_name']."</td>
                                <td style=' text-align: left;'>".$f['start_year']."</td>
                                <td style=' text-align: left;'>".$f['start_term']."</td>
                                <td style='text-align: left;'></td>
                                <td style=' text-align: right;'>
                                  <button type='button' value='".$f['id']."' class='btn btn-danger' data-toggle='modal' data-target='#delete-faculty-modal'>
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

          <div class="modal fade" id="delete-faculty-modal" tabindex="-1" role="dialog" aria-labelledby="delete-faculty-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this Faculty staff?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="manage-faculty.php" method="get">
                      <input type="hidden" class="id" name="id" value="">
                      <button type="submit" name="remove-faculty-btn" value="1"class="btn btn-danger">Remove</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>          
          </div>
        </div>
  </body>
</html>

<script>
  function getID(i){
    var value = $('#'+i+" td:nth-child(3) button").attr('value');
    $('.id').val(value);
    // $('.name').val($('#'+i+" td:nth-child(1)").html());
    // $('.capacity').val($('#'+i+" td:nth-child(2)").html());
  }
</script>
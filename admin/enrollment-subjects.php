<?php
  include '../all/connect_to_db.php';
  include 'form-handler.php';

  if(isset($_GET['add-subject-btn'])){
    addSubject($_GET['name'], $_GET['code'], $conn);
  }

  if(isset($_GET['remove-subject-btn'])){
    removeSubject($_GET['id'], $conn);
  }

  if(isset($_GET['edit-room-btn'])){
    editSubject($_GET['id'],$_GET['name'], $_GET['code'], $conn);
  }
?>
      <?php include '../all/pageheader.php'; ?>
      <div class="container" style="margin-top: 20px;">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>SUBJECTS</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;"type="button" class="btn btn-success" data-toggle="modal" data-target="#add-subject-modal">
                    Add Subject
                </button>
                  <!--ADD SUBJECT MODAL -->
                  <div class="modal fade" id="add-subject-modal" tabindex="-1" role="dialog" aria-labelledby=add-subject-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="">Add Subject</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <form action="enrollment-subjects.php" method="get">
                          <!-- <input type="hidden" class="id" name="id" value=""> -->
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id=""><i class='fas fa-chalkboard-teacher'></i></span>
                            </div>
                            <input required name="name" type="text" class="form-control" placeholder="Subject Name" aria-label="name" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="capacity"><i class='far fa-keyboard'></i></span>
                            </div>
                            <input required name="code" type="text" class="form-control" placeholder="Code" aria-label="capacity" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="add-subject-btn" value="1"class="btn btn-success">Add</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="table-card">
                <div class="card-body"  style='height: 440px; overflow-y:auto;'>
                  <table class="table " style="width: 70%; margin: auto;">
                    <thead class="thead-light">
                      <tr>
                        <th style=' text-align: center;' scope="col">Code</th>
                        <th style=' text-align: center;'scope="col">Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $subjs = mysqli_query($conn, "select * from subjects where deleted_at is null  order by code asc");
                        while($s = mysqli_fetch_assoc($subjs)){
                            echo "
                            <tr id='S".$s['id']."'>
                              <td style=' text-align: left;'>".$s['code']."</td>
                              <td style=' text-align: left;'>".$s['name']."</td>
                              <td style=' text-align: right;'><button onclick='getID(this.id)' value='".$s['id']."' id='S".$s['id']."' style=' margin-right:5px;' type='button' class='btn btn-warning' data-toggle='modal' data-target='#edit-subject-modal'>
                                  <i class='fas fa-pencil-alt'></i></button>
                                  <button onclick='getID(this.id)' id='S".$s['id']."' type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete-subject-modal'>
                                  <i class='far fa-trash-alt'></i></button>
                              </td>
                            </tr>
                          ";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- DELETE SUBJECT MODAL -->
          <div class="modal fade" id="delete-subject-modal" tabindex="-1" role="dialog" aria-labelledby="delete-subject-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this subject?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="enrollment-subjects.php" method="get">
                      <input type="hidden" class="id" name="id" value="">
                      <button type="submit" name="remove-subject-btn" value="1"class="btn btn-danger">Remove</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>          
          </div>   
      <!-- EDIT SUBJECT MODAL -->
      <div class="modal fade" id="edit-subject-modal" tabindex="-1" role="dialog" aria-labelledby="edit-subject-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Subject</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="get">
                  <input type="hidden" class="id" name="id" value="">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" ><i class='fas fa-chalkboard-teacher'></i></span>
                    </div>
                    <input name="name"  required type="text" class="form-control name" placeholder="Room Name" aria-label="name" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" ><i class='far fa-keyboard'></i></span>
                    </div>
                    <input name="code" required  type="text" class="form-control code " placeholder="Code" aria-label="capacity" aria-describedby="basic-addon1">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="edit-room-btn" value="1" class="btn btn-success">Save Changes</button>
                </div>
                </form>
              </div>
            </div>
          </div>
  </body>
     
</html>

<script>
  function getID(i){
    var value = $('#'+i+" td:nth-child(3) button").attr('value');
    $('.id').val(value);
    $('.name').val($('#'+i+" td:nth-child(2)").html());
    $('.code').val($('#'+i+" td:nth-child(1)").html());
  }
  

</script>
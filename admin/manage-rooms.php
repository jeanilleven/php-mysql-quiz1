<?php
  include '../all/connect_to_db.php';
  include 'form-handler.php';

  if(isset($_GET['add-room-btn'])){
    insertRoom( $_GET['name'], $_GET['capacity'], $conn);
  }

  if(isset($_GET['remove-room-btn'])){
    deleteRoom($_GET['id'], $conn);
  }

  if(isset($_GET['edit-room-btn'])){
    editRoom($_GET['id'], $_GET['name'], $_GET['capacity'], $conn);
  }

?>


      <?php 
        include '../all/pageheader.php';
      ?>
      <div class="container" style="margin-top: 20px; padding-bottom: 20px;">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>ROOMS</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;"type="button" class="btn btn-success" data-toggle="modal" data-target="#add-room-modal">
                    Add Room
                </button>
                  
                  <!-- Add Room Modal -->
                  <div class="modal fade" id="add-room-modal" tabindex="-1" role="dialog" aria-labelledby="add-room-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="add-room-modal">Add Room</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <form action="manage-rooms.php" method="get">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="name"><i class='fas fa-door-open'></i></span>
                            </div>
                            <input name="name" required type="text" class="form-control" placeholder="Room Name" aria-label="name" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="capacity"><i class='fas fa-users'></i></span>
                            </div>
                            <input name="capacity" required min="0" type="number" class="form-control" placeholder="Capacity" aria-label="capacity" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="add-room-btn" value="1" class="btn btn-success">Add</button>
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
                <div class="card-body">
                  <table class="table " style="width: 70%; margin: auto;">
                    <thead class="thead-light">
                      <tr>
                        <th style=' text-align: center;' scope="col">Name</th>
                        <th style=' text-align: center;'scope="col">Capacity</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $rooms = mysqli_query($conn, "select * from rooms order by name asc");
                        foreach($rooms as $r){
                          if($r['deleted_at']==null){
                            echo "
                            <tr id='R".$r['id']."'>
                              <td style=' text-align: center;'>".$r['name']."</td>
                              <td style=' text-align: center;'>".$r['capacity']."</td>
                              <td style=' text-align: right;'><button onclick='getID(this.id)' value='".$r['id']."' id='R".$r['id']."' style=' margin-right:5px;' type='button' class='btn btn-warning' data-toggle='modal' data-target='#edit-room-modal'>
                                  <i class='fas fa-pencil-alt'></i></button>
                                  <button onclick='getID(this.id)' id='R".$r['id']."' type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete-room-modal'>
                                  <i class='far fa-trash-alt'></i></button>
                              </td>
                            </tr>
                          ";
                          } 
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- DELETE ROOM MODAL -->
          <div class="modal fade" id="delete-room-modal" tabindex="-1" role="dialog" aria-labelledby="delete-room-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this room?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="manage-rooms.php" method="get">
                      <input type="hidden" class="id" name="id" value="">
                      <button type="submit" name="remove-room-btn" value="1"class="btn btn-danger">Remove</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>          
          </div>

          <!-- EDIT ROOM MODAL -->
          <div class="modal fade" id="edit-room-modal" tabindex="-1" role="dialog" aria-labelledby="edit-room-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="add-room-modal">Edit Room</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="get">
                  <input type="hidden" class="id" name="id" value="">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" ><i class='fas fa-door-open'></i></span>
                    </div>
                    <input name="name"  required type="text" class="form-control name" placeholder="Room Name" aria-label="name" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" ><i class='fas fa-users'></i></span>
                    </div>
                    <input name="capacity" required min="0" type="number" class="form-control capacity" placeholder="Capacity" aria-label="capacity" aria-describedby="basic-addon1">
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
      </div>
  </body>
</html>
<script>
  function getID(i){
    var value = $('#'+i+" td:nth-child(3) button").attr('value');
    $('.id').val(value);
    $('.name').val($('#'+i+" td:nth-child(1)").html());
    $('.capacity').val($('#'+i+" td:nth-child(2)").html());
  }
  

</script>
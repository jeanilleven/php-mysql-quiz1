<?php
  include '../all/connect_to_db.php';
  include 'form-handler.php';
  include '../all/translators.php';

  if(isset($_GET['add-SO-btn'])){
    addSubjOffering($_GET['faculty'],$_GET['subject'], $_GET['room'], $conn);
  }
?>


    <?php include 'pageheader.php'; ?>
    
      <div class="container" style="margin-top: 20px;">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>SUBJECT OFFERINGS</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#add-subject-offering-modal">
                    Add Subject Offering
                </button>
                  <!-- Add Subject Offering Modal -->
                  <div class="modal fade" id="add-subject-offering-modal" tabindex="-1" role="dialog" aria-labelledby="#add-subject-offering-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="#add-subject-offering-modal">Add Subject Offering</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <form action="enrollment-subject-offerings.php" method="get">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class='far fa-keyboard'></i></span>
                            </div>
                            <select required  name="subject" class="form-control">
                              <option value="">Course</option>
                              <?php
                                $subjects = mysqli_query($conn, "select * from subjects order by code asc");
                                foreach($subjects as $s){
                                  if($s['deleted_at']==null||$s['deleted_at']=="0000-00-00"){
                                    echo "
                                      <option value='".$s['id']."'>".$s['code']." ".$s['name']."</option>
                                    ";
                                  }
                                }
                              ?>  
                            </select>
                          </div>

                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" ><i class='fas fa-door-open'></i></span>
                            </div>
                            <select required  name="room" class="form-control">
                              <option value="">Room</option>
                              <?php
                                $rooms = mysqli_query($conn, "select * from rooms order by name asc");
                                foreach($rooms as $r){
                                  if($r['deleted_at']==null||$r['deleted_at']=="0000-00-00"){
                                    echo "
                                      <option value='".$r['id']."'>".$r['name']."</option>
                                    ";
                                  }
                                }
                              ?>  
                            </select>
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" ><i class='	fas fa-chalkboard-teacher'></i></span>
                            </div>
                            <select required  name="faculty" class="form-control">
                              <option value="">Faculty</option>
                              <?php
                                $faculty = mysqli_query($conn, "select * from faculty order by last_name asc");
                                foreach($faculty as $f){
                                  if($f['deleted_at']==null||$f['deleted_at']=="0000-00-00"){
                                    echo "
                                      <option value='".$f['id']."'>".$f['first_name']." ".$f['last_name']."</option>
                                    ";
                                  }
                                }
                              ?>  
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="add-SO-btn" value="1" class="btn btn-success">Add</button>
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
                  <table class="table " style="width: 100%; margin: auto;">
                    <thead class="thead-light">
                      <tr>
                        <th style=' text-align: left;' scope="col">Course</th>
                        <th style=' text-align: center;'scope="col">Room</th>
                        <th style=' text-align: center;'scope="col">Schedule</th>
                        <th style=' text-align: left;'scope="col">Instructor</th>
                        <th style=' text-align: center;'scope="col">Enrolled</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $offerings = mysqli_query($conn, "select * from offered_subjects order by subject_id asc");
                        foreach($offerings as $o){
                          if($o['deleted_at']==null){
                            $c = mysqli_query($conn, "select*from subjects where id = ".$o['subject_id']);
                            $c = mysqli_fetch_assoc($c);
                            $r = mysqli_query($conn, "select * from rooms where id =".$o['room_id']);
                            $r = mysqli_fetch_assoc($r);
                            $s = mysqli_query($conn, "select*from enrolled_students where offering_id=".$o['id']);
                            $s = mysqli_num_rows($s);
                            $i = mysqli_query($conn, "select*from faculty where id=".$o['faculty_id']);
                            $i = mysqli_fetch_assoc($i);
                            echo "
                            <tr id='O".$o['id']."'>
                              <td style=' text-align: left;'>".$c['code']." ".$c['name']."</td>
                              <td style=' text-align: center;'>".$r['name']."</td>
                              <td></td>
                              <td style=' text-align: left;'>".$i['first_name']." ".$i['last_name']."</td>
                              <td style=' text-align: center;'>".$s."/".$r['capacity']."</td>
                              <td style=' text-align: right;'><button onclick='getID(this.id)' value='".$o['id']."' id='O".$o['id']."' style=' margin-right:5px;' type='button' class='btn btn-warning' data-toggle='modal' data-target='#edit-room-modal'>
                                  <i class='fas fa-pencil-alt'></i></button>
                                  <button onclick='getID(this.id)' id='O".$o['id']."' type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete-room-modal'>
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
      </div>
  </body>
</html>

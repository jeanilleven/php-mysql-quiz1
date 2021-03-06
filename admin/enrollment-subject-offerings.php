<?php
  include '../all/connect_to_db.php';
  include 'form-handler.php';

  if(isset($_GET['add-SO-btn'])){
    //addSubjOffering($_GET['faculty'],$_GET['subject'], $_GET['room'], $conn);
    if(isset($_GET['day'])){
      addSubjOffering($_GET['faculty'],$_GET['subject'], $_GET['room'], $_GET['day'], $_GET['start'], $_GET['end'],$conn);
    }else{
      echo "<script>alert('Add atleast one schedule.')</script>";
    }
  }

  if(isset($_GET['remove-SO-btn'])){
    removeSubjOffering($_GET['id'], $conn);
  }

  if(isset($_GET['edit-faculty-btn'])){
    editFacultySubjOffering($_GET['id'], $_GET['faculty'], $conn);
  }
?>


    <?php include '../all/pageheader.php'; ?>
    
      <div class="container" style="margin-top: 20px;">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>SUBJECT OFFERINGS</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#add-subject-offering-modal">
                    Add Subject Offering
                </button>
            </div>
          </div> 

          <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
              <div class="table-card">
                <div class="card-body"  style='height: 440px; overflow-y:auto;'>
                  <table class="table " style="width: 100%; margin: auto;">
                    <thead class="thead-light">
                      <tr>
                        <th style=' text-align: left;' scope="col">Course</th>
                        <th style=' text-align: center;'scope="col">Room</th>
                        <th style=' text-align: center;'scope="col">Schedule</th>
                        <th style=' text-align: left;'scope="col">Instructor</th>
                        <th></th>
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
                            
                            $sc = mysqli_query($conn, "select*from schedules where offered_subject_id =".$o['id']." order by day asc");
                    
                            $i = mysqli_query($conn, "select*from faculty where id=".$o['faculty_id']);
                            $i = mysqli_fetch_assoc($i);
                            echo "
                            <tr id='O".$o['id']."'>
                              <td style=' text-align: left;'>".$c['code']." ".$c['name']."</td>
                              <td style=' text-align: center;'>".$r['name']."</td>
                              <td style=' text-align: center;'>";
                            while($sched = mysqli_fetch_assoc($sc)){
                              $day = int_to_day($sched['day']);
                              $start = int_to_start_time($sched['time_start']);
                              $end = int_to_start_time($sched['time_end']);
                              echo $day." ".$start." - ".$end."<br>";
                            }
                            
                            echo "</td>
                              <td style=' text-align: left;'>".$i['first_name']." ".$i['last_name']."</td>
                              <td>
                                <button onclick='getID(this.id)' value='".$o['id']."' id='O".$o['id']."' style=' margin-right:5px;' type='button' class='btn btn-warning' data-toggle='modal' data-target='#edit-faculty-modal'>
                                  <i class='fas fa-pencil-alt'></i>
                                </button>
                              </td>
                              <td style=' text-align: right;'>
                                <button onclick='getID(this.id)' value='".$o['id']."' id='O".$o['id']."' type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete-SO-modal'>
                                  <i class='far fa-trash-alt'></i>
                                </button>
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

      <!-- ADD SUBJECT OFFERING MODAL -->
                  <div class="modal fade" id="add-subject-offering-modal" tabindex="-1" role="dialog" aria-labelledby="#add-subject-offering-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="#add-subject-offering-modal">Add Subject Offering</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="enrollment-subject-offerings.php" method="get">
                          <div class="modal-body" style='height:400px; overflow-y:auto;'>
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

                            <div class="input-group mb-3">
                              <i class="far fa-clock" style="margin-right: 3px;"></i><h5>SCHEDULE</h5>
                              <?php 
                                $days = ['MON', 'TUE', 'WED', 'THU', 'FRI'];
                                $ctr=0;
                                
                                foreach($days as $d){
                                  echo "
                                        <div class='input-group mb-3' class='schedbox' >
                                          <div class='input-group-prepend'>
                                            <div class='input-group-text'>
                                              <input class='schedbox' type='checkbox' value='1' name='day[$ctr]' aria-label='Checkbox for following text input'>
                                              <div class='day'>
                                                $d
                                              </div>
                                              <select name='start[$ctr]' required disabled class='form-control time_dropdown'>
                                                <option value=''>Start Time</option>
                                              </select>
                                              <select name='end[$ctr]' required disabled class='form-control time_dropdown' >
                                                <option value='' >End Time</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                  ";
                                  $ctr++;
                                }
                              ?>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="add-SO-btn" value="1" class="btn btn-success add-SO-btn">Add</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

  <!-- EDIT FACULTY - SUBJECT OFFERING MODAL -->
        <div class="modal fade" id="edit-faculty-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5>Change Faculty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form action="enrollment-subject-offerings.php" method="get" >
                    <input type="hidden" class="id" name="id" value="">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" ><i class='	fas fa-chalkboard-teacher'></i></span>
                      </div>
                      
                      <select required  name="faculty" class="form-control">
                        <option value="" class='faculty' >Faculty</option>
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
                      
                      <button type="submit" name="edit-faculty-btn" value="1"class="btn btn-success">Save Changes</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>          
          </div>


  <!-- DELETE SUBJECT OFFERING MODAL -->
      <div class="modal fade" id="delete-SO-modal" tabindex="-1" role="dialog" aria-labelledby="delete-SO-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this Subject Offering?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="enrollment-subject-offerings.php" method="get">
                      <input type="hidden" class="id" name="id" value="">
                      <button type="submit" name="remove-SO-btn" value="1"class="btn btn-danger">Remove</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>          
          </div>
  </body>
</html>
<script>

  $('.day').css("width", "200px");
  $('.day').css("padding", "10px");

  // FOR EDIT AND DELETE MODAL
  function getID(i){
    var value = $('#'+i+" td:nth-child(6) button").attr('value');

    //alert(value);
    $('.id').val(value);
    $('.faculty').html($('#'+i+" td:nth-child(4)").html());
  }

  // FOR TIME SCHEDULE DROPDOWN

  var time = ['7:30 AM', '8:00 AM', '8:30 AM', '9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
             '12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM', '4:00 PM', '4:30PM',
             '5:00 PM', '5:30 PM', '6:00 PM', '6:30 PM', '7:00 PM', '7:30 PM'];

  $('.time_dropdown').css("position", "relative");

  var value=2;
  time.forEach((i)=>{
    $('.time_dropdown').append("<option value='"+value+"'>"+i+"</option>");
    value++;
  })

  //FOR CHECKBOX
  $('.schedbox').click(function(){
    if($(this).is(":checked")){
      //alert("checked");
      $(this).siblings().removeAttr("disabled");
    }else{
      $(this).siblings().attr("disabled","disabled");
    }
  })

  // SCHED VALIDATION
  $('.add-SO-btn').click(()=>{
    if($('input[type=checkbox]:checked').length==0){

    }
  })

  
</script>
<?php
  include '../all/connect_to_db.php';
  include 'form-handler.php';
  

  if(isset($_GET['enroll-stud-btn'])){
    enrollStudent($_GET['student'], $_GET['offering'], $conn);
  }
?>

  <?php include '../all/pageheader.php'; ?>
      <div class="container" style="margin-top: 20px;">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>STUDENT ENROLLMENT</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;"type="button" class="btn btn-success" data-toggle="modal" data-target="#enroll-student-modal">
                    Enroll Student
                </button>
                  
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="table-card">
                <div class="card-body">
                <table class="table " style="width: 100%; margin: auto;">
                    <thead class="thead-light">
                      <tr>
                        <th style=' text-align: left;' scope="col">ID</th>
                        <th style=' text-align: left;' scope="col">Course</th>
                        <th style=' text-align: center;'scope="col">Room</th>
                        <th style=' text-align: center;'scope="col">Schedule</th>
                        <th style=' text-align: left;'scope="col">Instructor</th>
                        <th style=' text-align: center;'scope="col">Enrolled</th>
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
                    

                            $s = mysqli_query($conn, "select*from enrolled_students where offering_id=".$o['id']);
                            $s = mysqli_num_rows($s);
                            $i = mysqli_query($conn, "select*from faculty where id=".$o['faculty_id']);
                            $i = mysqli_fetch_assoc($i);
                            echo "
                            <tr id='O".$o['id']."'>
                              <td style=' text-align: center;'>".$o['id']."</td>
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
                              <td style=' text-align: center;'>".$s."/".$r['capacity']."</td>
                              <td style=' text-align: center;'>
                                <button type='button' class='btn btn-info'>
                                  <i class='fa fa-eye'></i>
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

      <!-- Enroll Student Modal -->
                  <div class="modal fade" id="enroll-student-modal" tabindex="-1" role="dialog" aria-labelledby="enroll-student-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="enroll-student-modal">Enroll Student</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <form action="enrollment-student.php" method="get">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="name"><i class='fas fa-book-reader'></i></span>
                            </div>
                            <select required  name="student" class="form-control">
                                <option value="">Student Name</option>
                                <?php 
                                  $students = mysqli_query($conn, "SELECT*FROM students where deleted_at is null order by last_name asc");
                                  while($s = mysqli_fetch_assoc($students)){
                                    echo "<option value='".$s['id']."'>".$s['last_name'].", ".$s['first_name']."</option>";
                                  }
                                ?>
                            </select>

                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="capacity"><i class='far fa-keyboard'></i></span>
                            </div>
                            <select required  name="offering" class="form-control">
                                <option value="">Offering</option>
                                <?php 
                                  $offerings = mysqli_query($conn, "SELECT*FROM offered_subjects where deleted_at is null order by subject_id asc");
                                  while($o = mysqli_fetch_assoc($offerings)){
                                    $code = mysqli_query($conn, "SELECT*FROM subjects where id = ".$o['subject_id']);
                                    $code = mysqli_fetch_assoc($code);
                                    echo "<option value='".$o['id']."'>".$o['id']." - ".$code['code']."</option>";
                                  }
                                ?>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name='enroll-stud-btn' value='1' class="btn btn-success">Add</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>  
  </body>
     
</html>
<script>

</script>
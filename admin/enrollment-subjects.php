<?php
  include '../connect_to_db.php';
  include 'pageheader.php';
?>
      <div class="container" style="margin-top: 20px;">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <h1>SUBJECTS</h1>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <button style="float:right;"type="button" class="btn btn-success" data-toggle="modal" data-target="#enroll-student-modal">
                    Add Subject
                </button>
                  <!-- Enroll Student Modal -->
                  <div class="modal fade" id="enroll-student-modal" tabindex="-1" role="dialog" aria-labelledby="enroll-student-modal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="enroll-student-modal">Add Subject</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        <form action="enrollment-student.php" method="get">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="name"><i class='fas fa-door-open'></i></span>
                            </div>
                            <input name="name" type="text" class="form-control" placeholder="Room Name" aria-label="name" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="capacity"><i class='fas fa-users'></i></span>
                            </div>
                            <input name="capacity" min=0 type="number" class="form-control" placeholder="Capacity" aria-label="capacity" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Add</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>   
  </body>
     
</html>
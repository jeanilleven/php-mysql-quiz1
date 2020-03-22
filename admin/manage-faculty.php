<?php
  require 'connect_to_db.php';
?>

<!doctype html>
<html>
    <head>
        <title>ISMIS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="manage-enrollment-nav-js.js"></script>
        <link rel="stylesheet" href="index-styles.css" type="text/css">
    </head>
    <body>
      <nav id="header" style="background-color: #f8f9fa;">
        <img id="navbar-pic" height="50" src="pics/nav-logo.png" style="margin-left: 50px;">
        <span  style="color:#07500b; " class="dropdown">
          <a style="box-shadow:none;"id="user-dropdown" class="btn btn-secondary dropdown-toggle" href="#" role="button" id="user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img id="user-icon" style="border-radius: 50%; border: 1px solid gray;" src="pics/man-icon.png" alt="icon">
            <span style="color:#07500b; " id="user-id">18400175</span>
          </a>
          <span class="dropdown-menu" aria-labelledby="user-dropdown">
            <a class="dropdown-item" data-toggle="modal" data-target="#change-pw-modal" type="button" style="cursor:pointer">Change Password</a>
            <a class="dropdown-item" href="#">Logout</a>
          </span>
        </span>
      </nav>

      <nav style="background-color: #07500b;"id="menu" class="navbar navbar-expand-lg navbar-light">
        <a style="color: white;margin-left: 80px;"class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a style="color:white;"class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manage
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Faculty</a>
                <a class="dropdown-item" href="manage-students.php">Students</a>
                <a class="dropdown-item" href="manage-rooms.php">Rooms</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Enrollment
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="enrollment-student.php">Student Enrollment</a>
                <a class="dropdown-item" href="enrollment-subjects.php">Subjects</a>
                <a class="dropdown-item" href="enrollment-subject-offerings.php">Subject-Offerings</a>
              </div>
            </li>
        </div>
      </nav>


      <!-- END OF NAVIGATION -->

      <!-- CHANGE PASSWORD MODAL -->
      <div class="modal fade" id="change-pw-modal" tabindex="-1" role="dialog" aria-labelledby="change-pw-moda" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="">Change Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body">
            <form>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="old_pw"><i class='fas fa-lock'></i></span>
                </div>
                <input name="old-pw" type="password" class="form-control" placeholder="Old Password" aria-label="Old Password" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="old_pw"><i class='fas fa-lock'></i></span>
                </div>
                <input name="new-pw" type="password" class="form-control" placeholder="New Password" aria-label="pw1" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="old_pw"><i class='fas fa-lock'></i></span>
                </div>
                <input name="pw2" type="password" class="form-control" placeholder="Confirm Password" aria-label="pw2" aria-describedby="basic-addon1">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
      </div>
      </div>


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
                            <input name="fname" type="text" class="form-control" placeholder="First Name" aria-label="fname" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="lname"><i class='fas fa-user-alt'></i></span>
                            </div>
                            <input name="lname" type="text" class="form-control" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="email"><i class='far fa-envelope'></i></span>
                            </div>
                            <input name="email" type="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1">
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
                              <input name="gender" class="form-check-input" type="radio" value="Female">
                              <label class="form-check-label" for="inlineCheckbox2">Female</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="start_term"><i class='far fa-calendar-alt'></i></span>
                            </div>
                            <select name="year" class="form-control">
                              <option value="null">Start Year</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                            </select>
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="start_term"><i class='far fa-clock'></i></span>
                            </div>
                            <select name="term" class="form-control">
                              <option value="null">Start Term</option>
                              <option value="First Semester">First Semester</option>
                              <option value="Second Semester">Second Semester</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Add</button>
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
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark Otto</td>
                        <td>2019</td>
                        <td>First Semester</td>
                        <td></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-faculty-modal">
                              <i class='far fa-trash-alt'></i>
                            </button></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Keenan Mendiola</td>
                        <td>2019</td>
                        <td>First Semester</td>
                        <td></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-faculty-modal">
                              <i class='far fa-trash-alt'></i>
                            </button></td>
                      </tr>
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
                    <form action="manage-faculty.php" method="get">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-danger">Remove</button>
                    </form>
                  </div>
                  </div>
                </div>
              </div>          
            </div>
      
  </body>
     
</html>
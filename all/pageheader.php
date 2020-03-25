<?php
    echo "
    <!doctype html>
    <html>
        <head>
            <title>ISMIS</title>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
            <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
            <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
            <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
            <script src='https://kit.fontawesome.com/a076d05399.js'></script>
            <script src='../admin/manage-enrollment-nav-js.js'></script>
            <link rel='stylesheet' href='../admin/index-styles.css' type='text/css'>
        </head>
        <body>
          <nav id='header' style='background-color: #f8f9fa;'>
            <img id='navbar-pic' height='50' src='../pics/nav-logo.png' style='margin-left: 50px;'>
            <span  style='color:#07500b; ' class='dropdown'>
              <a style='box-shadow:none;'id='user-dropdown' class='btn btn-secondary dropdown-toggle' href='#' role='button' id='user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                <img id='user-icon' style='border-radius: 50%; border: 1px solid gray;' src='../pics/man-icon.png' alt='icon'>
                <span style='color:#07500b; ' id='user-id'>Admin</span>
              </a>
              <span class='dropdown-menu' aria-labelledby='user-dropdown'>
                <a class='dropdown-item' href='../index.php?end=1'>Logout</a>
              </span>
            </span>
          </nav>
    
          <nav style='background-color: #07500b;'id='menu' class='navbar navbar-expand-lg navbar-light'>
            <a style='color: white;margin-left: 80px;'class='navbar-brand' href='#'></a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
              <span class='navbar-toggler-icon'></span>
            </button>
          
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
              <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                  <a style='color:white;'class='nav-link' href='../home.php'>Home <span class='sr-only'>(current)</span></a>
                </li>
                <li class='nav-item dropdown'>
                  <a style='color:white;' class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Manage
                  </a>
                  <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='../admin/manage-faculty.php'>Faculty</a>
                    <a class='dropdown-item' href='../admin/manage-students.php'>Students</a>
                    <a class='dropdown-item' href='../admin/manage-rooms.php'>Rooms</a>
                  </div>
                </li>
                <li class='nav-item dropdown'>
                  <a style='color:white;' class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Enrollment
                  </a>
                  <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='../admin/enrollment-student.php'>Enrollment - Students</a>
                    <a class='dropdown-item' href='../admin/enrollment-subjects.php'>Enrollment - Subjects</a>
                    <a class='dropdown-item' href='../admin/enrollment-subject-offerings.php'>Enrollment - Subject Offerings</a>
                  </div>
                </li>
            </div>
          </nav>
    
    
          <!-- END OF NAVIGATION -->
    
          <!-- CHANGE PASSWORD MODAL -->
          <div class='modal fade' id='change-pw-modal' tabindex='-1' role='dialog' aria-labelledby='change-pw-moda' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id=''>Change Password</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
              <div class='modal-body'>
                <p style='color: red;'>*Admin account is hardcoded. You cannot change password.</p>
                <form>
                  <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='old_pw'><i class='fas fa-lock'></i></span>
                    </div>
                    <input disabled name='old-pw' type='password' class='form-control' placeholder='Old Password' aria-label='Old Password' aria-describedby='basic-addon1'>
                  </div>
                  <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='old_pw'><i class='fas fa-lock'></i></span>
                    </div>
                    <input disabled name='new-pw' type='password' class='form-control' placeholder='New Password' aria-label='pw1' aria-describedby='basic-addon1'>
                  </div>
                  <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='old_pw'><i class='fas fa-lock'></i></span>
                    </div>
                    <input disabled name='pw2' type='password' class='form-control' placeholder='Confirm Password' aria-label='pw2' aria-describedby='basic-addon1'>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                  <button type='submit' class='btn btn-success'>Save changes</button>
                </div>
                </form>
            </div>
          </div>
        </div>
    ";
?>


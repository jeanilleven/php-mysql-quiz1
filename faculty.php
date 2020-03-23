<?php 

    include './all/connect_to_db.php';

    include './all/translators.php';

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
    <link rel="stylesheet" href="admin/index-styles.css" type="text/css">


</head>
<body>

    <?php include 'all/nav_logo_profile.php'; ?>

    <nav style="background-color: #07500b;"id="menu" class="navbar navbar-expand-lg navbar-light">
        <a style="color: white;margin-left: 80px;"class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a style="color:white;"class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a style="color:white;" class="nav-link" href="#">
                    Subjects
                </a>
            </li>
            <li class="nav-item">
                <a style="color:white;" class="nav-link" href="#">
                    Schedule
                </a>
            </li>
        </div>
    </nav>

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <h1>SUBJECTS</h1>
            </div>

            <div class="row mx-auto">
                <div class="col-lg-12">
                    <div class="table-card">
                        <div class="card-body">
                            <table class="table">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Room</th>
                                <th scope="col">Schedule</th>
                                <th></th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT offered_subjects.id, subjects.id AS subject_id, subjects.code, subjects.name AS subject_name, rooms.name AS room_name FROM offered_subjects INNER JOIN subjects ON offered_subjects.subject_id=subjects.id INNER JOIN rooms ON offered_subjects.room_id=rooms.id WHERE offered_subjects.faculty_id =".$_SESSION['account_id'];                               
                                $res = mysqli_query($conn, $query);
                                $prev_id = 0;
                                foreach($res as $r):?>
                                    <!-- /**
                                        *TODO: consider deleted_at 
                                     */ -->
                                        
                                    <tr>
                                        <td style=' text-align: left;'>[<?php echo $r['code']?>] <?php echo $r['subject_name'] ?></td>
                                        <td style=' text-align: left;'><?php echo $r['room_name']?></td>
                                        <td style=' text-align: left;'>
                                            <?php
                                                $query = "SELECT * FROM schedules WHERE offered_subject_id=".$r['id'];                               
                                                $scheds = mysqli_query($conn, $query);
                                            ?>
                                            <?php foreach($scheds as $s):?>
                                                <li><?php echo int_to_day($s['day'])?> - <?php echo int_to_start_time($s['time_start']) ?> to <?php echo int_to_end_time($s['time_end']) ?></li>
                                            <?php endforeach?>
                                            
                                        </td>
                                        <td style=' text-align: left;'></td>
                                    </tr> 
                                <?php endforeach?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
     
</html>


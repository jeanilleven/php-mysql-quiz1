<?php 

    include './all/connect_to_db.php';

    include './all/translators.php';

    if(isset($_GET['tab'])){
        $_SESSION['open_tab'] = $_GET['tab'];
        
        header("location: ../account.php");
    }
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
                <a style="color:white;"class="nav-link" href="./account.php/?tab=home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a style="color:white;" class="nav-link" href="./account.php/?tab=subjects">
                    Subjects
                </a>
            </li>
            <li class="nav-item">
                <a style="color:white;" class="nav-link" href="./account.php/?tab=schedule">
                    Schedule
                </a>
            </li>
        </div>
    </nav>

    <?php if($_SESSION['open_tab'] == 'subjects'):?>
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
                                $query = "SELECT offered_subjects.id, subjects.id AS subject_id, subjects.code, subjects.name AS subject_name, rooms.name AS room_name FROM offered_subjects INNER JOIN subjects ON offered_subjects.subject_id=subjects.id INNER JOIN rooms ON offered_subjects.room_id=rooms.id WHERE offered_subjects.deleted_at IS NULL AND offered_subjects.faculty_id =".$_SESSION['account_id'];                               
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
                                                $query = "SELECT * FROM schedules WHERE deleted_at IS NULL AND offered_subject_id=".$r['id'];                               
                                                $scheds = mysqli_query($conn, $query);
                                            ?>
                                            <?php foreach($scheds as $s):?>
                                                <li><?php echo int_to_day($s['day'])?> - <?php echo int_to_start_time($s['time_start']) ?> to <?php echo int_to_end_time($s['time_end']) ?></li>
                                            <?php endforeach?>
                                            
                                        </td>
                                        <td style=' text-align: left;'>
                                        <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                                            See students
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel"><?php echo $r['code']?> <?php echo $r['subject_name']?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $query = "SELECT students.first_name, students.last_name FROM enrolled_students INNER JOIN students ON enrolled_students.student_id=students.id WHERE enrolled_students.offered_subject_id=".$r['id']." AND enrolled_students.deleted_at IS NULL ";                               
                                                        
                                                        $stud = mysqli_query($conn, $query);
                                                        
                                                    ?>
                                                    <?php foreach($stud as $st):?>
                                                        <input style='margin-bottom: 3px;' class='form-control' disabled type='text' value='<?php echo $st['first_name']?> <?php echo $st['last_name']?>'>
                                                    <?php endforeach?>
                                            

                                                    
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </td>
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

    <?php elseif($_SESSION['open_tab'] == 'schedule'):?>

        <?php
            $query = 'SELECT offered_subjects.id, subjects.code, subjects.name FROM offered_subjects INNER JOIN subjects ON offered_subjects.subject_id=subjects.id WHERE offered_subjects.faculty_id='.$_SESSION['account_id'].' AND offered_subjects.deleted_at IS NULL';   
            
            $res = mysqli_query($conn, $query);
            $sched_array = array(array(), array(), array(), array(), array());

            $c = 0;
            $colors = ['#CC99C9', '#9EC1CF', '#9EE09E', '#FDFD97', '#FEB144', '#FF6663'];

            foreach($res as $r){
                $query = 'SELECT * FROM schedules WHERE deleted_at IS NULL AND offered_subject_id='.$r['id'];   
                $sch = mysqli_query($conn, $query);

                foreach($sch as $s){
                    for($x = $s['time_start']; $x <= $s['time_end']; $x++){
                        $sched_array[$s['day']][$x] = array('name' =>$r['name'], 'code' => $r['code'], 'color' => $colors[$c]);
                    }
                }

                $c++;
                
            }        
        ?>
        <div class="container mt-5">
            <table style="text-align: center">
                <thead>
                    <th style="width:200px; text-align: center">Time</th>
                    <th style="width:200px; text-align: center">Monday</th>
                    <th style="width:200px; text-align: center">Tuesday</th>
                    <th style="width:200px; text-align: center">Wednesday</th>
                    <th style="width:200px; text-align: center">Thursday</th>
                    <th style="width:200px; text-align: center">Friday</th>
                </thead>
                <tbody>
                    <?php for($t = 2; $t < 30; $t++):?>
                        <tr>
                            <td><?php echo int_to_start_time($t)?></td>
                            <?php for($d = 1; $d <= 5; $d++):?>
                                <?php if(isset($sched_array[$d][$t])):?>
                                    <td style="background-color: <?php echo $sched_array[$d][$t]['color'] ?>; font-weight: 500;border: 1px solid <?php echo $sched_array[$d][$t]['color'] ?>; min-height: 40px; width=150px">
                                        <?php echo $sched_array[$d][$t]['code']?>
                                    </td>   
                                <?php else:?>
                                    <td style="border: 1px solid grey; height: 20px; width:200px">
                                        
                                    </td>   
                                <?php endif?>
                            <?php endfor?>
                        </tr>
                    <?php endfor?>
                </tbody>
            </table>
        </div>
    <?php else:?>

    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="card" style="margin-top: 20px;">
            <div class="card-body">
                <h1>LOREM IPSUM</h1>
            </div>
            </div>
        </div>
        </div>
    </div>

    <?php endif?>
</body>
     
</html>


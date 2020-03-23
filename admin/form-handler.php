<?php 
    include '../all/translators.php';

    // Manage Student Functions

    function removeStudent($id, $conn){
        $query = "UPDATE students SET deleted_at = now() WHERE id = $id";
        mysqli_query($conn, $query);


    }

    function addStudent($fname, $lname, $gender, $course, $year, $conn){
        $fname = ucfirst($fname);
        $lname = ucfirst($lname);
        $pw = md5($fname);
        $query = "INSERT INTO students(first_name, last_name, password, gender, course, year, created_at) VALUES('$fname','$lname','$pw','$gender','$course','$year', now() )";
        mysqli_query($conn, $query);

    }

    // Manage Faculty Functions
    function addFaculty($fname, $lname, $email, $gender, $term, $year, $conn){
        $fname = ucfirst($fname);
        $lname = ucfirst($lname);
        $pw = md5($fname);
        $query = "INSERT INTO faculty(first_name, last_name, email, gender,password, start_term, start_year, created_at) VALUES('$fname','$lname', '$email','$gender','$pw' ,'$term','$year', now() )";
        mysqli_query($conn, $query);
    }

    function removeFaculty($id, $conn){
        $query = "UPDATE faculty SET deleted_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

    }


    // Manage Room Functions
    function insertRoom($room , $capacity, $conn){
        $query = "INSERT INTO rooms(name, capacity, created_at) VALUES('$room', '$capacity', now())";
        mysqli_query($conn, $query);

    }

    function deleteRoom($id, $conn){
        $query = " UPDATE rooms SET deleted_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

        header('location:manage-rooms.php');
    }

    function editRoom($id, $name, $cap, $conn){
        $query = "UPDATE rooms SET name='$name', capacity='$cap', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

    }

    // Enrollment - Subjects Functions
    function addSubject($name, $code, $conn){
        $query = "INSERT INTO subjects(name, code) VALUES('$name', '$code')";
        mysqli_query($conn, $query);

    }

    function removeSubject($id, $conn){
        $query = " UPDATE subjects SET deleted_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

    }

    function editSubject($id, $name, $code, $conn){
        $query = "UPDATE subjects SET name='$name', code='$code', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

    }

    // Enrollment - Subject Offerings Functions

    function addSubjOffering($faculty, $subject, $room, $day, $start, $end, $conn){
        // IN THIS FUNCTION, UPDATE BOTH OFFERED_SUBJECTS AND SCHEDULES TABLE. 

        $table = mysqli_query($conn,"SELECT * FROM schedules LEFT JOIN offered_subjects 
                                     ON schedules.offered_subject_id = offered_subjects.id 
                                     WHERE offered_subjects.faculty_id = $faculty ");

        
        //go through per day sa $table, e compare na dayun ang dates. 

        $conflict = 0;

        foreach($day as $key => $value){
            $d = $key+1;
            
            while($row=mysqli_fetch_assoc($table)){
                if($start[$key] >= $row['time_start'] && $end[$key] <= $row['time_end']){
                    $conflict = 1;
                    break;
                }else if($end[$key] > $row['time_start'] && $start[$key] < $row['time_end']){
                    $conflict = 1;
                    break;
                }else if($start[$key] > $row['time_end'] && $end[$key] > $row['time_start']){
                    $conflict = 1;
                    break;
                }
            }

            if($conflict){
                echo "Conflicting sched";
            }else{
                echo "not conflicting sched";
            }
        }

        if($conflict==0){
            //UPDATING OFFERED_SUBJECTS
            $query = "INSERT INTO offered_subjects(faculty_id, room_id, subject_id, created_at)
                      VALUES('$faculty','$room', '$subject', now())";
            mysqli_query($conn, $query);

            $id = mysqli_query($conn, "SELECT * FROM offered_subjects ORDER BY id desc LIMIT 1");
            $id = mysqli_fetch_assoc($id);

            $id = $id['id'];

        
            //UPDATING SCHEDULES
            foreach($day as $indx=>$value){
                $d = $indx+1;
                $s = $start[$indx];
                $e = $end[$indx];

                mysqli_query($conn, "INSERT INTO schedules(offered_subject_id, day, time_start, time_end, created_at)
                                 VALUES('$id','$d', '$s', '$e', now() )");
            }
        }
        
        
    }

    function removeSubjOffering($id, $conn){
        $s = mysqli_query($conn, "select*from enrolled_students where offering_id=$id");

        if(mysqli_num_rows($s)==0){
            mysqli_query($conn, "UPDATE offered_subjects SET deleted_at = now() WHERE id = $id");
        }else{
            echo "<script>alert('Students should unenroll from this Subject Offering if you wish to proceed.');</script>";
        }
    }

    function editFacultySubjOffering($id, $faculty, $conn){
        


        $query = "UPDATE offered_subjects SET faculty_id = '$faculty', updated_at = now() WHERE id = $id ";
        mysqli_query($conn, $query);

    }

?>
<?php 
    include '../all/translators.php';

    // Manage Student Functions

    function removeStudent($id, $conn){

        $id = mysqli_real_escape_string($conn, $id);
        $query = "UPDATE students SET deleted_at = now() WHERE id = $id";
        mysqli_query($conn, $query);


    }

    function addStudent($fname, $lname, $gender, $course, $year, $conn){
        $fname = mysqli_real_escape_string($conn, $fname);
        $lname = mysqli_real_escape_string($conn, $lname);

        $fname = ucfirst($fname);
        $lname = ucfirst($lname);
        $pw = md5($fname);
        $query = "INSERT INTO students(first_name, last_name, password, gender, course, year, created_at) VALUES('$fname','$lname','$pw','$gender','$course','$year', now() )";
        mysqli_query($conn, $query);

    }

    // Manage Faculty Functions
    function addFaculty($fname, $lname, $email, $gender, $term, $year, $conn){
        $fname = mysqli_real_escape_string($conn, $fname);
        $lname = mysqli_real_escape_string($conn, $lname);
        $email = mysqli_real_escape_string($conn, $email);
        $gender = mysqli_real_escape_string($conn, $gender);
        $term = mysqli_real_escape_string($conn, $term);
        $year = mysqli_real_escape_string($conn, $year);

        $fname = ucfirst($fname);
        $lname = ucfirst($lname);
        $pw = md5($fname);
        $query = "INSERT INTO faculty(first_name, last_name, email, gender,password, start_term, start_year, created_at) VALUES('$fname','$lname', '$email','$gender','$pw' ,'$term','$year', now() )";
        mysqli_query($conn, $query);
    }

    function removeFaculty($id, $conn){
        $id = mysqli_real_escape_string($conn, $id);

        $subjects = mysqli_query($conn, "SELECT*FROM offered_subjects where faculty_id = $id and deleted_at is null");
        $subjects = mysqli_num_rows($subjects);

        if($subjects){
            echo "<script>alert('This staff is still handling one of the subjects offered. Cannot delete.');</script>";
        }else{
            $query = "UPDATE faculty SET deleted_at=now() WHERE id=$id";
            mysqli_query($conn, $query);
        }
        

    }


    // Manage Room Functions
    function insertRoom($room , $capacity, $conn){
        $room = mysqli_real_escape_string($conn, $room);
        $$capacity = mysqli_real_escape_string($conn, $$capacity);
        $query = "INSERT INTO rooms(name, capacity, created_at) VALUES('$room', '$capacity', now())";
        mysqli_query($conn, $query);

    }

    function deleteRoom($id, $conn){
        $id = mysqli_real_escape_string($conn, $id);
        $offered = mysqli_query($conn, "SELECT*FROM offered_subjects where room_id = $id and deleted_at is null");

        if(mysqli_num_rows($offered)){
            echo "<script>alert('Room is still used for an offered subject. Cannot delete yet. ');</script>";
        }else{
            $query = " UPDATE rooms SET deleted_at=now() WHERE id=$id";
            mysqli_query($conn, $query);
        }
        

    }

    function editRoom($id, $name, $cap, $conn){
        $id = mysqli_real_escape_string($conn, $id);
        $name = mysqli_real_escape_string($conn, $name);
        $cap = mysqli_real_escape_string($conn, $cap);

        $query = "UPDATE rooms SET name='$name', capacity='$cap', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

    }

    // Enrollment - Subjects Functions
    function addSubject($name, $code, $conn){
        $name = mysqli_real_escape_string($conn, $name);
        $code = mysqli_real_escape_string($conn, $code);

        $query = "INSERT INTO subjects(name, code) VALUES('$name', '$code')";
        mysqli_query($conn, $query);

    }

    function removeSubject($id, $conn){
        $id = mysqli_real_escape_string($conn, $id);

        $offered = mysqli_query($conn, "SELECT*FROM offered_subjects where subject_id = $id and deleted_at is null");
        
        if(mysqli_num_rows($offered)){
            echo "<script>alert('This subject is still being offered. Cannot delete yet.');</script>";
        }else{
            $query = " UPDATE subjects SET deleted_at=now() WHERE id=$id and deleted_at is null";
            mysqli_query($conn, $query);
        }
    }

    function editSubject($id, $name, $code, $conn){
        $id = mysqli_real_escape_string($conn, $id);
        $name = mysqli_real_escape_string($conn, $name);
        $code = mysqli_real_escape_string($conn, $code);

        $query = "UPDATE subjects SET name='$name', code='$code', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

    }

    // Enrollment - Subject Offerings Functions

    function addSubjOffering($faculty, $subject, $room, $day, $start, $end, $conn){
        $faculty = mysqli_real_escape_string($conn, $faculty);
        $subject = mysqli_real_escape_string($conn, $subject);
        $room = mysqli_real_escape_string($conn, $room);

       
        // IN THIS FUNCTION, UPDATE BOTH OFFERED_SUBJECTS AND SCHEDULES TABLE. 

        $table = mysqli_query($conn,"SELECT * FROM schedules LEFT JOIN offered_subjects 
                                     ON schedules.offered_subject_id = offered_subjects.id 
                                     WHERE offered_subjects.faculty_id = $faculty ");

        
        //go through per day sa $table, e compare na dayun ang dates. 

        foreach($day as $key => $value){
            $conflict = 0;
            while($row=mysqli_fetch_assoc($table)){
                if($start[$key] >= $row['time_start'] || $end[$key] <= $row['time_end']){
                    $conflict = 1;
                    break;
                }
            }
        }
            if($conflict){
                echo "<script>alert('Cannot add subject offering. Schedule is in conflict with the teacher.');</script>";
            }else{
                //UPDATING OFFERED_SUBJECTS
                $query = "INSERT INTO offered_subjects(faculty_id, room_id, subject_id, created_at)
                          VALUES('$faculty','$room', '$subject', now())";
                
                //debug_print_backtrace();
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
        $id = mysqli_real_escape_string($conn, $id);

        $s = mysqli_query($conn, "select*from enrolled_students where offered_subject_id=$id and deleted_at is null");

        if(mysqli_num_rows($s)==0){
            mysqli_query($conn, "UPDATE offered_subjects SET deleted_at = now() WHERE id = $id;");
            mysqli_query($conn, "DELETE FROM schedules WHERE offered_subject_id = $id");
        }else{
            echo "<script>alert('Students should unenroll from this Subject Offering if you wish to proceed.');</script>";
        }
    }

    function editFacultySubjOffering($id, $faculty_id, $conn){
        $id = mysqli_real_escape_string($conn, $id);
        $faculty_id = mysqli_real_escape_string($conn, $faculty_id);

        $sched = mysqli_query($conn, "SELECT * FROM schedules WHERE offered_subject_id = $id");

        $faculty = mysqli_query($conn,"SELECT * FROM schedules LEFT JOIN offered_subjects 
            ON schedules.offered_subject_id = offered_subjects.id 
            WHERE offered_subjects.faculty_id = $faculty_id ");

        $conflict = 0;

        //Kuhaa ang sched sa offering... 
        //Usa-usaha ug compare according to day, start and end.

        while($offering_sched = mysqli_fetch_assoc($sched)){
            if($conflict==0){
                while($faculty_sched = mysqli_fetch_assoc($faculty)){
                    if($offering_sched['day']==$faculty_sched['day']){
                        if($offering_sched['time_start'] >= $faculty_sched['time_start'] || $offering_sched['time_end'] <= $faculty_sched['time_end']){
                            $conflict = 1;
                            break;
                        }
                    }
                }
            }
        }

        // 

        if($conflict){
            echo "<script>alert('Cannot replace teacher. Schedule is in conflict with the teacher.');</script>";
        }else{
            $query = "UPDATE offered_subjects SET faculty_id = '$faculty_id', updated_at = now() WHERE id = $id ";
            mysqli_query($conn, $query);
        }
    }


    //Enrollment - Students Functions

    function enrollStudent($student, $offering, $conn){
        $student = mysqli_real_escape_string($conn, $student);
        $offering = mysqli_real_escape_string($conn, $offering);

        //First, check if there is still slot left. 
        $enrollees = mysqli_query($conn, "SELECT*FROM enrolled_students WHERE offered_subject_id = $offering");
        $enrollees = mysqli_num_rows($enrollees);

        $subject = mysqli_query($conn, "SELECT*FROM offered_subjects WHERE id = $offering ");
        $subject = mysqli_fetch_assoc($subject);

        $r = $subject['room_id'];
        $room = mysqli_query($conn, "SELECT*from rooms WHERE id = $r");
        $room = mysqli_fetch_assoc($room);
        
        if($enrollees < $room['capacity']){
           // check if in conflict ba with student's schedule

            $conflict = 0;
            
            $subjects_enrolled = mysqli_query($conn, "SELECT*FROM enrolled_students WHERE student_id = $student");

            $offering_sched = mysqli_query($conn, "SELECT*FROM schedules WHERE offered_subject_id = $offering");
            $offering_sched = mysqli_fetch_assoc($offering_sched);

            while($se = mysqli_fetch_assoc($subjects_enrolled)){
                $offered_subj = $se['offered_subject_id'];
                $sched = mysqli_query($conn, "SELECT*FROM schedules WHERE offered_subject_id = $offered_subj");
                $sched = mysqli_fetch_assoc($sched);

                if($sched['time_start'] >= $offering_sched['time_start'] || $sched['time_end'] <= $offering_sched['time_end']){
                    $conflict = 1;
                    break;
                }
            }

            if($conflict){
                echo "<script>alert('Cannot enroll student. Schedules will be in conflict.');</script>";
            }else{
                mysqli_query($conn, "INSERT INTO enrolled_students(student_id, offered_subject_id, created_at)
                                 VALUES('$student', '$offering', now())");
            }
        
        }else{
            echo "<script>alert('Slots were all taken. Cannot enroll student anymore.');</script>";
        }
    }

?>
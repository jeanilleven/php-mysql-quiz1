<?php 
    // Manage Student Functions

    function removeStudent($id, $conn){
        $query = "UPDATE students SET deleted_at = now() WHERE id = $id";
        mysqli_query($conn, $query);

        header("location: manage-students.php");

    }

    function addStudent($fname, $lname, $gender, $course, $year, $conn){
        $fname = ucfirst($fname);
        $lname = ucfirst($lname);
        $pw = md5($fname);
        $query = "INSERT INTO students(first_name, last_name, password, gender, course, year, created_at) VALUES('$fname','$lname','$pw','$gender','$course','$year', now() )";
        mysqli_query($conn, $query);

        header("location: manage-students.php");
    }




    // Manage Faculty Functions
    function addFaculty($fname, $lname, $email, $gender, $term, $year, $conn){
        $fname = ucfirst($fname);
        $lname = ucfirst($lname);
        $pw = md5($fname);
        $query = "INSERT INTO faculty(first_name, last_name, email, gender,password, start_term, start_year, created_at) VALUES('$fname','$lname', '$email','$gender','$pw' ,'$term','$year', now() )";
        mysqli_query($conn, $query);
        header('location: manage-faculty.php');
    }

    function removeFaculty($id, $conn){
        $query = "UPDATE faculty SET deleted_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

        header('location: manage-faculty.php');
    }


    // Manage Room Functions
    function insertRoom($room , $capacity, $conn){
        $query = "INSERT INTO rooms(name, capacity, created_at) VALUES('$room', '$capacity', now())";
        mysqli_query($conn, $query);

        header('location: manage-rooms.php');
    }

    function deleteRoom($id, $conn){
        $query = " UPDATE rooms SET deleted_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

        header('location:manage-rooms.php');
    }

    function editRoom($id, $name, $cap, $conn){
        $query = "UPDATE rooms SET name='$name', capacity='$cap', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

        header('location: manage-rooms.php');
    }

    // Enrollment - Subjects Functions
    function addSubject($name, $code, $conn){
        $query = "INSERT INTO subjects(name, code) VALUES('$name', '$code')";
        mysqli_query($conn, $query);

        header('location: enrollment-subjects.php');
    }

    function removeSubject($id, $conn){
        $query = " UPDATE subjects SET deleted_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

        header('location:enrollment-subjects.php');
    }

    function editSubject($id, $name, $code, $conn){
        $query = "UPDATE subjects SET name='$name', code='$code', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

        header('location:enrollment-subjects.php');
    }

    // Enrollment - Subject Offerings Functions

    function addSubjOffering($subject, $room, $conn){
        $query = "INSERT INTO offered_subjects(room_id, subject_id, created_at) VALUES('$room', '$subject', now())";
        mysqli_query($conn, $query);

        header("location: enrollment-subject-offerings.php");
    }
?>
<?php 
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
?>
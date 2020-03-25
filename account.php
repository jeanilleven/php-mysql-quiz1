<?php 

    include 'all/connect_to_db.php';
    session_start();

        
    if(isset($_GET['end']) && $_GET['end'] == true){
        session_destroy();
        header('location: ../index.php');
    }

    // these $_SESSION variables are available for use in the admin.php, students.php and faculty.php
    if(isset($_POST['submit_login'])){
        $_SESSION['account_id'] = $_POST['account_id'];
        $_SESSION['account_type'] = $_POST['account_type'];
        $_SESSION['account_password'] = md5($_POST['account_password']);
        $_SESSION['open_tab'] = 'home'; // save current tab into this variable
    }
 

    // all "home" links should link to account.php NOT the admin.php, students.php and faculty.php

    if($_SESSION['account_id'] == 'admin' && $_SESSION['account_password'] == 'admin'){
        include 'home.php';
        //header('location: ./admin/home.php');
    }else{

        $account_query = "SELECT * FROM ".$_SESSION['account_type']." WHERE id=".$_SESSION['account_id']." AND password='".$_SESSION['account_password']."'";

        $res = $conn->query($account_query);
        $conn->close();

        if($res && $res->num_rows > 0){
            // source php will be included/copy-pasted here which means the $_SESSION variables above are accessible
            include $_SESSION['account_type'].'.php';
        }else{
            /**
             * 
             * todo: handle errors
             */
            // header('Location: ../index.php');

            echo 'hello';
        }
    }

?>
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
        $_SESSION['account_password'] = ($_POST['account_password']!='admin')?md5($_POST['account_password']):'admin';
        $_SESSION['open_tab'] = 'home'; // save current tab into this variable
    }
 

    // all "home" links should link to account.php NOT the admin.php, students.php and faculty.php

    if($_SESSION['account_id'] == 'admin' && $_SESSION['account_password'] == 'admin'){
        include 'home.php';
        // header('location: ./admin/home.php');
    }else{

        $account_query = "SELECT * FROM ".$_SESSION['account_type']." WHERE id=".$_SESSION['account_id']." AND deleted_at IS NULL AND password='".$_SESSION['account_password']."'";
        // echo $account_query;

        $res = $conn->query($account_query);
        $conn->close();

        if($res && $res->num_rows > 0){
            // source php will be included/copy-pasted here which means the $_SESSION variables above are accessible
            
            // CHANGE PASSWORD
            if(isset($_POST['submit_change_password'])){
                $query = "UPDATE ".$_SESSION['account_type']." SET password=".md5($_POST['new-pw']).", updated_at=now() WHERE id=".$_SESSION['account_id'];
                // echo $account_query;
        
                $res = $conn->query($query);
                $conn->close();
            }

            
            include $_SESSION['account_type'].'.php';
            // echo 'logged in';
        }else{
            /**
             * 
             * todo: handle errors
             */
            header('Location: ./index.php/?err=true');

            // echo 'hello';
        }
    }

?>
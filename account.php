<?php 

    include 'connect_to_db.php';
    session_start();

    if(isset($_POST['submit_login'])){
        $_SESSION['account_id'] = $_POST['account_id'];
        $_SESSION['account_type'] = $_POST['account_type'];
        $_SESSION['account_password'] = $_POST['account_password'];
        $_SESSION['open_tab'] = 'home'; // save current tab into this variable
    }


    // all "home" links should link to account.php NOT there source php

    if($_SESSION['account_id'] == 'admin' && $_SESSION['account_password'] == 'admin'){
        include 'admin.php';
    }else{
        $account_query = "SELECT * FROM ".$_SESSION['account_type']." WHERE id=".$_SESSION['account_id']." AND password='".$_SESSION['account_password']."'";
        $res = $conn->query($account_query);
        $conn->close();

        // echo $account_query;

        if($res && $res->num_rows > 0){

            // source php will be included/copy-pasted here which means the $_SESSION variables above are accessible
            include $_SESSION['account_type'].'.php';
        }else{
            header('Location: index.php/?err=1');
        }
    }

?>
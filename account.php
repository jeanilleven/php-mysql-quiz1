<?php 

    include 'connect_to_db.php';

    if(isset($_POST['submit_login'])){

        if($_POST['account_id'] == 'admin' && $_POST['account_password'] == 'admin'){
            include 'admin.php';
        }else{
            $account_query = "SELECT * FROM ".$_POST['account_type']." WHERE id=".$_POST['account_id']." AND password='".$_POST['account_password']."'";
            $res = $conn->query($account_query);
            $conn->close();

            echo $account_query;

            if($res && $res->num_rows > 0){
                include $_POST['account_type'].'.php';
            }else{
                header('Location: index.php/?err=1');
            }
        }

    }
?>
<?php 

    include 'connect_to_db.php';

    if(isset($_POST['submit_login'])){

        if($_POST['account_id'] == 'admin' && $_POST['account_password'] == 'admin'){
            include 'admin.php';
        }else{
            $res = $conn->query("SELECT * FROM students WHERE id=."$_POST['account_id']." && password='".$_POST['account_password']."'");

            if(!$res->num_rows > 0){
                
            }
        }
        

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <style>
        body {
            background: url(https://static.usc.edu.ph/metronic/assets/admin/pages/media/bg/1.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .card-header {
            border-bottom: 1px white solid;
            background-color: rgba(255, 255, 255, -0.2);
        }

        input, select {
            border-radius: 5px;
            border: none;
            height: 35px;
            padding-left: 5px;
            margin: 5px
        }

        #submit {
            
            height: 40px;
        }
    </style>
</head>
<body style="">
    <div class="container" style='text-align: center'>
            <img height="63"  width="480"src="./pics/nav-logo.png" alt="USC logo" class="mx-auto my-4 mt-5">
        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 mx-auto " style='text-align: left'>
            <div class="card p-2" style="border: none;">
                <div class="card-header pt-5" >
                    <h2 style='color: white; font-weight: 300;'>Login</h2>
                
                </div>
                <div class="card-body ">
                    <?php if(isset($_GET['err'])):?>
                        <?php if($_GET['err'] == true):?>
                            <p class='text-danger'>* account not found</p>
                        <?php endif ?>
                    <?php endif ?>
                    <form action=" 
                            <?php
                                if(isset($_GET['err'])){
                                    if($_GET['err'] == true){
                                        echo '../account.php';
                                    }
                                }else{
                                    echo './account.php';
                                }
                            ?>
                    " method="POST">
                        <div class="container">
                            <table class="col-lg-12 mt-4">
                                <!-- 
                                    /**
                                    *TODO: index.php/?err=1 fails when submiting form 
                                    */
                                 -->
                                <tr>
                                    <td class="pt-2"><label style='color:white; font-weight: 500;'for="account_type">Account Type</label></td>
                                    <td>
                                        <select name="account_type" id="account_type" class="ml-3 p-1">
                                            <option value="faculty">Faculty</option>
                                            <option value="students">Student</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='color:white; font-weight: 500;'class="pt-2"><label for="account_id">ID</label></td>
                                    <td><input id="account_id" name="account_id" type="text" class="ml-3"></td>
                                </tr>
                                <tr>
                                    <td style='color:white; font-weight: 500;'class="pt-2"><label for="account_password">Password</label></td>
                                    <td><input id="account_password" name="account_password" type="password" class="ml-3"></td>
                                </tr>
                                <tr>
                                    <td class="pt-2"></td>
                                    <td><input id="submit" type="submit" value="Login" name="submit_login" class="btn btn-secondary my-3 float-right"></td>
                                </tr>
                            </table>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
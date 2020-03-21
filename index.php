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

</head>
<body>
    <div class="container">
        <div class="col-lg-4 mx-auto mt-5">
            <div class="card">
                <div class="card-body">
                    <h1>Login</h1>
                    <?php if(isset($_GET['err'])):?>
                            <?php if($_GET['err'] == 1):?>
                                <p class='text-danger'>*account not found</p>
                            <?php endif ?>
                        <?php endif ?>
                    <form action="account.php" method="POST">
                        <div class="container">
                            <table class="col-lg-12 mt-4">
                                <tr>
                                    <td class="pt-2"><label for="account_type">Account Type</label></td>
                                    <td>
                                        <select name="account_type" id="account_type" class="ml-3 p-1">
                                            <option value="faculty">Faculty</option>
                                            <option value="students">Student</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-2"><label for="account_id">ID</label></td>
                                    <td><input id="account_id" name="account_id" type="text" class="ml-3"></td>
                                </tr>
                                <tr>
                                    <td class="pt-2"><label for="account_password">Password</label></td>
                                    <td><input id="account_password" name="account_password" type="text" class="ml-3"></td>
                                </tr>
                                <tr>
                                    <td class="pt-2"></td>
                                    <td><input type="submit" value="Login" name="submit_login" class="btn btn-primary my-3 float-right"></td>
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
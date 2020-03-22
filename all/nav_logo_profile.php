<nav id='header' style='background-color: #f8f9fa;'>
    <img id='navbar-pic' height='50' src='./pics/nav-logo.png' style='margin-left: 50px;'>
    <span  style='color:#07500b; ' class='dropdown'>
        <a style='box-shadow:none;'id='user-dropdown' class='btn btn-secondary dropdown-toggle' href='#' role='button' id='user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <img id='user-icon' style='border-radius: 50%; border: 1px solid gray;' src='./pics/man-icon.png' alt='icon'>
        <span style='color:#07500b; ' id='user-id'><?php echo sprintf("%08d", $_SESSION['account_id']) ?></span>
            </a>
                <span class='dropdown-menu' aria-labelledby='user-dropdown'>
            <a class='dropdown-item' data-toggle='modal' data-target='#change-pw-modal' type='button' style='cursor:pointer'>Change Password</a>
            <a class='dropdown-item' href='./account.php/?end=true'>Logout</a>
        </span>
    </span>
</nav>

<!-- CHANGE PASSWORD MODAL -->
<div class='modal fade' id='change-pw-modal' tabindex='-1' role='dialog' aria-labelledby='change-pw-moda' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id=''>Change Password</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
            <form>
                <div class='input-group mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text' id='old_pw'><i class='fas fa-lock'></i></span>
                </div>
                <input name='old-pw' type='password' class='form-control' placeholder='Old Password' aria-label='Old Password' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text' id='old_pw'><i class='fas fa-lock'></i></span>
                </div>
                <input name='new-pw' type='password' class='form-control' placeholder='New Password' aria-label='pw1' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text' id='old_pw'><i class='fas fa-lock'></i></span>
                </div>
                <input name='pw2' type='password' class='form-control' placeholder='Confirm Password' aria-label='pw2' aria-describedby='basic-addon1'>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary'>Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$('#user-id').css("margin-bottom", "0.5rem");
$('#user-id').css("margin-top", "0.5rem");
$('#user-id').css("margin-left", "15px");

$('#user-dropdown').css("background-color", "#f8f9fa");
$('#user-dropdown').css("border", "none");

$('a').on("click", ()=>{
    $('this').css("background-color", "#a1a7ad");
})
</script>

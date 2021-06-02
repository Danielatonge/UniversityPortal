<!-- ---------- only 'admin' can use this page ----------------> 
<?php if($_SESSION['role'] != 'admin'):?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
        // if delete button is pressed (only an admin can do this)
        if(isset($_GET['del'])) {
            if($_SESSION['role'] == 'admin') {		
                $uid = mysqli_real_escape_string($con, $_GET['del']);
            
                $q = "DELETE FROM users WHERE user_id = $uid";
            
                $del_result = mysqli_query($con, $q);
                    
                $div_info   = confirmQuery($del_result, 'delete');
                $div_class 	= $div_info['div_class'];
                $div_msg 	= $div_info['div_msg'];
            }
        }
?>	
<?php
	// display an alert message from result of $_GET or $_POST;
	// this row is not displayed if both $_GET and $_POST are not set
	if(isset($div_msg)):?>
        <div class="col-md-12">
            <div class="alert alert-<?php echo $div_class;?>">
                <?php echo $div_msg;?>
            </div>
        </div>
<?php endif; ?>
    <div class="section-top-border col-lg-12 col-md-12">
    <a href="admin-admin.php?source=add_admin" 
    class="genric-btn primary radius mb-10" role="button">Add Admin</a>
        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">#</div>
                    <div class="visit">Username</div>
                    <div class="visit">Email</div>
                    <div class="visit">Phone</div>
                    <div class="visit">Image</div>
                    <div class="visit">Reg. Date</div>
                    <div class="country">Actions</div>
                </div>
                <?php
                    $q =    "SELECT * FROM users
                            WHERE users.user_role = 'admin'
                            ORDER BY users.user_date DESC";

                    $users = mysqli_query($con, $q);
                ?>
                <?php foreach($users as $user):?>

                <div class="table-row">
                    <div class="serial"><?php echo $user['user_id'];?></div>
                    <div class="visit"><?php echo $user['user_uname'];?></div>
                    <div class="visit"><?php echo $user['user_email'];?></div>

                    <div class="visit"><?php echo $user['user_number'];?></div>
                    <div class="visit"> <img class="img-responsive" 
                        src="img/<?php echo $user['user_image'];?>" height="72px"	width="72px" alt="image">
                    </div>
                    <?php date_default_timezone_set(TZ); ?>
                    <div class="visit"><?php echo date('M. j, Y, g:i a', strtotime($user['user_date']));?></div>
                    <div class="country">
                        <a href="admin-admin.php?source=edit_admin&id=<?php echo $user['user_id'];?>" 
                        class="genric-btn primary circle small" role="button">Edit
                        </a>
                        <hr>
                        <a onclick="return confirm('Are you sure you want to delete this user?');" 
                        href="admin-admin.php?del=<?php echo $user['user_id'];?>" class="genric-btn danger circle small" role="button">
                        Delete
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endif; ?>
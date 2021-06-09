<!-- only 'Admin' can access this page -->
<?php if($_SESSION['role'] != 'admin'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add User' is submitted -------------------
            if(isset($_POST['add_student_submit'])) {
                // get all input data
                $user_uname				= mysqli_real_escape_string($con, $_POST['user_uname']);
                $user_number            = mysqli_real_escape_string($con, $_POST['user_number']);
                $user_email				= mysqli_real_escape_string($con, $_POST['user_email']);
                $group_id				= mysqli_real_escape_string($con, $_POST['group_id']);
                $user_email_val		    = filter_var($user_email, FILTER_VALIDATE_EMAIL);
                $user_pass				= mysqli_real_escape_string($con, $_POST['user_pass']);
                $user_image				= $_FILES['user_image']['name'];
                
                if($user_image == "") {
                    $user_image = 'default.jpg';
                }		
                
                $image_tmp = $_FILES['user_image']['tmp_name'];
                $user_role = 'student';
                
                // check if username is already in use in the users table
                $q = "SELECT users.user_uname FROM users 
                            WHERE user_uname = '$user_uname'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($user_uname) || empty($user_email) || empty($user_pass) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(!$user_email_val) {
                    $div_class = 'danger';
                    $div_msg = 'Please enter a valid email address.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that username is already in use. Please choose another.';
                } else { 
                    // encrypt password (see documentation on php.net)		
                    $options =['cost' => HASHCOST];
                    $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, $options);	
                            
                    move_uploaded_file($image_tmp, "img/$user_image");
                    
                    $q = "INSERT INTO users
                            (user_uname, user_pass, user_email, user_number, group_id,
                            user_image, user_role, user_date)
                            VALUES ('$user_uname', '$user_pass', '$user_email', '$user_number', '$group_id',
                            '$user_image', '$user_role', now())";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $user_uname = '';
                    $user_number = '';
                    $user_email = '';
                    $user_pass = '';
                }
            // start with a blank form
            } else {
                $user_uname = '';
                $user_number = '';
                $user_email = '';
                $user_pass = '';
            }
?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Add Student</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mt-10" name="user_uname" placeholder="Username"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" value="<?php echo $user_uname; ?>">

                <input type="phone" class="form-control mt-10" name="user_number" placeholder="Phone Number"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'" value="<?php echo $user_number; ?>">
                <input type="email" class="form-control mt-10" name="user_email" placeholder="Email Address"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" value="<?php echo $user_email; ?>">

                <?php   $q = "SELECT * FROM groups";
                        $groups = mysqli_query($con, $q);
                ?>
                <div class="">
                    <h5 class="mt-10 mb-10">Group</h5>
                    <div class="default-select" id="default-select">
                        <select name="group_id">
                            <?php foreach($groups as $group): ?>
                            <option value="<?= $group['group_id'] ?>"><?= $group['group_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="">
                    <h5>Upload Picture</h5>
                    <input type="file" name="user_image" placeholder="User Photo" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'User Photo'" class="single-input" value="<?php echo $user_image; ?>">
                </div>

                <input type="password" class="form-control mt-10" name="user_pass" placeholder="Password"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" value="<?php echo $user_pass; ?>">

                <button type="submit" name="add_student_submit" class="primary-btn text-uppercase mt-10">Add</button>
                <a href="admin-students.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>

        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'Admin' can access this page -->
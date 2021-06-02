<?php
            // -------------------- if 'Add User' is submitted -------------------
            if(isset($_POST['edit_student_submit'])) {
                $user_id = $_POST['user_id'];
                $user_uname				= mysqli_real_escape_string($con, $_POST['user_uname']);
                $user_number            = mysqli_real_escape_string($con, $_POST['user_number']);
                $user_email				= mysqli_real_escape_string($con, $_POST['user_email']);
                $user_email_val		    = filter_var($user_email, FILTER_VALIDATE_EMAIL);
                $user_pass				= mysqli_real_escape_string($con, $_POST['user_pass']);
                $user_image				= ""; //$_FILES['user_image']['name'];
                
                if($user_image == "") {
                    $user_image = 'default.jpg';
                }		
                
                $image_tmp = $_FILES['user_image']['tmp_name'];
                $user_role = 'student';
                
               if(empty($user_uname) || empty($user_email) || empty($user_pass) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(!$user_email_val) {
                    $div_class = 'danger';
                    $div_msg = 'Please enter a valid email address.';
                } else { 
                    // encrypt password (see documentation on php.net)		
                    $options =['cost' => HASHCOST];
                    $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, $options);	
                            
                    move_uploaded_file($image_tmp, "img/$user_image");
                    
                    $q = "UPDATE users SET user_uname = '$user_uname', user_pass = '$user_pass',
                        user_email = '$user_email', user_image = '$user_image', user_role = '$user_role'
                        WHERE user_id = $user_id";

                
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'update');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                }
            }
        ?>
        <?php
            // ---------- if there is a user to be edited from $_GET -------------
            if(isset($_GET['id'])) {

                $edit_user_id = mysqli_real_escape_string($con, $_GET['id']);
                
                $q = "SELECT * FROM users WHERE user_id = $edit_user_id";
                $result = mysqli_query($con, $q);
                $edit_user = mysqli_fetch_array($result);
                
                // this is a special case, so it does not user confirmQuery()
                // $div_msg may already exist, so don't overwrite it
                if(!$edit_user) {
                    $div_class = "danger";
                    $div_msg = "Database failed: ".mysqli_error($con);
                } elseif(empty($div_msg)) {
                    $div_class = "success";
                    $div_msg = 'User ready for edit.';
                }
            }
            
        ?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Edit Student</h3>

            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $edit_user['user_id'];?>">    
                <input type="text" class="form-control mt-10" name="user_uname" placeholder="Username"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" value="<?php echo $edit_user['user_uname']; ?>">

                <input type="phone" class="form-control mt-10" name="user_number" placeholder="Phone Number"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'" value="<?php echo $edit_user['user_number']; ?>">
                <input type="email" class="form-control mt-10" name="user_email" placeholder="Email Address"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" value="<?php echo $edit_user['user_email']; ?>">

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
                        onblur="this.placeholder = 'User Photo'" required class="single-input" >
                </div>

                <input type="password" class="form-control mt-10" name="user_pass" placeholder="Enter New Password"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter New Password'" >

                <button type="submit" name="edit_student_submit" class="primary-btn text-uppercase mt-10">Update</button>
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
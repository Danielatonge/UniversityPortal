<!-- only 'Admin' can access this page -->
<?php if($_SESSION['role'] != 'admin'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

        <?php
            // -------------------- if 'edit group' is submitted -------------------
            if(isset($_POST['edit_group_submit'])) {
                // get all input data
                $group_name				= mysqli_real_escape_string($con, $_POST['group_name']);
                
                
                // check if groupname is already in use in the groups table
                $q = "SELECT groups.group_name FROM groups 
                            WHERE group_name = '$group_name'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($group_name)) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that groupname is already in use. Please choose another.';
                } else { 
                    
                    $q = "INSERT INTO groups
                            (group_name)
                            VALUES ('$group_name')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $group_name = '';
                }
            }
        ?>

        <?php
            // ---------- if there is a group to be edited from $_GET -------------
            if(isset($_GET['id'])) {

                $edit_group_id = mysqli_real_escape_string($con, $_GET['id']);
                
                $q = "SELECT * FROM groups WHERE group_id = $edit_group_id";
                $result = mysqli_query($con, $q);
                $edit_group = mysqli_fetch_array($result);
                
                // this is a special case, so it does not group confirmQuery()
                // $div_msg may already exist, so don't overwrite it
                if(!$edit_group) {
                    $div_class = "danger";
                    $div_msg = "Database failed: ".mysqli_error($con);
                } elseif(empty($div_msg)) {
                    $div_class = "success";
                    $div_msg = 'group ready for edit.';
                }
            }
            
        ?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Edit group</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mt-10" name="group_name" placeholder="group Name"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'group Name'" value="<?php echo $edit_group['group_name']; ?>">
                <button type="submit" name="edit_group_submit" class="primary-btn text-uppercase mt-10">Edit</button>
                <a href="admin-groups.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
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
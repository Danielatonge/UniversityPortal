<!-- only 'Admin' can access this page -->
<?php if($_SESSION['role'] != 'teacher'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add grade' is submitted -------------------
            if(isset($_POST['add_grade_submit'])) {
                // get all input data
                $grade_title				= mysqli_real_escape_string($con, $_POST['grade_title']);
                $grade_preview           = mysqli_real_escape_string($con, $_POST['grade_preview']);
                $grade                   = mysqli_real_escape_string($con, $_POST['grade']);
                $grade_author            = mysqli_real_escape_string($con, $_POST['grade_author']);
                $grade_content            = mysqli_real_escape_string($con, $_POST['grade_message']);
                
                
                // check if gradetitle is already in use in the grades table
                $q = "SELECT grades.grade_title FROM grades 
                            WHERE grade_title = '$grade_title'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($grade_title) || empty($grade_preview) || empty($grade) || empty($grade_author) || empty($grade_content) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that gradetitle is already in use. Please choose another.';
                } else { 
                    
                    $q = "INSERT INTO grades
                            (grade_title, grade_preview)
                            VALUES ('$grade_title', '$grade_preview')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $grade_title = '';
                    $grade_preview = '';
                }
            // start with a blank form
            } else {
                $grade_title = '';
                $grade_preview = '';
            }
?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Add grade</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mt-10" title="grade_title" placeholder="grade title"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'grade title'" value="<?php echo $grade_title; ?>">
                <input type="text" class="form-control mt-10" title="grade_preview" placeholder="grade Instructor"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'grade Instructor'" value="<?php echo $grade_preview; ?>">
                <button type="submit" title="add_grade_submit" class="primary-btn text-uppercase mt-10">Add</button>
                <a href="admin-grades.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'Teachers' can access this page -->
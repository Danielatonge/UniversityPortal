<!-- only 'Admin' can access this page -->
<?php if($_SESSION['role'] != 'admin'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add course' is submitted -------------------
            if(isset($_POST['add_course_submit'])) {
                // get all input data
                $course_name				= mysqli_real_escape_string($con, $_POST['course_name']);
                $course_teacher            = mysqli_real_escape_string($con, $_POST['user_id']);
                
                
                // check if coursename is already in use in the courses table
                $q = "SELECT courses.course_name FROM courses 
                            WHERE course_name = '$course_name'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($course_name) || empty($course_teacher) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that coursename is already in use. Please choose another.';
                } else { 
                    
                    $q = "INSERT INTO courses (course_name, user_id)
                            VALUES ('$course_name', '$course_teacher')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $course_name = '';
                    $course_teacher = '';
                }
            // start with a blank form
            } else {
                $course_name = '';
                $course_teacher = '';
            }
?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Add Course</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mt-10" name="course_name" placeholder="Course Name"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Course Name'" value="<?php echo $course_name; ?>">
                
                <?php   $q = "SELECT * FROM users WHERE user_role = 'teacher'";
                        $teachers = mysqli_query($con, $q);
                ?>
                <div class="">
                    <h5 class="mt-10 mb-10">Instructor</h5>
                    <div class="default-select" id="default-select">
                        <select name="user_id">
                            <?php foreach($teachers as $teacher): ?>
                            <option value="<?= $teacher['user_id'] ?>"><?= $teacher['user_uname'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <button type="submit" name="add_course_submit" class="primary-btn text-uppercase mt-10">Add</button>
                <a href="admin-courses.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
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
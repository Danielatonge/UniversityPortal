<!-- only 'course' can access this page -->
<?php if($_SESSION['role'] != 'teacher'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add test' is submitted -------------------
            if(isset($_POST['add_test_submit'])) {
                // get all input data
                $test_name				= mysqli_real_escape_string($con, $_POST['test_name']);
                $test_course            = mysqli_real_escape_string($con, $_POST['course_id']);
                
                
                // check if testname is already in use in the tests table
                $q = "SELECT tests.test_name FROM tests 
                            WHERE test_name = '$test_name'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($test_name) || empty($test_course) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that testname is already in use. Please choose another.';
                } else { 
                    
                    $q = "INSERT INTO tests (test_name, course_id)
                            VALUES ('$test_name', '$test_course')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $test_name = '';
                    $test_course = '';
                }
            // start with a blank form
            } else {
                $test_name = '';
                $test_course = '';
            }
?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Add Test</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mt-10" name="test_name" placeholder="Test Name"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Test Name'" value="<?php echo $test_name; ?>">
                
                <?php   $q = "SELECT * FROM courses";
                        $courses = mysqli_query($con, $q);
                ?>
                <div class="">
                    <h5 class="mt-10 mb-10">Course</h5>
                    <div class="default-select" id="default-select">
                        <select name="course_id">
                            <?php foreach($courses as $course): ?>
                            <option value="<?= $course['course_id'] ?>"><?= $course['course_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <button type="submit" name="add_test_submit" class="primary-btn text-uppercase mt-10">Add</button>
                <a href="teacher-tests.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'course' can access this page -->
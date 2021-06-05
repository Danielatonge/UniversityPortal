<!-- only 'teacher' can access this page -->
<?php if($_SESSION['role'] != 'teacher'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

        <?php
            // -------------------- if 'edit test' is submitted -------------------
            if(isset($_POST['edit_test_submit'])) {
                // get all input data
                $test_id = $_POST['test_id'];
                $test_name				= mysqli_real_escape_string($con, $_POST['test_name']);
                $test_course            = mysqli_real_escape_string($con, $_POST['course_id']);
                
                
              
                if(empty($test_name) || empty($test_course) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } else { 
                    
                    $q = "UPDATE tests SET test_name = '$test_name', course_id = '$test_course' WHERE test_id = $test_id";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $test_name = '';
                    $test_course = '';
                }
            }
        ?>
        <?php
            // ---------- if there is a test to be edited from $_GET -------------
            if(isset($_GET['id'])) {

                $edit_test_id = mysqli_real_escape_string($con, $_GET['id']);
                
                $q = "SELECT * FROM tests WHERE test_id = $edit_test_id";
                $result = mysqli_query($con, $q);
                $edit_test = mysqli_fetch_array($result);
                
                // this is a special case, so it does not test confirmQuery()
                // $div_msg may already exist, so don't overwrite it
                if(!$edit_test) {
                    $div_class = "danger";
                    $div_msg = "Database failed: ".mysqli_error($con);
                } elseif(empty($div_msg)) {
                    $div_class = "success";
                    $div_msg = 'test ready for edit.';
                }
            }
            
        ?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Edit Test</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="test_id" value="<?php echo $edit_test['test_id'];?>"> 
                <input type="text" class="form-control mt-10" name="test_name" placeholder="Test Name"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Test Name'" value="<?php echo $edit_test['test_name']; ?>">
                                
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
                <button type="submit" name="edit_test_submit" class="primary-btn text-uppercase mt-10">Update</button>
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
<?php endif; ?>   <!-- only 'teacher' can access this page -->
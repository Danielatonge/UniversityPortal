<!-- only 'grade' can access this page -->
<?php if($_SESSION['role'] != 'teacher'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php       

            // -------------------- if 'Add grade' is submitted -------------------
            if(isset($_POST['edit_grade_submit'])) {
                // get all input data
                $grade_id = $_POST['grade_id'];
                $grade_practical				= mysqli_real_escape_string($con, $_POST['grade_practical']);
                $grade_theory            = mysqli_real_escape_string($con, $_POST['grade_theory']);
                
                
                if(empty($grade_theory) || empty($grade_practical) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } else { 
                    $total = ($grade_practical + $grade_theory);
                    $q = "UPDATE grades SET grade_theory = '$grade_theory', grade_practical = '$grade_practical',
                     grade_result = '$total' WHERE grade_id = $grade_id";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'update');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                }
            }
?>
        <?php
            // ---------- if there is a grade to be edited from $_GET -------------
            if(isset($_GET['grade_id'])) {

                $edit_grade_id = mysqli_real_escape_string($con, $_GET['grade_id']);
                
                $q = "SELECT * FROM grades WHERE grade_id = $edit_grade_id";
                $result = mysqli_query($con, $q);
                $edit_grade = mysqli_fetch_array($result);
                
                // this is a special case, so it does not grade confirmQuery()
                // $div_msg may already exist, so don't overwrite it
                if(!$edit_grade) {
                    $div_class = "danger";
                    $div_msg = "Database failed: ".mysqli_error($con);
                } elseif(empty($div_msg)) {
                    $div_class = "success";
                    $div_msg = 'grade ready for edit.';
                }
            }
            
        ?>
        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Edit grade</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="grade_id" value="<?php echo $edit_grade['grade_id'];?>">
                
                <div class="mt-10">
                    <h5>Practical:</h5>
                    <input type="text" name="grade_practical" class="single-input" value="<?php echo $edit_grade['grade_practical']; ?>">
                </div>
                <div class="mt-10">
                    <h5>Theory:</h5>
                    <input type="text" name="grade_theory" class="single-input" value="<?php echo $edit_grade['grade_theory']; ?>">
                </div>
                <button type="submit" name="edit_grade_submit" class="primary-btn text-uppercase mt-10">Update</button>
                <a href="teacher-grades.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'grade' can access this page -->
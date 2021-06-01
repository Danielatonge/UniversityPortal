<!-- ---------- only 'admin' can use this page ----------------> 
<?php if($_SESSION['role'] != 'admin'):?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
        // if delete button is pressed (only an admin can do this)
        if(isset($_GET['del'])) {
            if($_SESSION['role'] == 'admin') {		
                $uid = mysqli_real_escape_string($con, $_GET['del']);
            
                $q = "DELETE FROM courses WHERE course_id = $uid";
            
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
    <a href="admin-courses.php?source=add_course" 
    class="genric-btn primary radius mb-10" role="button">Add Course</a>
        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">#</div>
                    <div class="visit">Course Name</div>
                    <div class="visit">Course Instructor</div>
                    <div class="country">Actions</div>
                </div>
                <?php
                    $q =    "SELECT * FROM courses";

                    $courses = mysqli_query($con, $q);
                ?>
                <?php foreach($courses as $course):?>

                <div class="table-row">
                    <div class="serial"><?php echo $course['course_id'];?></div>
                    <div class="visit"><?php echo $course['course_name'];?></div>
                    <div class="visit"><?php echo $course['course_teacher'];?></div>
                    <div class="country">
                        <a href="admin-courses.php?source=edit_course&id=<?php echo $course['course_id'];?>" 
                        class="genric-btn primary circle small" role="button">Edit
                        </a>
                        <hr>
                        <a onclick="return confirm('Are you sure you want to delete this course?');" 
                        href="admin-courses.php?del=<?php echo $course['course_id'];?>" class="genric-btn danger circle small" role="button">
                        Delete
                        </a>
                    </div>
                </div>
                
                <?php endforeach;?>

            </div>
        </div>
    </div>

<?php endif; ?>

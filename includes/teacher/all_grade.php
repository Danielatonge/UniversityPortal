<!-- ---------- only 'teacher' can use this page ----------------> 
<?php if($_SESSION['role'] != 'teacher'):?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

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
        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">#</div>
                    <div class="visit">Name</div>
                    <div class="visit">Course</div>
                    <div class="visit">Practical Part</div>
                    <div class="visit">Theoritical Part</div>
                    <div class="visit">Total Points</div>
                    <div class="visit">Result</div>
                    <div class="visit">Actions</div>
                </div>
                <?php
                    $q =    "SELECT grades.grade_id, grades.grade_practical, grades.grade_theory, 
                            grades.grade_result, users.user_uname, courses.course_name FROM 
                            ((grades INNER JOIN users ON grades.user_id = users.user_id) 
                            INNER JOIN courses ON grades.course_id = courses.course_id)";
                    $grades = mysqli_query($con, $q);
                ?>
                <?php foreach($grades as $grade):?>

                <div class="table-row">
                    <div class="serial"><?php echo $grade['grade_id'];?></div>
                    <div class="visit"><?php echo $grade['user_uname'];?></div>
                    <div class="visit"><?php echo $grade['course_name'];?></div>
                    <div class="visit"><?php echo $grade['grade_practical'];?></div>
                    <div class="visit"><?php echo $grade['grade_theory'];?></div>
                    <div class="visit"><?php echo $grade['grade_result'];?></div>
                    <div class="visit"><?php if($grade['grade_result'] >= 50) { echo "Passed";} else {echo "Not Passed"; } ?></div>
                    <div class="visit">
                        <a href="teacher-grades.php?source=edit_grade&grade_id=<?php echo $grade['grade_id'];?>" 
                        class="genric-btn primary circle small" role="button">Edit
                        </a>
                    </div>
                </div>
                
                <?php endforeach;?>

            </div>
        </div>
    </div>

<?php endif; ?>

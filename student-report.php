<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <!-- ---------- only 'teacher' can use this page ----------------> 
<?php if($_SESSION['role'] != 'student'):?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>



            <div class="section-top-border col-lg-12 col-md-12">
                <div class="progress-table-wrap">
                    <div class="progress-table">
                        <div class="table-head">
                            <div class="serial">#</div>
                            <div class="visit">Course</div>
                            <div class="visit">Practical Part</div>
                            <div class="visit">Theoritical Part</div>
                            
                            <div class="visit">Total Points</div>
                            <div class="visit">Teacher</div>
                            <div class="visit">Result</div>
                        </div>
                        <?php
                            $user_id = $_SESSION['userid'];
                            $q =    "SELECT grades.grade_id, grades.grade_practical, grades.grade_theory, 
                                    grades.grade_result, courses.course_name, users.user_uname FROM 
                                    ((courses INNER JOIN grades ON grades.course_id = courses.course_id) 
                                    INNER JOIN users ON courses.user_id = users.user_id) WHERE grades.user_id = $user_id";
                            $grades = mysqli_query($con, $q);
                        ?>
                        <?php foreach($grades as $grade):?>
                        <div class="table-row">
                            <div class="serial"><?php echo $grade['grade_id'];?></div>
                            <div class="visit"><?php echo $grade['course_name'];?></div>
                            
                            <div class="visit"><?php echo $grade['grade_practical'];?></div>
                            <div class="visit"><?php echo $grade['grade_theory'];?></div>
                            <div class="visit"><?php echo $grade['grade_result'];?></div>
                            <div class="visit"><?php echo $grade['user_uname'];?></div>
                            <div class="visit">
                                <?php 
                                    if($grade['grade_result'] >= 90) { 
                                        echo "Excellent";
                                    } elseif($grade['grade_result'] >= 75) {
                                        echo "Good"; 
                                    } elseif($grade['grade_result'] >= 50) {
                                        echo "Passed";
                                    } else {
                                        echo "Not Passed";
                                    }
                                ?>
                        
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h3 class="mb-30">Add Course</h3>
                        <form class="form-wrap" action="#">
                            <input type="text" class="form-control mt-10" name="course_name" placeholder="Course Name"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Course Name'">
                            <input type="text" class="form-control mt-10" name="course_teacher" placeholder="Course Instructor"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Course Instructor'">
                            <button class="primary-btn text-uppercase mt-10">Add</button>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h4><a href="">Manage Courses</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
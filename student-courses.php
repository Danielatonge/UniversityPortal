<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <section class="blog-area section-gap" id="blog">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">List of Courses</h1>
                        <p> Here is a list of your courses</p>
                    </div>
                </div>
            </div>
            <?php 
                $q =    "SELECT courses.course_id, courses.course_image, courses.course_name,
                    courses.course_overview, users.user_uname FROM courses INNER JOIN users ON courses.user_id = users.user_id";
                $courses = mysqli_query($con, $q);
            ?>
            <div class="row">
            <?php foreach($courses as $course): ?>
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="img/<?= $course['course_image'];?>" alt="">
                    </div>
                    <p class="meta">By <?= $course['user_uname'];?></p>
                    <a href="course-details.php?course_id=<?= $course['course_id']; ?>">
                        <h5><?= $course['course_name'];?></h5>
                    </a>
                    <p><?= $course['course_overview'];?></p>
                   
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </section>


    <?php include "includes/footer.php"; ?>
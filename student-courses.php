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
                $q =    "SELECT * FROM courses";
                $courses = mysqli_query($con, $q);
            ?>
            <div class="row">
            <?php foreach($courses as $course): ?>
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="img/<?= $course['course_image'];?>" alt="">
                    </div>
                    <p class="meta">By <?= $course['user_id'];?></p>
                    <a href="course-details.php?course_id=<?= $course['course_id']; ?>">
                        <h5><?= $course['course_name'];?></h5>
                    </a>
                    <p><?= $course['course_overview'];?></p>
                   
                </div>
            <?php endforeach; ?>
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="img/xb2.jpg.pagespeed.ic.QjexspYIft.jpg" alt="">
                    </div>
                    <p class="meta">25 April, 2018 | By <a href="#">Mark Wiens</a></p>
                    <a href="course-details.php">
                        <h5>Computer Hardware Desktops And Notebooks</h5>
                    </a>
                    <p>
                        Ah, the technical interview. Nothing like it. Not only does it cause anxiety, but it causes
                        anxiety for several different reasons.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <?php include "includes/footer.php"; ?>
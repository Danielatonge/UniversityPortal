<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <?php 
        if(isset($_GET['course_id'])) { $course_id = $_GET['course_id']; }
        $q = "SELECT * FROM courses WHERE course_id = '$course_id'";
        $result = mysqli_query($con, $q);
        $course = mysqli_fetch_array($result);
    ?>
    <section class="course-details-area pt-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 left-contents">
                    <div class="main-image">
                        <img class="img-fluid" src="img/<?= $course['course_image']; ?>" alt="">
                    </div>
                    <div class="jq-tab-wrapper" id="horizontalTabOne">
                        <div class="jq-tab-menu">
                            <div class="jq-tab-title active" data-tab="1">Course Overview</div>
                        </div>
                        <div class="jq-tab-content-wrapper">
                            <h4><?= $course['course_name']; ?></h4>
                            <div class="jq-tab-content active" data-tab="1"><?= $course['course_overview']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Professor’s Name</p>
                                <span class="or"><?= $course['user_id']; ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Schedule </p>
                                <span>2.00 pm to 4.00 pm</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="post-content-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Test</h1>
                        <p>Attempt test</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-4  col-md-4 meta-details">
                            <div class="user-details row">
                                <p class="date col-lg-12 col-md-12 col-6"><a href="#">Start: 9:30am 12/12/2017</a> <span
                                        class="lnr lnr-calendar-full"></span></p>
                                <p class="date col-lg-12 col-md-12 col-6"><a href="#">End: 9:30pm 12/12/2017</a> <span
                                        class="lnr lnr-calendar-full"></span></p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 ">
                            <a class="posts-title" href="blog-single.php">
                                <h3>Astronomy Binoculars A Great Alternative</h3>
                            </a>
                            <p class="excert">
                                MCSE boot camps have its supporters and its detractors. Some people do not understand
                                why you should have to spend money on boot camp when you can get the MCSE study
                                materials yourself at a fraction.
                            </p>
                            <a href="course-test.php" class="primary-btn">Take</a>
                        </div>
                    </div>
                    <div class="single-post row">
                        <div class="col-lg-4  col-md-4 meta-details">
                            <div class="user-details row">
                                
                                <p class="date col-lg-12 col-md-12 col-6"><a href="#">Start: 9:30am 12/12/2017</a> <span
                                        class="lnr lnr-calendar-full"></span></p>
                                <p class="date col-lg-12 col-md-12 col-6"><a href="#">End: 9:30pm 12/12/2017</a> <span
                                        class="lnr lnr-calendar-full"></span></p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 ">
                            <a class="posts-title" href="blog-single.php">
                                <h3>Astronomy Binoculars A Great Alternative</h3>
                            </a>
                            <p class="excert">
                                MCSE boot camps have its supporters and its detractors. Some people do not understand
                                why you should have to spend money on boot camp when you can get the MCSE study
                                materials yourself at a fraction.
                            </p>
                            <a href="course-test.php" class="primary-btn">Take</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include "includes/footer.php"; ?>
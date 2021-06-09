<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <?php 
        if(isset($_GET['course_id'])) { $course_id = $_GET['course_id']; }
        $q = "SELECT courses.course_id, courses.course_image, courses.course_name,
        courses.course_overview, users.user_uname, users.user_email FROM courses INNER JOIN users ON courses.user_id = users.user_id WHERE course_id = '$course_id'";
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
                            <div class="jq-tab-content active" data-tab="1"><?= $course['course_overview']; ?>
                            "Cooper," whose scientific name is Australotitan cooperensis, is estimated to have walked the Earth over 90 million years ago. It was a titanosaur -- a plant-eating species belonging to the family of long-necked sauropods, the largest of the dinosaur species.
The dinosaur is estimated to have reached a height of 5 to 6.5 meters (16.4 to 21.3 feet) at the hip, and a length of 25 to 30 meters (82 to 98.4 feet) -- making it as long as a basketball court and as tall as a two-story building, the ENHM said.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Professor’s Name</p>
                                <span class="or"><?= $course['user_uname']; ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>E-mail </p>
                                <span><?= $course['user_email']; ?></span>
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
            <?php 
                $q =    "SELECT * FROM tests";
                $tests = mysqli_query($con, $q);
            ?>
            <div class="row">
                <div class="col-lg-12 posts-list">
                    <?php foreach($tests as $test): ?>
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
                            <div class="posts-title">
                                <h3><?= $test['test_name'];?></h3>
                            </div>
                            <p class="excert"><?= $test['test_content'];?></p>
                            <a href="course-test.php?test_id=<?= $test['test_id'];?>" class="primary-btn">Take</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <?php include "includes/footer.php"; ?>
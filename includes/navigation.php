<?php $role = 3; ?>

<body>
    <header id="header">
        <div class="container main-menu">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php"><img src="img/xlogo.png.pagespeed.ic.IkdGzsW_qc.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    <?php if($role == 1): ?>
                        <li><a href="student-courses.php">Courses</a></li>
                        <li><a href="student-report.php">Report</a></li>
                        <li><a href="student-news.php">News</a></li>
                        <li><a href="student-library.php">Library</a></li>
                        
                    <?php elseif($role == 2): ?>
                        <li><a href="teacher-books.php">Books</a></li>
                        <li><a href="teacher-test.php">Test</a></li>
                        <li><a href="teacher-lectures.php">Lectures</a></li>
                        <li><a href="teacher-grades.php">Grades</a></li>
                    <?php elseif($role == 3): ?>
                        <li><a href="admin-admin.php">Admin</a></li>
                        <li><a href="admin-students.php">Students</a></li>
                        <li><a href="admin-groups.php">Groups</a></li>
                        <li><a href="admin-courses.php">Courses</a></li>
                        <li><a href="admin-teachers.php">Teachers</a></li>
                        <li><a href="admin-news.php">News</a></li>
                    <?php endif; ?>

                        <li>Username (<a href="logout.php">Logout</a>)</li>

                    </ul>
                </nav>
            </div>
        </div>
    </header>



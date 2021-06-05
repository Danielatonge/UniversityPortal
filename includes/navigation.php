

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
                    <?php if($_SESSION['role'] == 'student'): ?>
                        <li><a href="student-courses.php">Courses</a></li>
                        <li><a href="student-report.php">Report</a></li>
                        <li><a href="student-news.php">News</a></li>
                        <li><a href="student-library.php">Library</a></li>
                        
                    <?php elseif($_SESSION['role'] == 'teacher'): ?>
                        <li><a href="teacher-books.php">Books</a></li>
                        <li><a href="teacher-tests.php">Test</a></li>
                        <li><a href="teacher-lectures.php">Lectures</a></li>
                        <li><a href="teacher-grades.php">Grades</a></li>
                    <?php elseif($_SESSION['role'] == 'admin'): ?>
                        <li><a href="admin-admin.php">Admin</a></li>
                        <li><a href="admin-students.php">Students</a></li>
                        <li><a href="admin-groups.php">Groups</a></li>
                        <li><a href="admin-courses.php">Courses</a></li>
                        <li><a href="admin-teachers.php">Teachers</a></li>
                        <li><a href="admin-news.php">News</a></li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['userid'])): ?>
                        <li><?php echo $_SESSION['username']; ?> (<a href="includes/logout.php">Logout</a>)</li>
                    <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>



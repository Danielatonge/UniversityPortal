<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">

                <?php 
                    if(isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch($source) {
                        case 'add_lecture':
                            include 'includes/teacher/add_lecture.php';
                            break;
                        case 'edit_lecture':
                            include 'includes/teacher/edit_lecture.php';
                            break;
                        default:
                            include 'includes/teacher/all_lecture.php';
                    } 
                ?>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
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
                        case 'add_course':
                            include 'includes/admin/add_course.php';
                            break;
                        case 'edit_course':
                            include 'includes/admin/edit_course.php';
                            break;
                        default:
                            include 'includes/admin/all_course.php';
                    } 
                ?>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
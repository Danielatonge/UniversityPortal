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
                        case 'edit_grade':
                            include 'includes/teacher/edit_grade.php';
                            break;
                        default:
                            include 'includes/teacher/all_grade.php';
                    } 
                ?>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
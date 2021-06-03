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
                        case 'add_book':
                            include 'includes/teacher/add_book.php';
                            break;
                        case 'edit_book':
                            include 'includes/teacher/edit_book.php';
                            break;
                        default:
                            include 'includes/teacher/all_book.php';
                    } 
                ?>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
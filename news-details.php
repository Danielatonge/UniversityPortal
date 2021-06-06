<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <?php 
        if(isset($_GET['news_id'])) { $news_id = $_GET['news_id']; }
        $q = "SELECT * FROM news WHERE news_id = '$news_id'";
        $result = mysqli_query($con, $q);
        $news = mysqli_fetch_array($result);
    ?>
    <section class="event-details-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 event-details-left">
                    <div class="main-img">
                        <img class="img-fluid" src="img/<?= $news['news_image']; ?>" alt="">
                    </div>
                    <div class="details-content">
                        <p class="mt-10"><?= $news['news_date']; ?></p>
                        <a href="#">
                            <h4><?= $news['news_title']; ?></h4>
                        </a>
                        <p><?= $news['news_content']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include "includes/footer.php"; ?>
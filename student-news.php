<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>


    <?php 
        $q =    "SELECT * FROM news";
        $newss = mysqli_query($con, $q);
    ?>
    <section class="events-list-area section-gap event-page-lists">
        <div class="container">
            <div class="row align-items-center">
                <?php foreach($newss as $news): ?>
                    <div class="col-lg-6 pb-30">
                        <div class="single-carusel row align-items-center">
                            <div class="col-12 col-md-6 thumb">
                                <img class="img-fluid" src="img/<?php echo $news['news_image']; ?>" alt="">
                            </div>
                            <div class="detials col-12 col-md-6">
                                <p><?php echo date('M. j, Y, g:i a', strtotime($news['news_date'])); ?></p>
                                <a href="news-details.php?news_id=<?= $news['news_id'];?>">
                                    <h4><?php echo $news['news_title']; ?></h4>
                                </a>
                                <p> <?php echo substr($news['news_content'], 0, 150) . "..."; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <?php include "includes/footer.php"; ?>
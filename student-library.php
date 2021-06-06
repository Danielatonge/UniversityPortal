<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <?php 
        $q =    "SELECT * FROM books";
        $books = mysqli_query($con, $q);
    ?>
    <section class="blog-area section-gap" id="blog">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">List of Books</h1>
                        <p> Welcome to the online Library</p>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php foreach($books as $book): ?>
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="img/<?= $book['book_preview']?>" alt="">
                    </div>
                    <p class="meta">By <?= $book['book_author']?></p>
                    <h5><?= $book['book_title']?></h5>
                    <p><?= $book['book_note']?></p>
                    <a href="files/<?= $book['book']?>" class="details-btn d-flex justify-content-center align-items-center"><span
                        class="details" download>Download</span><span class="lnr lnr-arrow-right"></span></a>
                </div>
            <?php endforeach; ?>          
            </div>
        </div>
    </section>


    <?php include "includes/footer.php"; ?>
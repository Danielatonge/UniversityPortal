<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h3 class="mb-30">Add News</h3>
                        <form action="#">
                            <div class="mt-10">
                                <input type="text" name="news_title" placeholder="News Title"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'News Title'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="file" name="news_image" placeholder="News Photo" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'News Photo'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <textarea class="single-textarea" name="news_content" placeholder="Content" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Content'" required></textarea>
                            </div>
                            <div class="mt-10 text-right">
                                <a href="#" class="genric-btn primary radius">Add</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h4><a href="">Manage News</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
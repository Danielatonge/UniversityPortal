<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h3 class="mb-30">Add Book</h3>
                        <form action="#">
                            <div class="mt-10">
                                <input type="text" name="book_title" placeholder="Book Title"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Book Title'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="file" name="book_preview" placeholder="Picture Preview"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Picture Preview'"
                                    required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="file" name="book" placeholder="Book" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Book'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="book_author" placeholder="Author"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Author'" required
                                    class="single-input">
                            </div>

                            <div class="mt-10">
                                <textarea class="single-textarea" name="book_message" placeholder="Message" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Message'" required></textarea>
                            </div>
                            <div class="mt-10 text-right">
                                <a href="#" class="genric-btn primary radius">Add</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include "includes/footer.php"; ?>
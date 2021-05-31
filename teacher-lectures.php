<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h3 class="mb-30">Add Lecture</h3>
                        <form action="#">
                            <div class="mt-10">
                                <input type="text" name="lecture_name" placeholder="Lecture Name"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lecture Name'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="file" name="lecture_file" placeholder="Lecture File" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Lecture File'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <textarea class="single-textarea" placeholder="Message" onfocus="this.placeholder = ''"
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
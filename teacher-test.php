<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h3 class="mb-30">Create Test</h3>
                        <form action="#">
                            <div class="mt-10">
                                <input type="text" name="test_name" placeholder="Test Name"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Test Name'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="group_name" placeholder="Group Name"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Group Name'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10 text-right">
                                <a href="#" class="genric-btn primary radius">Create</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include "includes/footer.php"; ?>
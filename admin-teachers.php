<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <h3 class="mb-30">Add Teacher</h3>
                        <form class="form-wrap" action="#">
                            <input type="text" class="form-control mt-10" name="name" placeholder="Username"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                            <input type="phone" class="form-control mt-10" name="phone" placeholder="Phone Number"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'">
                            <input type="email" class="form-control mt-10" name="email" placeholder="Email Address"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">

                            <div class="">
                                <h5 class="mt-10 mb-10">Course</h5>
                                <div class="default-select" id="default-select">
                                    <select>
                                        <option value="1">Maths</option>
                                        <option value="1">Physics</option>
                                        <option value="1">Drawing</option>
                                        <option value="1">Computer</option>
                                    </select>
                                </div>
                            </div>

                            <input type="password" class="form-control mt-10" name="password" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">

                            <button class="primary-btn text-uppercase mt-10">Add</button>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h4><a href="">Manage Teacher</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
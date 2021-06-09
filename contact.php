<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php
            // -------------------- if 'Add contact' is submitted -------------------
            if(isset($_POST['add_contact'])) {
                // get all input data
                $contact_name				= mysqli_real_escape_string($con, $_POST['name']);
                $contact_email              = mysqli_real_escape_string($con, $_POST['email']);
                $contact_subject              = mysqli_real_escape_string($con, $_POST['subject']);
                $contact_content            = mysqli_real_escape_string($con, $_POST['message']);
                
                
                if(empty($contact_name) || empty($contact_email) || empty($contact_content) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                }else { 
                    
                    $q = "INSERT INTO contact (contact_name, contact_email, contact_subject, contact_content)
                            VALUES ('$contact_name', '$contact_email', '$contact_subject', '$contact_content')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $contact_name = "";
                    $contact_email = "";
                    $contact_subject = "";
                    $contact_content = "";
                }
            // start with a blank form
            } else {
                $contact_name = "";
                $contact_email = "";
                $contact_subject = "";
                $contact_content = "";
            }
?>


    <section class="contact-page-area section-gap">
        <div class="container">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="col-lg-4 d-flex flex-column address-wrap">
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-home"></span>
                        </div>
                        <div class="contact-details">
                            <h5>Kazan, Russia</h5>
                            <p>
                                Bolshaya krasnaya 55b
                            </p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-phone-handset"></span>
                        </div>
                        <div class="contact-details">
                            <h5>+7 (999) 169 48 83</h5>
                            <p>Weekdays</p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-envelope"></span>
                        </div>
                        <div class="contact-details">
                            <h5>royalediamond7@gmail.com</h5>
                            <p>Drop a mail anytime!</p>
                        </div>
                    </div>
                </div>
                    <form class="form-area contact-form text-right" id="myForm"
                        action="" method="post">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter your name'"
                                    class="common-input mb-20 form-control" required type="text">
                                <input name="email" placeholder="Enter email address"
                                    pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"
                                    class="common-input mb-20 form-control" required type="email">
                                <input name="subject" placeholder="Enter subject" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter subject'" class="common-input mb-20 form-control"
                                    required type="text">
                            </div>
                            <div class="col-lg-6 form-group">
                                <textarea class="common-textarea form-control" name="message"
                                    placeholder="Enter Message" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter Message'" required></textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="alert-msg" style="text-align: left;"></div>
                                <button name="add_contact" class="genric-btn primary" style="float: right;">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include "includes/footer.php"; ?>
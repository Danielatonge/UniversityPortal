<!-- only 'Admin' can access this page -->
<?php if($_SESSION['role'] != 'admin'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add news' is submitted -------------------
            if(isset($_POST['add_news_submit'])) {
                // get all input data
                $news_title				= mysqli_real_escape_string($con, $_POST['news_title']);
                $news_image            = $_FILES['news_image']['name'];
                $news_content            = mysqli_real_escape_string($con, $_POST['news_content']);
                
                if($news_image != "") { 
                    $image_tmp = $_FILES['news_image']['tmp_name']; 
                    move_uploaded_file($image_tmp, "img/$news_image");
                }
                // check if newstitle is already in use in the news table
                $q = "SELECT news.news_title FROM news 
                            WHERE news_title = '$news_title'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($news_title) || empty($news_content) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that newstitle is already in use. Please choose another.';
                } else { 
                    
                    $q = "INSERT INTO news (news_date, news_title, news_content, news_image)
                            VALUES ( now(), '$news_title', '$news_content','$news_image')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $news_title = '';
                    $news_image = '';
                    $news_content = '';
                }
            // start with a blank form
            } else {
                $news_title = '';
                $news_image = '';
                $news_content = '';
            }
?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Add news</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <div class="mt-10">
                    <input type="text" name="news_title" placeholder="News Title"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'News Title'" required
                        class="single-input"  value="<?php echo $news_title; ?>">
                </div>
                <div class="mt-10">
                    <h5>Picture</h5>
                    <input type="file" name="news_image" placeholder="News Image"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'News Image'" required
                        class="single-input" >
                </div>
                <div class="mt-10">
                    <textarea class="single-textarea" name="news_content" placeholder="Content" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Content'" required><?php echo $news_content; ?></textarea>
                </div>
                <button type="submit" name="add_news_submit" class="primary-btn text-uppercase mt-10">Add</button>
                <a href="admin-news.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'Admin' can access this page -->
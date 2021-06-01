<!-- ---------- only 'admin' can use this page ----------------> 
<?php if($_SESSION['role'] != 'admin'):?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
        // if delete button is pressed (only an admin can do this)
        if(isset($_GET['del'])) {
            if($_SESSION['role'] == 'admin') {		
                $uid = mysqli_real_escape_string($con, $_GET['del']);
            
                $q = "DELETE FROM news WHERE news_id = $uid";
            
                $del_result = mysqli_query($con, $q);
                    
                $div_info   = confirmQuery($del_result, 'delete');
                $div_class 	= $div_info['div_class'];
                $div_msg 	= $div_info['div_msg'];
            }
        }
?>	

<?php
	// display an alert message from result of $_GET or $_POST;
	// this row is not displayed if both $_GET and $_POST are not set
	if(isset($div_msg)):?>
        <div class="col-md-12">
            <div class="alert alert-<?php echo $div_class;?>">
                <?php echo $div_msg;?>
            </div>
        </div>
<?php endif; ?>


    
    <div class="section-top-border col-lg-12 col-md-12">
    <a href="admin-news.php?source=add_news" 
    class="genric-btn primary radius mb-10" role="button">Add News</a>
        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">#</div>
                    <div class="visit">Title</div>
                    <div class="visit">Image</div>
                    <div class="visit">Content</div>
                    <div class="country">Actions</div>
                </div>
                <?php
                    $q =    "SELECT * FROM news";

                    $newss = mysqli_query($con, $q);
                ?>
                <?php foreach($newss as $news):?>

                <div class="table-row">
                    <div class="serial"><?php echo $news['news_id'];?></div>
                    <div class="visit"><?php echo $news['news_title'];?></div>
                    <div class="visit"><?php echo $news['news_image'];?></div>
                    <div class="visit"><?php echo $news['news_content'];?></div>
                    <div class="country">
                        <a href="admin-news.php?source=edit_news&id=<?php echo $news['news_id'];?>" 
                        class="genric-btn primary circle small" role="button">Edit
                        </a>
                        <hr>
                        <a onclick="return confirm('Are you sure you want to delete this news?');" 
                        href="admin-news.php?del=<?php echo $news['news_id'];?>" class="genric-btn danger circle small" role="button">
                        Delete
                        </a>
                    </div>
                </div>
                
                <?php endforeach;?>

            </div>
        </div>
    </div>

<?php endif; ?>

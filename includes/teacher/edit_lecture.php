<!-- only 'teacher' can access this page -->
<?php if($_SESSION['role'] != 'teacher'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            // -------------------- if 'Add lecture' is submitted -------------------
            if(isset($_POST['edit_lecture_submit'])) {
                // get all input data
                $lecture_id = $_POST['lecture_id'];
                $lecture_name				= mysqli_real_escape_string($con, $_POST['lecture_name']);
                $lecture                   = $_FILES['lecture']['name'];
                $lecture_note            = mysqli_real_escape_string($con, $_POST['lecture_note']);
                
                // check if lecturename is already in use in the lectures table
                $q = "SELECT lectures.lecture_name FROM lectures 
                            WHERE lecture_name = '$lecture_name'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($lecture_name) || empty($lecture) || empty($lecture_note) ) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that lecturename is already in use. Please choose another.';
                } else { 
                    if($lecture != "") { 
                        $lecture_tmp = $_FILES['lecture']['tmp_name'];
                        move_uploaded_file($lecture_tmp, "img/$lecture");
                    }
                    $q = "UPDATE lectures SET lecture_name = '$lecture_name', lecture = '$lecture', 
                        lecture_note = '$lecture_note' WHERE lecture_id = $lecture_id";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'update');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $lecture_name = '';
                    $lecture_note = '';
                }
            }
?>
        <?php
            // ---------- if there is a lecture to be edited from $_GET -------------
            if(isset($_GET['id'])) {

                $edit_lecture_id = mysqli_real_escape_string($con, $_GET['id']);
                
                $q = "SELECT * FROM lectures WHERE lecture_id = $edit_lecture_id";
                $result = mysqli_query($con, $q);
                $edit_lecture = mysqli_fetch_array($result);
                
                // this is a special case, so it does not lecture confirmQuery()
                // $div_msg may already exist, so don't overwrite it
                if(!$edit_lecture) {
                    $div_class = "danger";
                    $div_msg = "Database failed: ".mysqli_error($con);
                } elseif(empty($div_msg)) {
                    $div_class = "success";
                    $div_msg = 'lecture ready for edit.';
                }
            }
            
        ?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Edit Lecture</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="lecture_id" value="<?php echo $edit_lecture['lecture_id'];?>">
                <div class="mt-10">
                    <input type="text" name="lecture_name" placeholder="lecture name"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'lecture name'" required
                        class="single-input" value="<?php echo $edit_lecture['lecture_name']; ?>">
                </div>
                <div class="mt-10">
                    <input type="file" name="lecture" placeholder="lecture" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'lecture'" required class="single-input">
                </div>

                <div class="mt-10">
                    <textarea class="single-textarea" name="lecture_note" placeholder="Message" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Message'" required> <?php echo $edit_lecture['lecture_note']; ?></textarea>
                </div>
                <button type="submit" name="edit_lecture_submit" class="primary-btn text-uppercase mt-10">Update</button>
                <a href="teacher-lectures.php" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'Teachers' can access this page -->
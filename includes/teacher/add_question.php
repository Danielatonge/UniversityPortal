<!-- only 'test' can access this page -->
<?php if($_SESSION['role'] != 'teacher'): ?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
            if(isset($_GET['test_id'])){
                $question_test = $_GET['test_id'];
            }
            // -------------------- if 'Add question' is submitted -------------------
            if(isset($_POST['add_question_submit'])) {
                // get all input data
                $question_text				= mysqli_real_escape_string($con, $_POST['question_text']);
                $option_one            = mysqli_real_escape_string($con, $_POST['option_one']);
                $option_two            = mysqli_real_escape_string($con, $_POST['option_two']);
                $option_three            = mysqli_real_escape_string($con, $_POST['option_three']);
                $answer            = mysqli_real_escape_string($con, $_POST['answer']);
                
                
                // check if questiontext is already in use in the questions table
                $q = "SELECT questions.question_text FROM questions 
                            WHERE question_text = '$question_text'";
            
                $r = mysqli_query($con, $q);
                
                if(empty($question_text) || empty($option_one) || empty($option_two) || empty($option_three) || empty($answer)) {
                    $div_class = 'danger';
                    $div_msg = 'Please fill in all required fields.';
                } elseif(mysqli_num_rows($r) > 0) {
                    $div_class = 'danger';
                    $div_msg = 'Sorry, that questiontext is already in use. Please choose another.';
                } else { 
                    
                    $q = "INSERT INTO questions (question_text, test_id, option_one, option_two, option_three, correct)
                            VALUES ('$question_text', '$question_test', '$option_one', '$option_two', '$option_three', '$answer')";
                    
                    $result     = mysqli_query($con, $q);
                    
                    $div_info   = confirmQuery($result, 'insert');
                    $div_class 	= $div_info['div_class'];
                    $div_msg 	= $div_info['div_msg'];
                    
                    // reset to a blank form
                    $question_text = '';
                    $option_one = '';
                    $option_two = '';
                    $option_three = '';
                    $answer = '';
                }
            // start with a blank form
            } else {
                $question_text = '';
                $option_one = '';
                $option_two = '';
                $option_three = '';
                $answer = '';
            }
?>

        <div class="col-lg-8 col-md-8">
            <h3 class="mb-30">Add question</h3>
            <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                <div class="mt-10">
                    <input type="text" class="single-input" name="question_text" placeholder="Question"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Question'" value="<?php echo $question_text; ?>">
                </div>
                <div class="mt-10">
                    <input type="text" name="option_one" placeholder="option 1"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'option 1'" required
                        class="single-input" value="<?php echo $option_one; ?>">
                </div>
                <div class="mt-10">
                    <input type="text" name="option_two" placeholder="option 2"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'option 2'" required
                        class="single-input" value="<?php echo $option_two; ?>">
                </div>
                <div class="mt-10">
                    <input type="text" name="option_three" placeholder="option 3"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'option 3'" required
                        class="single-input" value="<?php echo $option_three; ?>">
                </div>
                <div class="mt-10">
                    <input type="text" name="answer" placeholder="Answer"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Answer'" required
                        class="single-input" value="<?php echo $answer; ?>">
                </div>
                <button type="submit" name="add_question_submit" class="primary-btn text-uppercase mt-10">Add</button>
                <a href="teacher-questions.php?test_id=<?php echo $question_test; ?>" class="genric-btn info text-uppercase mt-10 radius">Manage</a>
            </form>
        </div>
        <div class="col-lg-4 col-md-4">
            <?php if(!empty($div_msg)):?>
                <div class="alert alert-<?php echo $div_class;?>">
                    <?php echo $div_msg;?>
                </div>
            <?php endif;?>
        </div>
<?php endif; ?>   <!-- only 'test' can access this page -->
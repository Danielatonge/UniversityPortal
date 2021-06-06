<!-- ---------- only 'teacher' can use this page ----------------> 
<?php if($_SESSION['role'] != 'teacher'):?>
	<h2>Sorry! You are not authorized to use this page.</h2>
<?php else:?>

<?php
        if(isset($_GET['test_id'])) {
            $test_id = $_GET['test_id'];
        }
        // if delete button is pressed (only an teacher can do this)
        if(isset($_GET['del'])) {
            if($_SESSION['role'] == 'teacher') {		
                $uid = mysqli_real_escape_string($con, $_GET['del']);
            
                $q = "DELETE FROM questions WHERE question_id = $uid";
            
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
    <a href="teacher-questions.php?source=add_question&test_id=<?php echo $test_id;?>" 
    class="genric-btn primary radius mb-10" role="button">Add Question</a>
        <div class="progress-table-wrap">
            <div class="progress-table">
                <div class="table-head">
                    <div class="serial">#</div>
                    <div class="visit">Question</div>
                    <div class="visit">Correct</div>
                    <div class="country">Actions</div>
                </div>
                <?php
                    $q =    "SELECT * FROM questions WHERE questions.test_id = '$test_id'";

                    $questions = mysqli_query($con, $q);
                ?>
                <?php foreach($questions as $question):?>

                <div class="table-row">
                    <div class="serial"><?php echo $question['question_id'];?></div>
                    <div class="visit"><?php echo $question['question_text'];?></div>
                    <div class="visit"><?php echo $question['correct'];?></div>
                    <div class="country">
                        <a href="teacher-questions.php?source=edit_question&question_id=<?php echo $question['question_id'];?>&test_id=<?php echo $test_id;?>"" 
                        class="genric-btn primary circle small" role="button">Edit
                        </a>
                        <hr>
                        <a onclick="return confirm('Are you sure you want to delete this question?');" 
                        href="teacher-questions.php?del=<?php echo $question['question_id'];?>" class="genric-btn danger circle small" role="button">
                        Delete
                        </a>
                    </div>
                </div>
                
                <?php endforeach;?>

            </div>
        </div>
    </div>

<?php endif; ?>

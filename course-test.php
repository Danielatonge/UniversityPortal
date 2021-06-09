<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php
    $qid = array();
    if(isset($_GET['test_id'])) { $test_id = $_GET['test_id']; }
    $q =    "SELECT * FROM questions WHERE test_id = '$test_id'";
    $questions = mysqli_query($con, $q);
    $num = mysqli_num_rows($questions);
?>

    <section class="popular-courses-area section-gap courses-page">
        <div class="container">
        <?php 
            $tagn = '';
            if(isset($_POST['test_submit'])) { 
                $tagn =  "style='display: none;'";
            } 
        ?>
            <div <?= $tagn ?> >
                <div class="row d-flex justify-content-center">
                    <div class="menu-content pb-20 col-lg-8">
                        <div class="title text-center">
                            <h1 class="mb-10">Test Began ( Subject )</h1>
                            <p>Answer all questions that follow.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <ol class="ordered-list">
                                <?php foreach($questions as $question): ?>
                                <?php $qid["question_" . $question['question_id']] = $question['correct'];?>
                                <li class="mt-20"> <h4><?= $question['question_text']; ?></h4>
                                    <div class="mt-10">
                                        <input type="radio" id="<?= $question['question_id']; ?>_1" name="question_<?= $question['question_id']; ?>" value="1">
                                        <label for="<?= $question['question_id']; ?>_1"><?= $question['option_one']; ?></label>
                                    </div>
                                    <div>
                                        <input type="radio" id="<?= $question['question_id']; ?>_2" name="question_<?= $question['question_id']; ?>" value="2">
                                        <label for="<?= $question['question_id']; ?>_2"><?= $question['option_two']; ?></label>
                                    </div>
                                    <div>
                                        <input type="radio" id="<?= $question['question_id']; ?>_3" name="question_<?= $question['question_id']; ?>" value="3">
                                        <label for="<?= $question['question_id']; ?>_3"><?= $question['option_three']; ?></label>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ol>
                            <button type="submit" name="test_submit" class="primary-btn text-uppercase mt-10">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if(isset($_POST['test_submit'])): ?>
            <div class="row d-flex justify-content-center" >
                <div class="menu-content pb-20 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Test Over ( Subject )</h1>
                        <p>You can see your result in your report.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
    if(isset($_POST['test_submit'])) {
        $mark = 0;
        foreach($qid as $key => $value){
            if($_POST[$key] == $value) { $mark++;}
        }
        $theory = ($mark / $num ) * 100;
        $q = "SELECT tests.course_id FROM tests WHERE tests.test_id = $test_id";
        $result = mysqli_query($con, $q);
        $course = mysqli_fetch_array($result);

        $user_id = $_SESSION['userid'];
        $course_id = $course['course_id'];
        $grade_practical = random_int(30, 75);
        $grade_theory = $theory;
        $grade_result = $grade_theory + $grade_practical;

        $q = "INSERT INTO grades ( user_id, course_id, grade_practical, grade_theory, grade_result)
        VALUES ('$user_id', '$course_id', '$grade_practical', '$grade_theory', '$grade_result')";
        $done     = mysqli_query($con, $q);
    }


?>

    <?php include "includes/footer.php"; ?>
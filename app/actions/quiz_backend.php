<?php
include('../../config/db_connect.php'); // the database connection...........

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //data from quiz questions.........
    $question_number = $_POST['question_number'];
    $question_key = $_POST['question_key'];
    $inputted_answer = $_POST['answer_input'];
    $quiz_taken = $_SESSION['quiz_take'] ;
    $user_id = $_SESSION['user_id'];
    $hint_used = $_POST['hint_used'];
    $activity_id = $_POST['activity_id'];
    $show_hint = $_POST['show_hint'];

    // additional data to be used.......
    $totalItems = $_SESSION['total_items'];
    $wrong_answer_attempts = $_SESSION['wrong_attempts'];
    $itemIncrement = $_SESSION['item_number'];
    $itemRemain = $_SESSION['item_number'];

    // checking the inputted answer if empty....................
    if($inputted_answer == ""){
        $_SESSION['show_sweetalert'] = "go";
        $_SESSION['icon'] = "warning";
        $_SESSION['head_text'] = "System did not detect the answer";
        $_SESSION['body_text'] = "Make sure to point the choices correctly to save your answer.";
        header("location:../_lessons_quiz.php?activity=$activity_id&item=$question_number");
    }else{
        // answer is correct...........
        if($inputted_answer == $question_key){
            if($wrong_answer_attempts == 0){
                $score = 1;
            }else{
                $score = 0;
            }
            $to_save_score = $score;

            $correct_query = mysqli_query($con,"INSERT INTO `quiz_correct`(`user_id`, `activity_id`, `quiz_number`, `points`, `use_hint`,`quiz_attempt`) 
            VALUES ('$user_id','$activity_id','$question_number','$to_save_score','$hint_used','$quiz_taken')");

            if($itemIncrement == $totalItems){
                $_SESSION['show_sweetalert_last'] = "show";
                $_SESSION['icon'] = "success";
                $_SESSION['head_text'] = "Correct answer!";
                $_SESSION['body_text'] = "You have reach the last question";
                header("location:../_lessons_quiz.php?activity=$activity_id&item=$totalItems");
            }else{
                ++$itemIncrement;
                $_SESSION['next_item'] = $itemIncrement;
                $_SESSION['show_sweetalert_correct'] = "show";
                $_SESSION['icon'] = "success";
                $_SESSION['head_text'] = "Impressive!";
                $_SESSION['body_text'] = "You got the correct answer, you can now proceed to the next question.";
                header("location:../_lessons_quiz.php?activity=$activity_id&item=$itemRemain&gate=1");
            }
        }
        // wrong answer...........
        else{
            $wrong_value = 1;
            // save to wrong answers table...........
            $wrong_query = mysqli_query($con,"INSERT INTO `quiz_mistakes`(`user_id`, `activity_id`, `quiz_id`, `answer_input`, `mistakes`,`quiz_attempt`) 
            VALUES ('$user_id','$activity_id','$question_number','".$inputted_answer."','$wrong_value','$quiz_taken')");

            // fetching data from quiz_mistake table................
            $fetchquery = mysqli_query($con,"SELECT SUM(mistakes) AS totalMistakes FROM `quiz_mistakes`
            WHERE `user_id` = '$user_id' AND `quiz_id` = '$question_number' AND `quiz_attempt`= '$quiz_taken'");
            $fetch_result = mysqli_num_rows($fetchquery);
            if($fetch_result > 0){
                while($row = mysqli_fetch_assoc($fetchquery)){
                    $total_mistakes = $row['totalMistakes'];
                    if($total_mistakes == 1){
                        $_SESSION['show_sweetalert'] = "go";
                        $_SESSION['icon'] = "error";
                        $_SESSION['head_text'] = "uh-oh Try again";
                        $_SESSION['body_text'] = "Sorry, your answer is wrong, try again you can do it.";
                        header("location:../_lessons_quiz.php?activity=$activity_id&item=$question_number&wrong=1");
                    }else if($total_mistakes == 2){
                        $_SESSION['show_sweetalert'] = "go";
                        $_SESSION['icon'] = "error";
                        $_SESSION['head_text'] = "Unfortunately";
                        $_SESSION['body_text'] = "Your answer is wrong again, analyze the question carefully.";
                        header("location:../_lessons_quiz.php?activity=$activity_id&item=$question_number&wrong=2usehint=$hint_used&show=$show_hint");
                    }else if($total_mistakes == 3){
                        $_SESSION['show_sweetalert'] = "go";
                        $_SESSION['icon'] = "error";
                        $_SESSION['head_text'] = "Still incorrect";
                        $_SESSION['body_text'] = "Still wrong, Don't forget to use the hint. Hint is now available";
                        header("location:../_lessons_quiz.php?activity=$activity_id&item=$question_number&wrong=3&usehint=$hint_used&show=$show_hint");
                    }else if($total_mistakes == 4){
                        $_SESSION['show_sweetalert'] = "go";
                        $_SESSION['icon'] = "error";
                        $_SESSION['head_text'] = "Try again.";
                        $_SESSION['body_text'] = "Still wrong, you can still use the hint, You got this.";
                        header("location:../_lessons_quiz.php?activity=$activity_id&item=$question_number&wrong=4&usehint=$hint_used&show=$show_hint");
                    }else{
                        $_SESSION['show_sweetalert'] = "go";
                        $_SESSION['icon'] = "error";
                        $_SESSION['head_text'] = "Try again.";
                        $_SESSION['body_text'] = "Still wrong, you can still use the hint, You got this.";
                        header("location:../_lessons_quiz.php?activity=$activity_id&item=$question_number&wrong=$total_mistakes&usehint=$hint_used&show=$show_hint");
                    }
                }
            }else{
                echo "no data found";
            }
        }
    }

}else{
    echo "no data found";
}

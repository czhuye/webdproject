<?php
    require('connect.php');

    include 'header.html';

    //var_dump($_POST);

    $score = 0;

    foreach($_POST as $question => $answer)
    {
        //echo '<p>'.$question.'</p>';
        //echo '<p>'.$answer.'</p>';
        
        $query_question = "SELECT * FROM questions where id = {$question}";
	    $statement_question = $db -> prepare($query_question);
	    $statement_question -> execute();
	    $row_question = $statement_question->fetch();
         
        echo "<div class = 'quiz_question'>";
        echo '<br><p>'.$row_question['content'].'</p>';
        if($row_question['img'] != ""){
			echo  '<img src='. $row_question['img'] . ' alt=" "><br>';
		}

        $query_choices = "SELECT * FROM choices where question_id = {$question}";
        $statement_choices = $db -> prepare($query_choices);
        $statement_choices -> execute();
        $row_choices = $statement_choices->fetch();
        $correct_answer = $row_choices['correct_answer'];

        // echo '<input type="radio" id="answer_a" name="'.$question.'" value="answer_a">';
        // echo '<label for="answer_a">'.$row_choices['answer_a'].'</label><br>';

        // echo '<input type="radio" id="answer_b" name="'.$question.'" value="answer_b">';
        // echo '<label for="answer_b">'.$row_choices['answer_b'].'</label><br>';

        // echo '<input type="radio" id="answer_c" name="'.$question.'" value="answer_c">';
        // echo '<label for="answer_c">'.$row_choices['answer_c'].'</label><br>';
        
        // echo '<input type="radio" id="answer_d" name="'.$question.'" value="answer_d">';
        // echo '<label for="answer_d">'.$row_choices['answer_d'].'</label><br>';

		echo $row_choices['answer_a'].'<br>';
   		echo $row_choices['answer_b'].'<br>';
   		echo $row_choices['answer_c'].'<br>';
   		echo $row_choices['answer_d'].'<br>';
        
        $user_answer = strtoupper(substr($answer, -1));
        echo '<br>Your Answer:'.$user_answer;
   		echo '<p>Correct Answer: '. $correct_answer . '</p>';

        

        if ($user_answer == $correct_answer){
             
            $score++;
 
        }
        echo '</div>';
 
    }

    $total = count($_POST) / 100;
    // echo $total;
    // echo $score;
    if ($total == 0){
        echo '<h1>Your score is 0.</h1>';
    }else{
        echo '<h1>Your score: '. intval($score/$total) . '%</h1>';
        echo '<a href="index.php"><h3>Back to Homepage</h3></a>';
    }
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title>WEB DEV Project</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
         
    </head>
    <body>
 

        

        
    </body>
</html>




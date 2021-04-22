<?php
    require('connect.php');
    session_start();

    if(!is_null($_GET['id']) && $_GET['id'] != ""){
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    }
    

    $query = "SELECT * FROM questions where id = {$id} LIMIT 1";
     
    $statement = $db -> prepare($query);
	$statement -> execute();
	$quiz = $statement->fetch();

    $query_choices = "SELECT * FROM choices where question_id = {$id}";
    $statement_choices = $db -> prepare($query_choices);
    $statement_choices -> execute();
    $row_choices = $statement_choices->fetch();

    $query_choice = "SELECT * FROM choices WHERE question_id = {$id}";
    $stmt = $db -> prepare($query_choice);
    $stmt -> execute();
    $row_choice = $stmt->fetch();
            //echo $row_choice['answer_a'];
    $questions['answer_a']=$row_choice['answer_a'];
    $questions['answer_b']=$row_choice['answer_b'];
    $questions['answer_c']=$row_choice['answer_c'];
    $questions['answer_d']=$row_choice['answer_d'];
    $questions['correct_answer']=$row_choice['correct_answer'];



    


?>
<!DOCTYPE html>
<html>
    <head>
        <title>WEB DEV Project</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <!--Nav Header-->
	    <div id="nav-placeholder">

        </div>

        <script>
        $(function(){
            $("#nav-placeholder").load("header.html");
        });
        </script>
        <!--end of Nav Header-->

        <div id ="quiz_container">
        <form action="quiz_result.php" method="post">
            
                <div class = "quiz_question">
                    <p><?= $quiz['content'] ?></p>
                    <!-- <p><?= $quiz['id']?></p> -->
                    <?php if ($quiz['img'] != "") : ?>
                    <img src="<?= $quiz['img']?>" alt="<?= $row_question['content']?>"><br>
                    <?php endif ?>
                    <input type="radio" id="answer_a" name="<?= $quiz['id']?>" value="answer_a">
                    <label for="answer_a"><?= $questions['answer_a'] ?></label><br>
                    <input type="radio" id="answer_b" name="<?= $quiz['id']?>" value="answer_b">
                    <label for="answer_b"><?= $questions['answer_b'] ?></label><br>
                    <input type="radio" id="answer_c" name="<?= $quiz['id']?>" value="answer_c">
                    <label for="answer_c"><?= $questions['answer_c'] ?></label><br>
                    <input type="radio" id="answer_d" name="<?= $quiz['id']?>" value="answer_d">
                    <label for="answer_d"><?= $questions['answer_d'] ?></label><br><br>
                </div>
            

        </form>
        <a href="index.php"><h3>Back to Homepage</h3></a>
    </div>
    </body>
</html>
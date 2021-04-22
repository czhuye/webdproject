<?php
    require('connect.php');

    if(!is_null($_POST['number']) && $_POST['number'] != ""){
        $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT);
        

        $query = "SELECT * FROM questions ORDER BY RAND() LIMIT :number";
        //$query = "SELECT * FROM questions LIMIT :number";
        //$query = "SELECT * FROM questions ORDER BY RAND()";
        $statement = $db -> prepare($query);

        $statement->bindValue(':number', $number, PDO::PARAM_INT);
        
        $statement -> execute();
        $quizes = [];
        $questions = [];
        

        while ($row = $statement->fetch()){
            $questions['id'] = $row['id'];
            $questions['content'] = $row['content'];
            $questions['img'] = $row['img'];
            
            
            $query_choice = "SELECT * FROM choices WHERE question_id = {$row['id']}";
            $stmt = $db -> prepare($query_choice);
            $stmt -> execute();
            $row_choice = $stmt->fetch();
            //echo $row_choice['answer_a'];
            $questions['answer_a']=$row_choice['answer_a'];
            $questions['answer_b']=$row_choice['answer_b'];
            $questions['answer_c']=$row_choice['answer_c'];
            $questions['answer_d']=$row_choice['answer_d'];
            $questions['correct_answer']=$row_choice['correct_answer'];

            array_push ($quizes,$questions);
            //var_dump($quizes);
        }

    }else{

        echo '<script>
        alert("Please input a number.");
        window.location.href="pick_quiz.php";
        </script>';
   		 
    }
        

 ?>


<!DOCTYPE html>
<html>

<head>
    <title>Quiz</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function quiz_number_error()
        {
            alert("please choose a number");  
        }
    </script>
</head>

<body>
    <!--Nav Header-->
    <div id="nav-placeholder">

    </div>

    <script>
        $(function() {
            $("#nav-placeholder").load("header.html");
        });
    </script>
    <!--end of Nav Header-->
    
    <div id ="quiz_container">
        <form action="quiz_result.php" method="post">
            <?php foreach ($quizes as $quiz): ?>
                <div class = "quiz_question">
                    <p><?= $quiz['content'] ?></p>
                    <!-- <p><?= $quiz['id']?></p> -->
                    <?php if ($quiz['img'] != "") : ?>
                    <img src="<?= $quiz['img']?>" alt="<?= $row_question['content']?>"><br>
                    <?php endif ?>
                    <input type="radio" id="answer_a" name="<?= $quiz['id']?>" value="answer_a">
                    <label for="answer_a"><?= $quiz['answer_a'] ?></label><br>
                    <input type="radio" id="answer_b" name="<?= $quiz['id']?>" value="answer_b">
                    <label for="answer_b"><?= $quiz['answer_b'] ?></label><br>
                    <input type="radio" id="answer_c" name="<?= $quiz['id']?>" value="answer_c">
                    <label for="answer_c"><?= $quiz['answer_c'] ?></label><br>
                    <input type="radio" id="answer_d" name="<?= $quiz['id']?>" value="answer_d">
                    <label for="answer_d"><?= $quiz['answer_d'] ?></label><br><br>
                </div>
            <?php endforeach ?>

            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
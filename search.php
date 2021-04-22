<?php
    require('connect.php');


    
    
    if($_POST && !empty($_POST['search'])){

		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	}else{
        
        header("Location: index.php");
        exit;
    }

    $search = '%'.$search.'%';
    //echo $search;
    $query = "SELECT * FROM questions WHERE content LIKE :search";
    $statement = $db -> prepare($query);
    $statement->bindValue(':search', $search, PDO::PARAM_STR);
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

    //var_dump($quizes);
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

        <div class="search-container">
            <div class ="quiz_question">
                
                <?php foreach ($quizes as $quiz): ?>
                    <div class = "quiz_question">
                        <?php if (empty($quiz)) : ?>
                            <p>Nothing Found </p>
                        <?php else : ?>
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

                            <a href="show_question.php?id=<?= $quiz['id'] ?>">Show question</a>
                        <?php endif; ?> 
                        
                    </div>
                <?php endforeach ?>
            </div> 
            <div id = "back_to_homepage">
                <a href="index.php"><h3>Back to Homepage</h3></a>
            </div>
        </div>
       
    </body>
</html>
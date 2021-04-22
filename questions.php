<?php 

    session_start();
    //require('connect.php');

    $quizes = [];
    $questions = [];

    if(!isset($_SESSION['username'])){
        include('header.html');
        echo '<link rel="stylesheet" type="text/css" href="styles.css" />';
		echo '<h1>Please Register First, Redirecting to Homepage</h1>';
        header("refresh:5; url=index.php");
        exit;
	}

    $isuser = false;
    if(isset($_POST['questions'])){
        $select = $_POST['questions'];
    }else{
        //echo  $_POST['questions'];
        $select = "id";
    }
    

    function sort_question($value) {
        require('connect.php');

        if($value == "timestamp"){
            $query = "SELECT * FROM questions ORDER BY $value DSC";
        }else{
            $query = "SELECT * FROM questions ORDER BY $value";
        }
        
        
        
        $statement = $db -> prepare($query);

        $statement -> execute();
        // $quizes = [];
        // $questions = [];
        

        while ($row = $statement->fetch()){
            $GLOBALS['questions']['id'] = $row['id'];
            $GLOBALS['questions']['content'] = $row['content'];
            $GLOBALS['questions']['img'] = $row['img'];
            
            
            $query_choice = "SELECT * FROM choices WHERE question_id = {$row['id']}";
            $stmt = $db -> prepare($query_choice);
            $stmt -> execute();
            $row_choice = $stmt->fetch();

            $GLOBALS['questions']['answer_a']=$row_choice['answer_a'];
            $GLOBALS['questions']['answer_b']=$row_choice['answer_b'];
            $GLOBALS['questions']['answer_c']=$row_choice['answer_c'];
            $GLOBALS['questions']['answer_d']=$row_choice['answer_d'];
            $GLOBALS['questions']['correct_answer']=$row_choice['correct_answer'];

            array_push ($GLOBALS['quizes'],$GLOBALS['questions']);
        }
    }
    
	if(!isset($_SESSION['username'])){
        include('header.html');
        echo '<link rel="stylesheet" type="text/css" href="styles.css" />';
		echo '<h1>Register First, Redirecting to Homepage</h1>';
        header("refresh:5; url=index.php");
        exit;
	}else{
		$isuser = true;

        if ($select == "id"){
            //echo "id";
            sort_question("id");
        }elseif($select == "content"){
            //echo "content";
            sort_question("content");
        }elseif($select == "img"){
            //echo "img";
            sort_question("img");
        }elseif($select == "timestamp"){
            //echo "timestamp";
            sort_question("timestamp");
        }else{
            //echo "else";
            sort_question("id");
	    }
    }
?>




<!DOCTYPE html>
<html>
    <head>
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
            <form method ="post" action="questions.php">
                <label for="cars">Sort Questions by:</label>
                <select name="questions" id="questions">
                    <option value="id">Id</option>
                    <option value="content">Alphabet</option>
                    <option value="img">Image</option>
                    <!-- <option value="timestamp">timestamp</option> -->
                </select>
                <input type="submit" value="Submit">
            </form>
                <?php foreach ($quizes as $quiz): ?>
                    <div class = "quiz_question">
                        <p><?= $quiz['content'] ?></p>
                        <!-- <p><?= $quiz['id']?></p> -->
                        <?php if ($quiz['img'] != "") : ?>
                            <a href="show_question.php?id=<?= $quiz['id'] ?>" ><img src="<?= $quiz['img']?>" alt="<?= $row_question['content']?>"></a><br>
                        <?php endif ?>
                        <input type="radio" id="answer_a" name="<?= $quiz['id']?>" value="answer_a">
                        <label for="answer_a"><?= $quiz['answer_a'] ?></label><br>
                        <input type="radio" id="answer_b" name="<?= $quiz['id']?>" value="answer_b">
                        <label for="answer_b"><?= $quiz['answer_b'] ?></label><br>
                        <input type="radio" id="answer_c" name="<?= $quiz['id']?>" value="answer_c">
                        <label for="answer_c"><?= $quiz['answer_c'] ?></label><br>
                        <input type="radio" id="answer_d" name="<?= $quiz['id']?>" value="answer_d">
                        <label for="answer_d"><?= $quiz['answer_d'] ?></label><br>
                         
                        <br>
                        <label for="correct_answer">Correct Answer: <?= $quiz['correct_answer'] ?></label><br>
                        <br>
                        
                        <a href="edit_question.php?id=<?= $quiz['id'] ?>">edit</a>
                        <a href="show_question.php?id=<?= $quiz['id'] ?>">Show question</a>
                    </div>
                <?php endforeach ?>
        </div>
    </body>
</html>
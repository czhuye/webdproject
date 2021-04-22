<!-- Update or Delete a post -->

<?php
require('connect.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$query_question = "SELECT * FROM questions where id = {$id}";
$statement_question = $db -> prepare($query_question);

$statement_question -> execute();
$row_question = $statement_question->fetch();

$query_choices = "SELECT * FROM choices where question_id = {$row_question['id']}";
$statement_choices = $db -> prepare($query_choices);
$statement_choices -> execute();
$row_choices = $statement_choices->fetch();

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

  <div>
		<form action="process_question.php" method="post" enctype="multipart/form-data">
  		<fieldset>
    		<legend>Edit Questions</legend>

            <!-- <input name="id" value="<?= $row_question['id']?>" /> -->
            <input type="hidden" name="id" value="<?= $row_question['id']?>" />

            <p>
              <label for="content">Question: </label>
              <input name="content" id="content" value="<?= $row_question['content']?>" />
            </p>

            <p>
              <label for="img">Filename:</label>
              <input type="file" name="img" id="img" />
            </p>
            <?php if($row_question['img'] != "") :?>
              <p>
                <input type="checkbox" id="img" name="img_check" value="img"><span>Delete</span>
                <img src="<?= $row_question['img']?>" alt="<?= $row_question['content']?>">
              </p>
            <?php endif ?>
            <p>
              <label for="answer_a">Answer A </label>
              <input name="answer_a" id="answer_a" value="<?= $row_choices['answer_a']?>" />
            </p>

            <p>
              <label for="answer_b">Answer B </label>
              <input name="answer_b" id="answer_b" value="<?= $row_choices['answer_b']?>" />
            </p>

            <p>
              <label for="answer_c">Answer C </label>
              <input name="answer_c" id="answer_c" value="<?= $row_choices['answer_c']?>" />
            </p>

            <p>
              <label for="answer_d">Answer D </label>
              <input name="answer_d" id="answer_d" value="<?= $row_choices['answer_d']?>" />
            </p>

            <p>
              <label for="correct_answer">Correct Answer </label>
              <input name="correct_answer" id="correct_answer" value="<?= $row_choices['correct_answer']?>" />
            </p>
    
            <p>
            
            <input type="submit" name="command" value="Update" />
            <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
            </p>
  		</fieldset>
		</form>
	</div>
</body>
</html>
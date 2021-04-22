<!-- Update or Delete a post -->

<?php
	require('connect.php');
  

  $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT);
  
	$query_question = "SELECT * FROM questions where id = {$number}";
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
	<title>Edit Questions</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <div>
		<form action="process_question.php" method="post" enctype="multipart/form-data">
  		<fieldset>
    			<legend>Edit Questions</legend>

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
                <input type="checkbox" id="img" name="img" value="img"><span>Delete</span>
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
      			<input type="hidden" name="id" value="<?= $number?>" />
      			<input type="submit" name="command" value="Update" />
      			<input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
    			</p>
  		</fieldset>
		</form>
	</div>
</body>
</html>
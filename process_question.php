<!-- Process the question request -->
<?php
	require('connect.php');
	require('authenticate.php');
	include('apply_styles.html');
	include('admin_header.html');


	// if($_POST && !empty($_POST['content']) && !empty($_POST['command'])){
	// 	// Sanitize user input to escape HTML entitiles and filter out dnagerous characters.
	// 	$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	// 	$command = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	// 	// $filename = basename($_FILES['img']['name']);
	// 	// $newname = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR. $filename;

	// 	// move_uploaded_file($_FILES['img']['tmp_name'], $newname);

	// }else{
	// 	header("Location: error.php");
 //   		exit;
	// }
		
	if($_POST['command'] == 'create'){
		
		if($_FILES['img']['name'] == ""){
			$img = "";
		}else{
			$filename = basename($_FILES['img']['name']);
			$newname = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR. $filename;

			move_uploaded_file($_FILES['img']['tmp_name'], $newname);
			$img = 'uploads' . DIRECTORY_SEPARATOR. $filename;
		}
		
		$query = "INSERT INTO questions (content, img) VALUES (:content, :img)";
		$statement = $db ->prepare($query);

		$content = $_POST['content'];
		
		//Bind values to the parameters
		$statement->bindValue(':content', $content);
		$statement->bindValue(':img', $img);

		$statement->execute();
		$last_id = $db->lastInsertId();
		

		$query = "INSERT INTO choices (answer_a, answer_b, answer_c, answer_d, correct_answer, question_id) VALUES (:answer_a, :answer_b, :answer_c, :answer_d, :correct_answer, :question_id)";
		$statement = $db ->prepare($query);
		$answer_a = $_POST['answer_a'];
		$answer_b = $_POST['answer_b'];
		$answer_c = $_POST['answer_c'];
		$answer_d = $_POST['answer_d'];
		$correct_answer = $_POST['correct_answer'];
		$question_id = $last_id;

		$statement->bindValue(':answer_a', $answer_a);
		$statement->bindValue(':answer_b', $answer_b);
		$statement->bindValue(':answer_c', $answer_c);
		$statement->bindValue(':answer_d', $answer_d);
		$statement->bindValue(':correct_answer', $correct_answer);
		$statement->bindValue(':question_id', $question_id);

		$statement->execute();

		echo '<h2>Question id:' . $last_id . '</h2>';
		echo '<h3>You just sumbit the following Question</h3>';
		echo '<h3>'. $content . '</h3>';
		if($img != ""){
			echo  '<img src='. $img . ' alt=" ">';
		}
		echo '<h4>'. $answer_a . '</h4>';
   		echo '<h4>'. $answer_b . '</h4>';
   		echo '<h4>'. $answer_c . '</h4>';
   		echo '<h4>'. $answer_d . '</h4>';
   		echo '<h3>Correct Answer: '. $correct_answer . '</h3>';

   		echo '<a href="index.php"><h3>Back to Homepage</h3></a>';
	}
		
	
	if($_POST['command'] == 'Update'){

		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		
		if($_FILES['img']['name'] == "" || isset($_POST['img_check'])){
			$img = "";
		}else{
			$filename = basename($_FILES['img']['name']);
			$newname = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR. $filename;

			move_uploaded_file($_FILES['img']['tmp_name'], $newname);
			$img = 'uploads' . DIRECTORY_SEPARATOR. $filename;
		}
		$content = $_POST['content'];
	    
		$query = "UPDATE questions SET content = :content, img = :img WHERE id = :id";
	    $statement = $db->prepare($query);
	    
	    $statement->bindValue(':content', $content);
		$statement->bindValue(':img', $img);
	    $statement->bindValue(':id', $id, PDO::PARAM_INT);

   		$statement->execute();

		$query = "UPDATE choices SET 
		answer_a = :answer_a, 
		answer_b = :answer_b, 
		answer_c = :answer_c, 
		answer_d = :answer_d, 
		correct_answer = :correct_answer 
		WHERE question_id = :id";

		$statement = $db ->prepare($query);
		$answer_a = $_POST['answer_a'];
		$answer_b = $_POST['answer_b'];
		$answer_c = $_POST['answer_c'];
		$answer_d = $_POST['answer_d'];
		$correct_answer = $_POST['correct_answer'];
		
		

		$statement->bindValue(':answer_a', $answer_a);
		$statement->bindValue(':answer_b', $answer_b);
		$statement->bindValue(':answer_c', $answer_c);
		$statement->bindValue(':answer_d', $answer_d);
		$statement->bindValue(':correct_answer', $correct_answer);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);


		$statement->execute();

		echo "<h2>Update Sucessfully</h2>";
		echo '<a href="index.php"><h3>Back to Homepage</h3></a>';
		
	}

	if($_POST['command'] == 'Delete'){
		
		
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

		
	    $query = "DELETE FROM questions WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		echo "<h2>Delete Complete</h2>";
		echo '<a href="index.php"><h3>Back to Homepage</h3></a>';
	}
				

?>


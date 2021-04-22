<!-- Create a new question -->

<?php
	require('authenticate.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <!--Nav Header-->
	    <div id="nav-placeholder">

        </div>

        <script>
        $(function(){
            $("#nav-placeholder").load("admin_header.html");
        });
        </script>
        <!--end of Nav Header-->

		<div id = "create_container">
			<form action="process_question.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>New Questions</legend>
					<p>
						<label for="content">Question</label>
						<input name="content" id="content" />
					</p>
					
					<p>
						<label for="img">Filename:</label>
						<input type="file" name="img" id="img" />
					</p>
					
					<p>
						<label for="answer_a">Answer A</label>
						<input name="answer_a" id="answer_a" />
					</p>

					<p>
						<label for="answer_b">Answer B</label>
						<input name="answer_b" id="answer_b" />
					</p>

					<p>
						<label for="answer_c">Answer C</label>
						<input name="answer_c" id="answer_c" />
					</p>

					<p>
						<label for="answer_d">Answer D</label>
						<input name="answer_d" id="answer_d" />
					</p>

					<p>
						<label for="correct_answer">Correct Answer</label>
						<input name="correct_answer" id="correct_answer" />
					</p>

					<p>
					<input type="submit" name="command" value="create" />
					</p>
					
				</fieldset>
			</form>
		</div>
    </body>
</html>
	
</body>
</html>

<?php 
	session_start();
	if(isset($_SESSION['username'])  &&  $_SESSION['username'] == 'admin'){
		$header = "admin_header.html";
	}else{
		$header = "header.html";
	}

    require('connect.php');
    

	$query = "SELECT * FROM comment ORDER BY timestamp DESC LIMIT 5";
	$statement = $db -> prepare($query);
	$statement -> execute();



	$query_img = "SELECT * FROM validation ORDER BY RAND() LIMIT 1";
        
    $stmt = $db -> prepare($query_img);
    $stmt -> execute();
    $row_validate = $stmt->fetch()

?>

<!DOCTYPE html>
<html>
    <head>
        <title>WEB DEV Project Comment</title>
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

        
        <div id="comment_container">
            <form method="post" action="process_comment.php" enctype="multipart/form-data">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name..">
                </div>  
                
                <div>
                    <label for="avatar">Avatar:</label>
                    <input type="file" name="avatar" id="avatar" />
                </div>
                <div>
                    <label for="cars">Category:</label>
                    <select name="category" id="category">
                        <option value="advice">Advice</option>
                        <option value="complain">Complain</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div>
                    <label for="validate">Code:</label><img src="<?= $row_validate['img']?>" alt="<?= $row_validate['img']?>">
                    <input type="text" id="validate" name="validate" placeholder="Type the words">
                </<div>
                    <p id = "validate_error">Please enter the correct validation code</p>
                <div>
                    <label for="comment">Comment</label>
                </div>
                <div>
                    <textarea id="comment" name="comment" placeholder="Your words.." rows="10" cols="50"></textarea>
                </div>

                <button type="submit" id="comment_submit">Submit</button>

                <script>
                    $(document).ready(function(){
                        $("#comment_submit").click(function(){
                        var validate = $("#validate").val();
                        var img = "<?= $row_validate['text'] ?>";
                        if (validate != img){
                            $("#validate_error").show();
                            event.preventDefault();
                        }
                        });
                    });
                </script>

            </form>
        </div>
        
        <div id = "show_comment_container">
            <h2>Users Comment order by date:</h2>
            <?php while ($row = $statement->fetch()): ?>
                <h2>Name: <?= $row['name']?></h2>
                <p><?= $row['timestamp']?></p>
                <img src="<?= $row['avatar']?>" alt="<?= $row['avatar']?>">
                <h3>Category: <?= $row['category']?></h3>
                <p><?= $row['comment']?><p>
            <?php endwhile?>
        </div>



    </body>
</html>
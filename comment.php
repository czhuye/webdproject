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
                    <label for="comment">Comment</label>
                </div>
                <div>
                    <textarea id="comment" name="comment" placeholder="Your words.." rows="10" cols="50"></textarea>
                </div>
                <input id = "comment_submit" type="submit" value="Submit">
            </form>
        </div>

        <div id = "show_comment_container">
            <h2>Users Comment order by date:</h2>
            <?php while ($row = $statement->fetch()): ?>
                <h2><?= $row['name']?></h2>
                <p><?= $row['timestamp']?></p>
                <img src="<?= $row['avatar']?>" alt="<?= $row['avatar']?>">
                <p><?= $row['comment']?><p>
            <?php endwhile?>
        </div>



    </body>
</html>
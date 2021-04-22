<?php
    
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
        <style>
            h1 {text-align: center;}

        </style>

        <h1>Congratulations. Registration completed successfully</h1> 
        <h1>Now you will be directed to Homepage or you can click <a href="index.php">here</a></h1>
        <script>
        $(document).ready(function(){
            setTimeout(function() {
                window.location.href = "index.php";
            }, 5000);
        });
        
        </script>
    </body>
</html>
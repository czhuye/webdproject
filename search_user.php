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
        <form>
            <input type="text"  onkeyup="showResult(this.value)">
        <div id="livesearch"></div>
</form>
    </body>
</html>
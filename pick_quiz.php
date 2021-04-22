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
        $(function() {
            $("#nav-placeholder").load("header.html");
        });
    </script>
    <!--end of Nav Header-->

    <div id = "pick_quiz_container">
        <h1>Choose number of questions</h1>
        <div id="pick_quiz_number">
            <form action="quiz.php" method="post">
                <label for="number">Number (between 1 and 10):</label>
                <input type="number" id="number" name="number" min="1" max="10">
                
                <input type="submit" value="submit">
            </form>
        </div>
    </div>
</body>

</html>
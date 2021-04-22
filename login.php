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
            $("#nav-placeholder").load("header.html");
        });
        </script>
        <!--end of Nav Header-->
        
        <div id = "login_container">
            <form  method="post" action="process_login.php">
                <h1 class="login-title">Login</h1>
                    <input type="text" class="login-input" name="username" placeholder="Username" />
                    <input type="password" class="login-input" name="password" placeholder="Password"/>
                    <input type="submit" value="Login" name="submit" class="login-button"/>
                    <p class="link">Don't have an account? <a href="register.php">Registration Now</a></p>
            </form>
        </div>
    </body>
</html>
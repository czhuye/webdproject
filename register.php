<?php include('connect.php') ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Registration</title>
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

    
    <form id ="registration_form" method="post" action="process_register.php">
      <div class="registration_form_container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" id="username" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>

        <label for="password_repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password_repeat" id="password_repeat" required>
        
        <p id = "password_check_error">Please enter the same password twice</p>
        
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

        <button type="submit" id="registerbtn">Register</button>

        <script>
          $(document).ready(function(){
            $("#registerbtn").click(function(){
              var password = $("#password").val();
              var password_repeat = $("#password_repeat").val();
              if (password != password_repeat){
                $("#password_check_error").show();
                event.preventDefault();
              }
            });
          });
        </script>

        <div class="container signin">
          <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
      </div>
      
    </form>


</body>
</html>

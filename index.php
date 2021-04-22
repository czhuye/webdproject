<?php 
	session_start();
	if(isset($_SESSION['username'])  &&  $_SESSION['username'] == 'admin'){
		$header = "admin_header.html";
	}elseif(!isset($_SESSION['username'])){
		$header = "guest_header.html";
	}else{
		$header = "header.html";
	}

	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}else{
		$username = "guest";
	}
?>




<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
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
  			$("#nav-placeholder").load("<?= $header ?>");
		});
	</script>
	<!--end of Nav Header-->

	<section>
		<h1>Testing for your Class 5 licence</h1>
	
		<div id="content"> 
			<article>
				<h5>Hi, <?= $username ?></h5>
				<p>In Manitoba, a Class 5 licence allows you to operate a passenger vehicle, a bus (not carrying passengers), a truck with two axles as well as a moped and Class 3 vehicle registered as a farm truck.</p>
				<p>To obtain a Full Stage Class 5 licence, you must:</p>
				<ul>
					<li>Be at least 16 years of age (or enrolled in Driver Z) with consent of either a parent or legal guardian, if under 18 years of age.</li>
					<li>Establish your identification and register as a Manitoba Public Insurance customer.</li>
					<li>Meet the required vision and medical standards.</li>
					<li>Pass a knowledge test.</li>
					<li>Complete the Learner Stage (minimum nine months).</li>
					<li>Pass a road test.</li>
					<li>Complete the Intermediate Stage (minimum 15 months).</li>

				</ul>
				
				<h1>Cost</h1>
				<p>A knowledge test costs $10.</p>
				<h1>Time limits and guidelines</h1>
				<p>There is a 30-minute time limit to complete a knowledge test. It is not an open book test. It is administered using a computer.</p>
				<p>Cell phones and electronic devices are not allowed in the test area.</p>
			</article>
			<aside>
				<?php if (!isset($_SESSION['username'])) :?>
					<div id = "loginpanel">
						<form action="process_login.php" method="post">
							<div id ="loginpanel_username">
								<label for="username">username:</label>
								<input type="text" placeholder="Enter Username" name="username" required>
							</div>
							
							<div id ="loginpanel_password">
								<label for="password">password:</label>
								<input type="password" placeholder="Enter Password" name="password" required>	
							</div>

								
							<button type="submit">Login</button>
						</form>

				<?php else : ?>
					<div hidden>
				<?php endif; ?>		

				</div>
				
			</aside>
		</div>
	</section>


</body>
</html>









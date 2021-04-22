<!-- database connection details -->

<?php
	define('DB_DSN','mysql:host=localhost;dbname=webdproject;charset=utf8');
	define('DB_USER', 'webdev');
	define('DB_PASS', 'project123');

	try{
		// Try creating new PDO connection to MySQL
		$db = new PDO(DB_DSN,DB_USER,DB_PASS);
		//,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	}	catch(PDOException $e){
			print "Error: " . $e->getMessage();
			die(); //Force execution to stop on errors.
			//When deploying to production you should handle this situation more gracefully. 

	}

  ?>
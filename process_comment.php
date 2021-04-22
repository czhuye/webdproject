<?php    
    require('connect.php');

	include('apply_styles.html');
	include('admin_header.html');
    include('ImageResize.php');
    include('ImageResizeException.php');

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);
    
    //$filename = basename($_FILES['avatar']['name']);

    $filename = basename($_FILES['avatar']['name']);
    $newname = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR. $filename;

    move_uploaded_file($_FILES['avatar']['tmp_name'], $newname);
    $img = 'uploads' . DIRECTORY_SEPARATOR. $filename;

    $image = new \Gumlet\ImageResize('uploads/'.$_FILES['avatar']['name']);
    $image->resizeToHeight(100);
    $image->resizeToWidth(100);
    // $file = basename($filename);
    
    $path_parts = pathinfo($_FILES["avatar"]["name"]);
    $file = pathinfo($_FILES['avatar']['name'], PATHINFO_FILENAME);
    $extension = $path_parts['extension'];
    $image->save('uploads/'.$file.'_resized.'.$extension);

    //$avatar = filter_input(INPUT_POST, 'avatar', FILTER_SANITIZE_SPECIAL_CHARS);
    
    
    
    $newname = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR. $file;

    move_uploaded_file($_FILES['avatar']['tmp_name'], $newname);
    $avatar = 'uploads' . DIRECTORY_SEPARATOR. $file.'_resized.'.$extension;

    //echo $name;
    //echo $comment;
    //echo $avatar;

    $query = "INSERT INTO comment (name, avatar,comment) VALUES (:name, :avatar, :comment)";
    $statement = $db ->prepare($query);

    
    //Bind values to the parameters
    $statement->bindValue(':name', $name);
    $statement->bindValue(':avatar', $avatar);
    $statement->bindValue(':comment', $comment);

    $statement->execute();


    echo '<h2>Thank you for your comment</h2>';

    echo '<a href="index.php"><h3>Back to Homepage</h3></a>';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>WEB DEV Project</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
       
    </body>
</html>
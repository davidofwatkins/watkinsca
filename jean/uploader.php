<?php

if (!isset($_POST["uploader_name"])) { header("Location: index.php?error=Error: please enter a name"); exit(); }
if (!isset($_POST["uploadedpictures"]) && !isset($_POST["story"])) { header("Location: index.php?error=Error: please either write a testimonial or upload an image"); exit(); }

function checkImages($uploads) {
    
    foreach ($uploads as $file) {
        
        //If there is an error with the upload, report the error
        if ($file["error"] > 0) { header("Location: index.php?error=" . $file["error"]); }
        
        if ($file["size"] < 8388608) { //8 MB
            if ($file["type"] != "image/jpeg" && $file["type"] != "image/pjpeg" && $file["type"] != "image/gif" && $file["type"] != "image/png") {
                header("Location: index.php?error=Error: please make sure your file is a JPEG, GIF, or PNG");
                exit();
            }
        }
        else {
            header("Location: index.php?error=Error: please ensure that each of your pictures are under 8MB");
            exit();
        }
    }
}

function rearrange( $arr ){
    foreach( $arr as $key => $all ){
        foreach( $all as $i => $val ){
            $new[$i][$key] = $val;    
        }    
    }
    return $new;
}


$saveDirectory = "uploads/";
$name = $_POST["uploader_name"];
$escapedName = htmlspecialchars(str_replace(" ", "_", $name));

$uploads = rearrange($_FILES["uploadedpictures"]);

//If the user has uploaded picture(s), check them and save them to the server
if ($uploads[0]["name"] != "") {
    
    checkImages($uploads); //will die if problems
    
    foreach ($uploads as $file) {
        
        //Decide the extension
        $extension;
        if ($file["type"] == "image/jpeg" || $file["type"] == "image/pjpeg") { $extension = ".jpg"; }
        else if ($file["type"] == "image/gif") { $extension = ".gif"; }
        else if ($file["type"] == "image/png") { $extension = ".png"; }
        
        //Write the file
        move_uploaded_file($file["tmp_name"], $saveDirectory . $escapedName . "-" . uniqid() . $extension);
    }
}

if (isset($_POST["story"])) {
    
    $story = $_POST["story"];
    $story = htmlspecialchars($story);
    
    $db_name = "dwat91";
    $db_username = "dwat91";
    $db_pw = "Jean@1896";
    $db_address = "dwat91.db.6420271.hostedresource.com";
    
    //Connect to Database
    $db = new mysqli($db_address, $db_username, $db_pw, $db_name);
    if ($db->connect_errno) { die("Error: failed to connect to database: " . $mysqli->connect_error); }
    
    //when grabbing the story back from the database (necessary?) stripslashes($story) . "<br />";
    
    //Using prepared statements: http://mattbango.com/notebook/web-development/prepared-statements-in-php-and-mysqli/
    $statement = $db->prepare('INSERT INTO testimonies (name, testimony) VALUES (?, ?);');
    $statement->bind_param("ss", $escapedName, $story);
    $statement->execute();
    
    $db->close();
}

header("Location: index.php?msg=thankyou");


?>
<?php
    /**
     * https://bulba.site/lib2/engine/back/get-deadline.php?book=The%20Lean%20Startup%20-%20Erick%20Ries
     */
    $book = $_GET["book"];
    
    //$_SESSION['email'] = "prefixoid@gmail.com"; //DEBUG
    //read email
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } else {
        echo "Variable not set.";
        exit('email not set');
    }
        
    $shelf_path = "../../shelf/private/" . $email ."/";
    $deadline_file_path = $shelf_path . "deadline/" . $book;
    if (file_exists($deadline_file_path)) {
        $myfile = fopen($deadline_file_path, "r") or die("Unable to open file:" . $deadline_file_path);
        $deadline = trim(fgets($myfile));
    } else {
        $date = new DateTime();
        $date->modify('+1 month');
        $deadline = $date->format("d-m-Y");
    }

    echo json_encode(array("deadline" => $deadline));
?>

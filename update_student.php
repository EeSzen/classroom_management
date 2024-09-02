<?php

    // 1. collect database info
    $host = 'localhost';
    $database_name = "classroom_management"; // connecting to which database 
    $database_user = "root";
    $database_password = "password";

    // 2. connect to database (PDO - PHP database object)
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user, // username
        $database_password // password
    );

    $update_name = $_POST["updated_name"];
    $student_id = $_POST["student_id"];

    // check if name is not empty
    if(empty($update_name)){
        echo "PLEASE INSERT VALID NAME";
    }else{
         // update the name of the student
        // sql command (recipe)
        $sql = "UPDATE students SET name = :name WHERE id = :id";
        // prepare
        $query = $database -> prepare($sql);
        // execute
        $query->execute([
            'name' => $update_name,
            'id' => $student_id
        ]);

        // redirect
        header("Location: index.php");
        exit;
    }
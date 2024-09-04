<?php
    // start session(we will be starting a session)
    session_start();

    // 1. collect database info
    $host = "localhost";
    $database_name = "classroom_management"; // connecting to which database 
    $database_user = "root";
    $database_password = "password";

    // 2. connect to database (PDO - PHP database object)
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user, // username
        $database_password // password
    );

    // 3. get all the data from the login-up page form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4. check for error (make sure all fields are filled)
    if (empty( $email ) || empty( $password )) {
        echo "All the fields are required";
    }else{
     // 5. check if the email exist in the system or not
     // 5.1 sql command
        $sql = "SELECT * FROM users WHERE email =:email";
     // 5.2 prepare
        $query = $database -> prepare( $sql );
     // 5.3 execute
        $query -> execute([
            'email'=> $email
        ]);
     // 5.4 fetch
        $user = $query -> fetch();


        // check if user exist
        if ( $user ){
            // 6 . check if the password is correct or not
            if(password_verify($password, $user["password"])){
                // 7. login the user
                $_SESSION["user"] = $user;

                // 8. redirect the user back to index.php
                header("Location: index.php");
                exit; 
            }else{
                echo "The password provided is incorrect";
            };

        }else{
            echo "The Email Does Not Exist";
        }

   
}
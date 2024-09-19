<?php

class Student
{
    public $database;

    // run this code when the object is created
    function __construct() {
        $this->database = connectToDB();
}

    public function add(){
        // add function
        $name = $_POST["student_name"];

    //1.check whether the user insert a name
if(empty( $name )){
    echo "please insert a name";
}else{
    //2.add the student name to database
    //2.1 (recipe)
    $sql ='INSERT INTO students(`name`) VALUES (:name)';
    //2.2 (prepare)
    $query = $this->database->prepare( $sql );
    //2.3 (execute))
    $query->execute(
        ['name' => $name]
    );

    //3. redirect the user back to index.php
    header("Location: /");
    exit;
}
    }


    public function delete(){
        // delete function
        $student_id = $_POST["student_id"];

        // delete the selected student from the table using student ID
        // sql command (recipe)
        $sql = "DELETE FROM students where id = :id";
        // prepare 
        $query = $this->database->prepare( $sql );
        // execute
        $query->execute([
            'id' => $student_id
        ]);
    
        // redirect back to index.php
        header("Location: /");
        exit;
    }


    public function edit(){
        // edit function
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
            $query =$this->database -> prepare($sql);
            // execute
            $query->execute([
                'name' => $update_name,
                'id' => $student_id
            ]);
    
            // redirect
            header("Location: /");
            exit;
        }
    }
}
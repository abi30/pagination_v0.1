<?php
require_once 'dbconnect.php';


if ( isset($_POST['create'])) {
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    

    $sql = "INSERT INTO users (name, salary, email) VALUES (:name, :salary, :email)";

       $statement = $pdo->prepare( $sql );
        $statement->bindParam( ':name', $name );
        $statement->bindParam( ':salary', $salary );
        $statement->bindParam( ':email', $email );
       
        $statement->execute();
       
            header( "location:index.php" );

        $pdo = null;
} else {
    header( "location:error.php" );
}
?>
<?php
require_once 'dbconnect.php';


if ( isset($_POST['save'] )) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM users WHERE id = :id";


    $statement = $pdo->prepare( $sql);
    $statement->bindParam( ':id', $id );
    $statement->execute();
    $res = $statement->fetch( PDO::FETCH_ASSOC );

    if (count( $res )){
    
          $name = $res['name'];
          $salary = $res['salary'];
          $email = $res['email'];
          
          header( "location:index.php" );
    } else {
         header( "location: error.php" );
    }
    $pdo = null;
} else {
    header( "location: error.php" );
}
?>
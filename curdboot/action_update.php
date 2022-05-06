<?php
require_once 'dbconnect.php';


if (isset($_POST['savechanges']) ) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    //variable for upload pictures errors is initialized

$sql = "UPDATE users SET name = :name, salary = :salary ,email = :email  WHERE id = :id";

        $statement = $pdo->prepare( $sql );
    
        $statement->bindParam( ':name', $name );
        $statement->bindParam( ':salary', $salary );
        $statement->bindParam( ':email', $email );
        $statement->bindParam( ':id', $id );
        $res = $statement->execute();
       

        $class = "success";
        $message = "Successfully updated!";
        header( "location:index.php" );

     
        // $class = "danger";
        // $message =  print_r("Error while updating record : <br>" .implode(" ",$pdo->errorInfo()));
    
        echo "dsadfsd";
    
    $pdo = null;
} else {
  echo "error";
    // header( "location:error.php" );
}
?>
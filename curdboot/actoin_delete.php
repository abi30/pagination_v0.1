<?php


require_once 'dbconnect.php';



if ( isset($_POST['delete']) ) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $pdo->prepare( $sql );
    
        $statement->bindParam( ':id', $id );
        $statement->execute();
       header( "location:index.php" );
   $pdo = null;
} else {
    header( "location:error.php" );
}
?>
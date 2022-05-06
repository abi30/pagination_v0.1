<?php


require_once 'dbconnect.php';



if ( $_POST ) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $pdo->prepare( $sql );
    if ($pdo->prepare( $sql ) == true ) {
        $statement->bindParam( ':id', $id );
        $statement->execute();
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = print_r("The entry was not deleted due to: <br>" .implode(" ",$pdo->errorInfo()));
      //   $message = print_r( $dbh->errorInfo() );"The entry was not deleted due to: <br>" . $pdo->errorInfo();

    }
   $pdo = null;
} else {
    header( "location:error.php" );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Delete</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
   <div class="container">
      <div class="mt-3 mb-3">
         <h1>Delete request response</h1>
      </div>
      <div class="alert alert-<?=$class;?>" role="alert">
         <p><?php echo $message;?></p>
         <a href='index.php'><button class="btn btn-success" type='button'>Home</button></a>
      </div>
   </div>
</body>

</html>
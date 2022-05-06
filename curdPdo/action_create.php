<?php
require_once 'dbconnect.php';


if ( $_POST ) {
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    

    $sql = "INSERT INTO users (name, salary, email) VALUES (:name, :salary, :email)";

  $statement = $pdo->prepare( $sql );
  
    if ($pdo->prepare( $sql ) == true ) {
        $statement->bindParam( ':name', $name );
        $statement->bindParam( ':salary', $salary );
        $statement->bindParam( ':email', $email );
       
        $statement->execute();
        $class = "success";
       $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $salary </td>
            <td> $email </td>
            </tr></table>";
       
    } else {
        $class = "danger";
        $message = print_r( "Error while creating record. Try again: <br>" . implode( " ", $pdo->errorInfo() ) );
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
  <title>Update</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <div class="mt-3 mb-3">
      <h1>Create request response</h1>
    </div>
    <div class="alert alert-<?=$class;?>" role="alert">
      <p><?php echo ( $message ) ?? ''; ?></p>
      <p><?php echo ( $uploadError ) ?? ''; ?></p>
      <a href='index.php'><button class="btn btn-primary" type='button'>Home</button></a>
    </div>
  </div>
</body>

</html>
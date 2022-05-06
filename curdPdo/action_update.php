<?php
require_once 'dbconnect.php';


if ( $_POST ) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    //variable for upload pictures errors is initialized

$sql = "UPDATE users SET name =:name, salary =:salary ,email =:email  WHERE id =:id";

        $statement = $pdo->prepare( $sql );
    if ($pdo->prepare( $sql ) == true ) {
        $statement->bindParam( ':name', $name );
        $statement->bindParam( ':salary', $salary );
        $statement->bindParam( ':email', $email );
        $statement->bindParam( ':id', $id );
        $statement->execute();
        $class = "success";
        $message = "Successfully updated!";

    } else {
        $class = "danger";
        $message =  print_r("Error while updating record : <br>" .implode(" ",$pdo->errorInfo()));
    
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
      <h1>Update request response</h1>
    </div>
    <div class="alert alert-<?php echo $class; ?>" role="alert">
      <p><?php echo ( $message ) ?? ''; ?></p>
      <p><?php echo ( $uploadError ) ?? ''; ?></p>
      <a href='update.php?id=<?php echo $id ;?>'><button class="btn btn-warning" type='button'>Back</button></a>
      <a href='index.php'><button class="btn btn-success" type='button'>Home</button></a>
    </div>
  </div>
</body>

</html>
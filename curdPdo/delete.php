<?php
require_once 'dbconnect.php';


 $name = "";
 $salary = "";
 $email = "";
 $update = "";
if ( $_GET['id'] ) {
    $id = $_GET['id'];
    //  $sql = "SELECT * FROM users WHERE id = {$id}";

    $statement = $pdo->prepare( "SELECT * FROM users where id = :id" );
    $statement->bindParam( ':id', $id );
    $statement->execute();

    //  $res = $statement->fetchAll( PDO::FETCH_ASSOC );
    $res = $statement->fetch( PDO::FETCH_ASSOC );

    if ( count( $res ) ) {
      //   foreach ( $res as $key => $data ) {

      //    var_dump($res);
      //    exit;
            $name = $res['name'];
            $salary = $res['salary'];
            $email = $res['email'];
            $update = $res['update_at'];
      //   }

    } else {
        header( "location:error.php" );
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
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Delete Product</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <style type="text/css">
   fieldset {
      margin: auto;
      margin-top: 100px;
      width: 70%;
   }

   .img-thumbnail {
      width: 70px !important;
      height: 70px !important;
   }
   </style>
</head>

<body>
   <fieldset>
      <legend class='h2 mb-3'>Delete request</legend>
      <h5>You have selected the data below:</h5>
      <table class="table w-75 mt-3">
         <tr>
            <td><?php echo $name ?></td>
            <td><?php echo $salary ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $update ?></td>
         </tr>
      </table>

      <h3 class="mb-4">Do you really want to delete this product?</h3>
      <form action="actoin_delete.php" method="post">
         <input type="hidden" name="id" value="<?php echo $id ?>" />
         <button class="btn btn-danger" type="submit">Yes, delete it!</button>
         <a href="index.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
      </form>
   </fieldset>
</body>

</html>
<?php
require_once 'dbconnect.php';

if ( $_GET['id'] ) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id";



    $statement = $pdo->prepare( $sql);
    $statement->bindParam( ':id', $id );
    $statement->execute();
    $res = $statement->fetch( PDO::FETCH_ASSOC );

    if (count( $res )){
    
          $name = $res['name'];
          $salary = $res['salary'];
          $email = $res['email'];
     
    } else {
        header( "location: error.php" );
    }
    $pdo = null;
} else {
    header( "location: error.php" );
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Product</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style type="text/css">
  fieldset {
    margin: auto;
    margin-top: 100px;
    width: 60%;
  }

  .img-thumbnail {
    width: 70px !important;
    height: 70px !important;
  }
  </style>
</head>

<body>
  <fieldset>
    <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='profile.png'></legend>
    <form action="action_update.php" method="post" enctype="multipart/form-data">
      <table class="table">
        <tr>
          <th>Name</th>
          <td><input class="form-control" type="text" name="name" placeholder="Product Name"
              value="<?php echo $name ?>" /></td>
        </tr>
        <tr>
          <th>Salary</th>
          <td><input class="form-control" type="number" step="0.01" name="salary" step="any" placeholder="Salary"
              value="<?php echo $salary ?>" /></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><input class="form-control" type="email" name="email" step="any" placeholder="Email"
              value="<?php echo $email ?>" /></td>
        </tr>

        <tr>
          <input type="hidden" name="id" value="<?php echo  $id;?>" />
          <td><button class="btn btn-success" type="submit">Save Changes</button></td>
          <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
        </tr>
      </table>
    </form>
  </fieldset>
</body>

</html>
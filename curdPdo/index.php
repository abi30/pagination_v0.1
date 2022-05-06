<?php 
require_once "dbconnect.php";

$statement = $pdo->prepare( "SELECT * FROM users ORDER BY id DESC" );
$statement->execute();

$res = $statement->fetchAll( PDO::FETCH_ASSOC );
// print_r( $res );
// exit;

//  $tablebody = "";
// foreach ( $res as $row ) {
    


   
// }

// // or with the fetch method
// while ( $row = $statement->fetch() ) {
//     // do something with $row
// }


?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <div class="table-responsive">

          <div class='mb-3'>

            <a href="create.php"><button class='btn btn-primary' type="button">Add product</button></a>
          </div>
          <p class='h2'>Products</p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>salary</th>
                <th>Email</th>
                <th>date_update</th>
                <th>action</th>

            </thead>
            <tbody>
              <?php
if ( is_array( $res ) ) {
    $sn = 1;
    foreach ( $res as $data ) {
        ?>
              <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $data['name'] ?? ''; ?></td>
                <td><?php echo $data['salary'] ?? ''; ?></td>
                <td><?php echo $data['email'] ?? ''; ?></td>
                <td><?php echo $data['update_at'] ?? ''; ?></td>

                <td><a href='update.php?id=<?php echo $data["id"];?>'><button class='btn btn-primary btn-sm'
                      type='button'>Edit</button></a>
                  <a href='delete.php?id=<?php echo $data["id"];?>'><button class=' btn btn-danger btn-sm'
                      type='button'>Delete</button></a>
                </td>

              </tr>
              <?php
$sn++;}} else {?>
              <tr>
                <td colspan="8">
                  <?php echo $res; ?>
                </td>
              <tr>
                <?php
}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
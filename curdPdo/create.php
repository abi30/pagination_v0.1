<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>PHP CRUD | Add User</title>
  <style>
  fieldset {
    margin: auto;
    margin-top: 100px;
    width: 60%;
  }
  </style>
</head>

<body>
  <fieldset>
    <legend class='h2'>Add user</legend>
    <form action="action_create.php" method="post" enctype="multipart/form-data">
      <table class='table'>
        <tr>
          <th>Name</th>
          <td><input class='form-control' type="text" name="name" placeholder="User Name" required /></td>
        </tr>
        <tr>
          <th>salary</th>
          <td><input class='form-control' type="number" name="salary" placeholder="Salary" step="any" required /></td>
        </tr>
        <tr>
          <th>email</th>
          <td><input class='form-control' type="email" name="email" placeholder="example@email.com" required /></td>
        </tr>
        <tr>
          <td><button class='btn btn-success' type="submit">Insert User</button></td>
          <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
        </tr>
      </table>
    </form>
  </fieldset>
</body>

</html>
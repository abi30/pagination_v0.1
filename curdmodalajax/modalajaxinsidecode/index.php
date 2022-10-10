<?php
require_once("./deletecode.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> PHP CRUD with Bootstrap Modal </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>




    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <h2> PHP CRUD Bootstrap MODAL (POP UP Modal) </h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <?php
                    $connection = mysqli_connect("localhost", "root", "");
                    $db = mysqli_select_db($connection, 'modalajax');

                    $query = "SELECT * FROM student";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <table id="datatableid" class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th scope="col"> ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name </th>
                                <th scope="col"> Course </th>
                                <th scope="col"> Contact </th>
                                <th scope="col"> VIEW </th>
                                <th scope="col"> EDIT </th>
                                <th scope="col"> DELETE </th>
                            </tr>
                        </thead>
                        <?php
                        if ($query_run) {
                            foreach ($query_run as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['fname']; ?> </td>
                                <td> <?php echo $row['lname']; ?> </td>
                                <td> <?php echo $row['course']; ?> </td>
                                <td> <?php echo $row['contact']; ?> </td>
                                <td>
                                    <button type="button" class="btn btn-info viewbtn"> VIEW </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn" data-toggle="modal"
                                        data-target="#deletemodal<?php echo $row['id']; ?>"> DELETE
                                    </button>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?php echo $row['id']; ?>">
                                        DELETE
                                    </button>

                                </td>
                                <div>
                                    <form action="deletecode.php" method="POST">
                                        <input type="hidden" name="delete_id" id="delete_id"
                                            value="<?php echo $row['id']; ?>">
                                        <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">user Id
                                                            <?php echo $row['id']; ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $row['fname'] . " " . $row['lname'] . " and dep <b>" . $row['course'] . "</b>"; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="deletedata1"
                                                            class="btn btn-primary">Delete
                                                            user</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </tr>
                        </tbody>








                        <?php
                            }
                        } else {
                            echo "No Record Found";
                        }
                        ?>
                    </table>
                </div>
            </div>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
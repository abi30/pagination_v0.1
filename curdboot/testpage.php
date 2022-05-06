<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once "dbconnect.php";




if (isset($_GET['page']) && ($_GET['page'] > 0)) {

    $page = (int) $_GET['page'];
    // if (!(($page >= 1) && ($page <= 20)) || ($page == "")) $page = 1;
} else {
    $page = 1;
}
$limit = 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM users order by id DESC LIMIT :offset, :limit";

$statement = $pdo->prepare($sql);

$statement->execute([
    'offset' => $offset,
    'limit'  => $limit,
]);
$res = $statement->fetchAll(PDO::FETCH_ASSOC);


// echo "<pre>";
// print_r($res);
// echo "</pre>";


// for count of number of rows
$sqlall = "SELECT * FROM users ORDER BY id DESC";
$statement = $pdo->prepare($sqlall);
$statement->execute();
$resall = $statement->fetchAll(PDO::FETCH_ASSOC);
$numRows = count($resall);
// echo $numRows;
// exit;
function paging($limit, $numRows, $page)
{

    $allPages       = ceil($numRows / $limit);
    $start          = ($page - 1) * $limit;

    $querystring = "";

    if ($numRows > $limit) {

        if ($page > 1) {
            $prev = $page - 1;
            echo '<li  class="page-item"><a class="page-link" href="testpage.php?page=1">First</a></li>';
            echo '<li class="page-item"><a class="page-link" href="testpage.php?' . $querystring . 'page=' . $prev . '" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span></a>
              </li>';
        }
        // if ($allPages <= 10){}

        $class = "";
        for ($i = 1; $i <= $allPages; $i++) {

            // if ($i > 5 && $i < 10) {
            if ($i == $page) {
                $class = "active";
            }

            echo '<li id="btn' . $i . '" class="page-item ' . $class . '"><a  class="page-link" href="testpage.php?page=' . $i . '">' . $i . '</a></li>';
            $class = "";
            // } else {

            // if ($i == $page) {
            //     $class = "active";
            // }
            // echo '<li id="btn' . $i . '" class="page-item ' . $class . '"><a  class="page-link" href="testpage.php?page=' . $i . '">' . $i . '</a></li>';
            // $class = "";

        }
        if ($page < $allPages) {
            $next = $page + 1;
            echo '<li class="page-item">
             <a  class="page-link" href="testpage.php?' . $querystring . 'page=' . $next . '" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
            </li>';

            echo '<li class="page-item"><a class="page-link" href="testpage.php?page=' . $allPages . '">Last</a>';
        }
    }

    // return $paginHTML;
}



// -----------------------



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">

        <nav aria-label="...">
            <ul class="pagination">

                <?php
                echo paging($limit, $numRows, $page);

                ?>
            </ul>
        </nav>
        <table class="table table-bordered" style="margin-left:auto;margin-right:auto;">
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
                if (is_array($res)) {
                    $sn = 1;
                    foreach ($res as $data) {
                ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $data['id'] ?? ''; ?></td>
                            <td><?php echo $data['salary'] ?? ''; ?></td>
                            <td><?php echo $data['email'] ?? ''; ?></td>
                            <td><?php echo $data['update_at'] ?? ''; ?></td>

                            <!-- action edit and delate -->
                            <td><a value="<?php echo $data["id"]; ?>">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data["id"]; ?>">
                                        Edit
                                    </button></a>

                                <!-- Modal edit -->
                                <div class=" modal fade" id="edit<?php echo $data["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">


                                                <form id="myForm" class="needs-validation" action="action_update.php" method="POST">
                                                    <div class="container">

                                                        <div class="form-group row pt-2">
                                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="name_id" name="name" placeholder="Enter your Name" value="<?php echo $data['name'] ?? ''; ?>" required />
                                                                <div class="invalid-feedback">
                                                                    Please choose a Name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row pt-2">
                                                            <label for="salary" class="col-sm-2 col-form-label">Salary</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="100" step="any" class="form-control" id="salary_id" name="salary" placeholder="Enter your Salary" value="<?php echo $data['salary'] ?? ''; ?>" required />
                                                                <div class="invalid-feedback">
                                                                    Please choose a number.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row pt-2">
                                                            <label for="email" class="col-sm-2 col-form-label">email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" id="email_id" name="email" placeholder="example@email.com" value="<?php echo $data['email'] ?? ''; ?>" required />
                                                                <div class="invalid-feedback">
                                                                    Please put emailadress
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                                                        <div class="text-center pt-4">
                                                            <button class="btn btn-success" type="submit" id="save" name="savechanges">Save
                                                                changes</button>
                                                        </div>

                                                    </div>
                                                </form>



                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ------delete button start -------------- -->
                                <a value="<?php echo $data["id"]; ?>">
                                    <button type="button" class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#delete<?php echo $data["id"]; ?>">
                                        Delate
                                    </button></a>

                                <!-- Modal delete -->
                                <div class=" modal fade" id="delete<?php echo $data["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="myForm" class="needs-validation" method="POST" action="actoin_delete.php">
                                                    <div class="container">

                                                        <div class="form-group row p-2">
                                                            <label for="id" class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="name_id" name="name" placeholder="Enter your Name" value="<?php echo $data['name'] ?? ''; ?>" readonly />
                                                                <div class="invalid-feedback">
                                                                    Please choose a Name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row p-2">
                                                            <label for="id" class="col-sm-2 col-form-label">Salary</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" step="any" class="form-control" id="salary_id" name="salary" placeholder="Enter your Salary" value="<?php echo $data['salary'] ?? ''; ?>" readonly />
                                                                <div class="invalid-feedback">
                                                                    Please choose a number.
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row p-2 ">
                                                            <label for="id" class="col-sm-2 col-form-label">email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" id="email_id" name="email" placeholder="example@email.com" value="<?php echo $data['email'] ?? ''; ?>" readonly />
                                                                <div class="invalid-feedback">
                                                                    Please put emailadress
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

                                                        <div class="text-center  p-4 ">
                                                            <button class="btn btn-danger" name="delete" type="submit">delete</button>
                                                        </div>
                                                    </div>
                                                </form>



                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </td>

                        </tr>






                    <?php
                        $sn++;
                    }
                } else { ?>
                    <tr>
                        <td colspan="8">
                            <?php echo $res; ?>
                        </td>
                    <tr>
                    <?php
                } ?>
            </tbody>
        </table>

        <!-- <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li> -->



        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    </div>

</body>

</html>


<!--  if ($page > 1) {

            echo '<li  class="page-item"><a class="page-link" href="index.php?page=1">First</a></li>';
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page - 1) . '" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>';






      for ($i = $start_loop; $i <= $end_loop; $i++) {
            echo '<li id="btn' . $i . '" class="page-item"><a  class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($page <= $end_loop) {

            echo '<li class="page-item">
        <a  class="page-link" href="index.php?page=' . ($page + 1) . '" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>';

            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $total_pages . '">Last</a>';
        }

         if ($page > 1) {
            $prev = $i - 1;

            // echo '<li class="page-item">
            //         <a class="page-link" href="testpage.php?page=1" tabindex="-1" aria-disabled="true">Previous</a>
            //     </li>';
            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="testpage.php?' . $querystring . 'page=' . $prev . '">dsfdss</a></li>';

            break;


            // $paginHTML .= '<li class="page-item active" aria-current="page"><a class="page-link" href="testpage.php?' . $querystring . 'page=' . $prev . '"></a></li>';

            // $paginHTML .= '<li  class="page-item"><a class="page-link" href="testpage.php?page=1">First</a></li>';
            // $paginHTML .= '<li class="page-item"><a class="page-link"href="testpage.php?' . $querystring . 'page=' . $prev . '"" aria-label="Previous">
            //                <span aria-hidden="true">&laquo;</span>';
        }



          if ($page > 1) {
        $prev = $page - 1;

        // echo '<li class="page-item">
        //         <a class="page-link" href="testpage.php?page=1" tabindex="-1" aria-disabled="true">Previous</a>
        //     </li>';
        echo '<li class="page-item active" aria-current="page"><a class="page-link" href="testpage.php?' . $querystring . 'page=' . $prev . '">dsfdss</a></li>';

        // $paginHTML .= '<li class="page-item active" aria-current="page"><a class="page-link" href="testpage.php?' . $querystring . 'page=' . $prev . '"></a></li>';

        // $paginHTML .= '<li  class="page-item"><a class="page-link" href="testpage.php?page=1">First</a></li>';
        // $paginHTML .= '<li class="page-item"><a class="page-link"href="testpage.php?' . $querystring . 'page=' . $prev . '"" aria-label="Previous">
        //                <span aria-hidden="true">&laquo;</span>';
    }






    if ($page < $allPages) {
        $next = $page + 1;
        echo '<li  class="page-item"><a class="page-link" href="testpage.php?page=' . $allPages . '">Last</a></li>';
        echo '<li class="page-item"><a class="page-link" href="testpage.php?' . $querystring . 'page=' . $next . '" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span></a>
              </li>';
    }
        } -->
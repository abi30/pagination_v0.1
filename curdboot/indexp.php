<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once "dbconnect.php";

// function paging($limit, $numRows, $page)
// {

//     $allPages       = ceil($numRows / $limit);

//     $start          = ($page - 1) * $limit;

//     $querystring = "";

//     foreach ($_GET as $key => $value) {
//         if ($key != "page") $paginHTML .= "$key=$value&amp;";
//     }

//     $paginHTML = "";

//     $paginHTML .= "Pages: ";

//     for ($i = 1; $i <= $allPages; $i++) {
//         if ($i > 1) {
//             $prev = $i - 1;
//             $paginHTML .= '<a href="indexp.php?' . $querystring . 'page=' . $prev . '">Previous</a>';
//         }
//         $paginHTML .= "<a " . ($i == $page ? "class=\"selected\" " : "");
//         $paginHTML .= "href=\"?{$querystring}page=$i";
//         $paginHTML .= "\">$i</a> ";
//         if ($i < $allPages) {
//             $next = $i + 1;
//             $paginHTML .= '<a href="indexp.php?' . $querystring . 'page=' . $next . '">Next</a>';
//         }
//     }

//     return $paginHTML;
// }

$page = 1;
if (isset($_GET['page'])) {
    $page = (int) $_GET['page'];
}
$limit = 10;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM users order by id DESC LIMIT :offset, :limit";
// order by id DESC

$statement = $pdo->prepare($sql);

$statement->execute([
    'offset' => $offset,
    'limit'  => $limit,
]);
//  ORDER BY id DESC

$res = $statement->fetchAll(PDO::FETCH_ASSOC);


echo "<pre>";
print_r($res);
echo "</pre>";
exit;

$record_per_page = 5;
$page = '';

if (isset($_GET["page"]) && !empty($_GET["page"])) {

    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

// echo $start_from."---".$record_per_page;
// exit;

$sql = "SELECT * FROM users order by id DESC LIMIT $start_from, $record_per_page";

// $statement = $pdo->prepare( "SELECT * FROM users WHERE 1 = 1 LIMIT 0,5" );
$statement = $pdo->prepare($sql);

$statement->execute();
//  ORDER BY id DESC

$res = $statement->fetchAll(PDO::FETCH_ASSOC);

// $per_page = 5;
$countRow = count($res);
// $pages = ceil($countRow/$per_page);

// echo $pages;
// exit;

// require_once "update.php";
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>user Datails</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">User details Table</h1>
        <!-- Vertically centered modal -->
        <!-- Button trigger modal -->
        <div class=" text-center pb-4">
            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModalsave">
                create Employee
            </button>
        </div>

        <div class="row">
            <div class="col-md-4 mx-auto">

                <nav id="navBar" aria-label="Page navigation example">
                    <ul class="pagination">

                        <?php
                        $sqlall = "SELECT * FROM users ORDER BY id DESC";
                        $statement = $pdo->prepare($sqlall);
                        $statement->execute();
                        //  ORDER BY id DESC
                        $resall = $statement->fetchAll(PDO::FETCH_ASSOC);

                        $total_records = count($resall);
                        $total_pages = ceil($total_records / $record_per_page);
                        $start_loop = $page;
                        $difference = $total_pages - $page;
                        if ($difference <= 5) {
                            $start_loop = $total_pages - 5;
                        }
                        $end_loop = $start_loop + 4;
                        if ($page > 1) {

                            echo '<li  class="page-item"><a class="page-link" href="index.php?page=1">First</a></li>';
                            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page - 1) . '" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>';
                        }
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

                        ?>

                    </ul>
                </nav>
            </div>

        </div>


        <!-- Modal edit -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <form id="myForm" class="needs-validation" novalidate>
                            <div class="container">

                                <div class="form-group row">
                                    <label for="id" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_id" name="name"
                                            placeholder="Enter your Name" required />
                                        <div class="invalid-feedback">
                                            Please choose a Name.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id" class="col-sm-2 col-form-label">Salary</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" class="form-control" id="salary_id"
                                            name="salary" placeholder="Enter your Salary" required />
                                        <div class="invalid-feedback">
                                            Please choose a number.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="validationCustomUsername" class="col-sm-2 col-form-label">email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="username_id" name="Username"
                                            placeholder="example@email.com" aria-describedby="inputGroupPrepend"
                                            required>
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>

                </div>
            </div>
        </div>



        <!-- create modal -->
        <div class="modal fade" id="exampleModalsave" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Employee create</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">


                        <div class="d-flex main-content">
                            <div class="content-text p-4">
                                <p>All their equipment and instruments are alive. The sky was cloudless and of a deep
                                    dark blue.</p>

                                <form id="create" name="create" class="needs-validation" action="action_create.php"
                                    method="POST">

                                    <div class="form-group">
                                        <label for="name">Username</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter employee name" name="name" data-validate="alphaOnly" />
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">Salary</label>
                                        <input type="text" class="form-control" id="salary"
                                            placeholder="Salary of Employee" name="salary" data-validate="floatOnly" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Enter email"
                                            name="email" data-validate="emailOnly" />
                                    </div>

                                    <div class="form-group d-flex align-items-center">
                                        <div class="text-center pt-2">
                                            <button class="btn btn-success" type="submit" id="save"
                                                name="create">Create</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>


                </div>
            </div>
        </div>

        <!-- ============================================================ -->


        <!-- <div class="row text-center"> -->
        <div class="col-sm-8 mx-auto">
            <div class="table-responsive">
                <!-- <div class='mb-3'>

          <a href="create.php"><button class='btn btn-primary' type="button">Add product</button></a>
        </div> -->
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
                            <td><?php echo $data['name'] ?? ''; ?></td>
                            <td><?php echo $data['salary'] ?? ''; ?></td>
                            <td><?php echo $data['email'] ?? ''; ?></td>
                            <td><?php echo $data['update_at'] ?? ''; ?></td>

                            <!-- action edit and delate -->
                            <td><a value="<?php echo $data["id"]; ?>">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit<?php echo $data["id"]; ?>">
                                        Edit
                                    </button></a>

                                <!-- Modal edit -->
                                <div class=" modal fade" id="edit<?php echo $data["id"]; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">


                                                <form id="myForm" class="needs-validation" action="action_update.php"
                                                    method="POST">
                                                    <div class="container">

                                                        <div class="form-group row pt-2">
                                                            <label for="name"
                                                                class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="name_id"
                                                                    name="name" placeholder="Enter your Name"
                                                                    value="<?php echo $data['name'] ?? ''; ?>"
                                                                    required />
                                                                <div class="invalid-feedback">
                                                                    Please choose a Name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row pt-2">
                                                            <label for="salary"
                                                                class="col-sm-2 col-form-label">Salary</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="100" step="any"
                                                                    class="form-control" id="salary_id" name="salary"
                                                                    placeholder="Enter your Salary"
                                                                    value="<?php echo $data['salary'] ?? ''; ?>"
                                                                    required />
                                                                <div class="invalid-feedback">
                                                                    Please choose a number.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row pt-2">
                                                            <label for="email"
                                                                class="col-sm-2 col-form-label">email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" id="email_id"
                                                                    name="email" placeholder="example@email.com"
                                                                    value="<?php echo $data['email'] ?? ''; ?>"
                                                                    required />
                                                                <div class="invalid-feedback">
                                                                    Please put emailadress
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id"
                                                            value="<?php echo $data['id']; ?>" />
                                                        <div class="text-center pt-4">
                                                            <button class="btn btn-success" type="submit" id="save"
                                                                name="savechanges">Save
                                                                changes</button>
                                                        </div>

                                                    </div>
                                                </form>



                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ------delete button start -------------- -->
                                <a value="<?php echo $data["id"]; ?>">
                                    <button type="button" class="btn btn-danger btn-sm " data-bs-toggle="modal"
                                        data-bs-target="#delete<?php echo $data["id"]; ?>">
                                        Delate
                                    </button></a>

                                <!-- Modal delete -->
                                <div class=" modal fade" id="delete<?php echo $data["id"]; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="myForm" class="needs-validation" method="POST"
                                                    action="actoin_delete.php">
                                                    <div class="container">

                                                        <div class="form-group row p-2">
                                                            <label for="id" class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="name_id"
                                                                    name="name" placeholder="Enter your Name"
                                                                    value="<?php echo $data['name'] ?? ''; ?>"
                                                                    readonly />
                                                                <div class="invalid-feedback">
                                                                    Please choose a Name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row p-2">
                                                            <label for="id"
                                                                class="col-sm-2 col-form-label">Salary</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" step="any" class="form-control"
                                                                    id="salary_id" name="salary"
                                                                    placeholder="Enter your Salary"
                                                                    value="<?php echo $data['salary'] ?? ''; ?>"
                                                                    readonly />
                                                                <div class="invalid-feedback">
                                                                    Please choose a number.
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row p-2 ">
                                                            <label for="id"
                                                                class="col-sm-2 col-form-label">email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control" id="email_id"
                                                                    name="email" placeholder="example@email.com"
                                                                    value="<?php echo $data['email'] ?? ''; ?>"
                                                                    readonly />
                                                                <div class="invalid-feedback">
                                                                    Please put emailadress
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id"
                                                            value="<?php echo $data['id']; ?>" />

                                                        <div class="text-center  p-4 ">
                                                            <button class="btn btn-danger" name="delete"
                                                                type="submit">delete</button>
                                                        </div>
                                                    </div>
                                                </form>



                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
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
            </div>
        </div>
    </div>
    <!-- </div> -->



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
  </script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


    <script>
    $(document).ready($(function() {

        $("#navBar").on('click', 'li', function() {
            $("#navBar li.active").removeClass("active");
            $(this).addClass("active");
        });
    }));
    </script>



    <script>
    $(document).ready(function() {

        var $form = $("#create"),
            $successMsg = $(".alert");
        $.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
        });
        $.validator.addMethod("floatnumber", function(value, element) {
            return this.optional(element) || value == value.match(/^[0-9\.]*$/);
            // /^[0-9\s.]*$/
        });
        $.validator.addMethod("checkemail", function(value, element) {
            return this.optional(element) || value == value.match(
                /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/);
        });



        $form.validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    letters: true
                },
                salary: {
                    required: true,
                    minlength: 3,
                    floatnumber: true
                },
                email: {
                    required: true,
                    email: true
                    // checkemail:true
                }
            },
            messages: {
                name: "Please specify your name (only letters and spaces are allowed)",
                salary: "plase specify a valid number",
                email: "Please specify a valid email address"
            },
            submitHandler: function(form) {
                // $successMsg.show();
                form.submit();
            }
        });



    });
    </script>

    <style>
    .error {
        color: rgb(214, 122, 127);
    }

    .active {
        background-color: aquamarine !important;
    }
    </style>

</body>

</html>
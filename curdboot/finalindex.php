<?php

require_once "db.class.php";




if (isset($_GET['page']) && ($_GET['page'] > 0)) {

    $page = (int) $_GET['page'];
} else {
    $page = 1;
}
$conn = new DB();
$limit = 5;
$offset = ($page - 1) * $limit;
$searchVal = "";


if (isset($_POST['filter'])) {
    $searchVal = $_POST['group'];

    $pagination = $conn->countRowWithValue($searchVal);
    $pageBody =  $conn->showPerPageData($limit, $offset, $searchVal);
}

$pagination = $conn->countRowWithValue($searchVal);
$pageBody =  $conn->showPerPageData($limit, $offset, $searchVal);




// print_r($list["result"]);

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

    <title>Hello, world!</title>
</head>

<body>

    <div class="container">
        <h1 class="mt-2 mb-3 text-center text-primary">Pagination</h1>
        <div class="row">
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-6">
                <form method="POST" action="">

                    <select name="group" class="form-select" id="select_box">
                        <option value="">Select group</option>
                        <?php
                        $retvel = $conn->searchForGroup($searchVal);
                        foreach ($retvel['retval'] as $row) {
                            echo '<option value="' . $row["group_name"] . '">' . $row["group_name"] . '</option>';
                        }
                        ?>
                    </select>
                    <button class="btn btn-primary" name="filter">Filter</button>
                    <button class="btn btn-success" name="reset">Reset</button>
                </form>
            </div>
            <div class="col-md-3">&nbsp;</div>
        </div>
        <br />
        <br />


        <nav aria-label="...">
            <ul class="pagination">

                <?php
                // echo ($list['count']);
                $conn->paging(5, $pagination['count'], $page);
                ?>
            </ul>
        </nav>

        <table class="table table-bordered" style="margin-left:auto;margin-right:auto;">
            <thead>
                <tr>
                    <th scope="col">#sn</th>
                    <th scope="col">Id</th>
                    <th scope="col">name</th>
                    <th scope="col">salary</th>
                    <th scope="col">email</th>
                    <th scope="col">group</th>
                    <th scope="col">update_at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($pageBody['result'])) {
                    $sn = 1;
                    foreach ($pageBody['result'] as $data) {

                ?>
                <tr>
                    <td><?php echo $sn; ?></td>
                    <td><?php echo $data['id'] ?? ''; ?></td>
                    <td><?php echo $data['name'] ?? ''; ?></td>
                    <td><?php echo $data['salary'] ?? ''; ?></td>
                    <td><?php echo $data['email'] ?? ''; ?></td>
                    <td><?php echo $data['group_name'] ?? ''; ?></td>
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
                                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="name_id" name="name"
                                                            placeholder="Enter your Name"
                                                            value="<?php echo $data['name'] ?? ''; ?>" required />
                                                        <div class="invalid-feedback">
                                                            Please choose a Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row pt-2">
                                                    <label for="salary" class="col-sm-2 col-form-label">Salary</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" min="100" step="any" class="form-control"
                                                            id="salary_id" name="salary" placeholder="Enter your Salary"
                                                            value="<?php echo $data['salary'] ?? ''; ?>" required />
                                                        <div class="invalid-feedback">
                                                            Please choose a number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row pt-2">
                                                    <label for="email" class="col-sm-2 col-form-label">email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="email_id"
                                                            name="email" placeholder="example@email.com"
                                                            value="<?php echo $data['email'] ?? ''; ?>" required />
                                                        <div class="invalid-feedback">
                                                            Please put emailadress
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
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
                                                        <input type="text" class="form-control" id="name_id" name="name"
                                                            placeholder="Enter your Name"
                                                            value="<?php echo $data['name'] ?? ''; ?>" readonly />
                                                        <div class="invalid-feedback">
                                                            Please choose a Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row p-2">
                                                    <label for="id" class="col-sm-2 col-form-label">Salary</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" step="any" class="form-control"
                                                            id="salary_id" name="salary" placeholder="Enter your Salary"
                                                            value="<?php echo $data['salary'] ?? ''; ?>" readonly />
                                                        <div class="invalid-feedback">
                                                            Please choose a number.
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row p-2 ">
                                                    <label for="id" class="col-sm-2 col-form-label">email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="email_id"
                                                            name="email" placeholder="example@email.com"
                                                            value="<?php echo $data['email'] ?? ''; ?>" readonly />
                                                        <div class="invalid-feedback">
                                                            Please put emailadress
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
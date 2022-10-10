<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'modalajax');

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];

    // print_r("test" . $id);
    // exit();
    $query = "DELETE FROM student WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        // echo '<script> alert("Data Deleted"); </script>';
        header("Location:index.php");
        echo '<script type="text/javascript">';
        echo ' alert("JavaScript Alert Box by PHP")';  //not showing an alert box.
        echo '</script>';
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'modalajax');

if (isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];

    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $course = htmlspecialchars($_POST['course']);
    $contact = htmlspecialchars($_POST['contact']);

    $query = "UPDATE student SET fname='$fname', lname='$lname', course='$course', contact=' $contact' WHERE id='$id'  ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location:index.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
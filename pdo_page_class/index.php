<?php
require_once "database.class.php";
require_once "page.class.php";

$db = new Database();
$db->getAllRecords('users', '*', ', 'id', ' ', '');
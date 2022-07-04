<?php
session_start();
//MySQL database connection:
$database = mysqli_connect('localhost', 'root', '', 'krepsinis');
//Pagination
$page = $_REQUEST['page'] ?? null;
$count = 0;
function isLogged(): bool
{
    if (isset($_SESSION['name'])) {
        return true;
    } else {
        return false;
    }
}
?>
<?php
include_once 'functions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Darbuotojų užduočių valdymo panelė</title>
</head>
<body>
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        text-align: center;
        padding: 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: silver;
    }
    a{
        border: 2px black solid;
        border-radius: 5px;
        padding: 5px;
        color: black;
        text-decoration: none;
    }
    tr {
        display: flex;
        justify-content: space-around;
        border: black 2px solid;
    }
    td {
        width: 150px;
        padding: 5px;
        max-width: 255px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    table {
        width: 1200px;
        margin-top: 20px
    }
    section{
        display: flex;
        justify-content: space-between;
    }
    footer{
        text-align: right;
    }
    body {
        margin: 0 auto;
        margin-top: 20px;
        width: 1200px;
    }
</style>
<div>
    <a href="index.php">Assignments</a>
    <a href="index.php?page=archive">Archive</a>
    <a href="export.php">Export Archive to CSV</a>

</div>
<hr>
<?php
if ($page === null) {
    include 'pages/assignments.php';
} elseif ($page === 'archive') {
    include 'pages/archive.php';
} elseif ($page === 'new_employee') {
    include 'pages/new_employee.php';
} elseif ($page === 'new_assignment') {
    include 'pages/new_assignment.php';
}
?>
<br/><br/>
<hr>
<footer>Date: <?php echo date('Y-m-d h:i:s');?></footer>
</body>
</html>
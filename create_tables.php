<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codeacademyproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = 'CREATE TABLE assigned_employees (
                                    id int(11) AUTO_INCREMENT PRIMARY KEY ,
                                    assignment_id int(11) DEFAULT NULL,
                                    employee_id int(11) DEFAULT NULL,
                                    assignment_start datetime DEFAULT NULL,
                                    assignment_finish datetime DEFAULT NULL
);
';

$sql1 = 'CREATE TABLE assignments (
                             id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                             title text DEFAULT NULL,
                             created_at timestamp NOT NULL DEFAULT current_timestamp(),
                             completed_at datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
);
';

$sql2 = 'CREATE TABLE employees (
                           id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                           name varchar(100) DEFAULT NULL,
                           last_name varchar(100) DEFAULT NULL,
                        is_multitasker tinyint(4) DEFAULT NULL
);
';


if ($conn->query($sql) === TRUE) {
    echo "Table assigned_employees created successfully, ";
} else {
    echo "Error creating table: " . $conn->error;
}

if (($conn->query($sql1) === TRUE)) {
    echo "Table assignments created successfully, ";
} else {
    echo "Error creating table: " . $conn->error;
}

if (($conn->query($sql2) === TRUE)) {
    echo "Table employees created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$conn->close();
?>
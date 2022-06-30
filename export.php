<?php


// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "codeacademyproject";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch records from database
$query = $db->query("select assignments.id, assignments.title, group_concat(SPACE(1),employees.name,SPACE(1), employees.last_name separator ' ') as name, assignments.created_at, assignments.completed_at
FROM assignments, employees, assigned_employees
WHERE employees.id = assigned_employees.employee_id
  AND assigned_employees.assignment_id = assignments.id
  AND created_at < completed_at
group by assignments.id;");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "Archive_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('id', 'title', 'name', 'created_at', 'completed_at');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['id'], $row['title'], $row['name'], $row['created_at'], $row['completed_at']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>
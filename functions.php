<?php
//MySQL database connection:
$database = mysqli_connect('localhost', 'root', '', 'codeacademyproject');
//Pagination
$page = $_REQUEST['page'] ?? null;
//Archives array
$archives = mysqli_fetch_all(mysqli_query($database, "select assignments.id, assignments.title, group_concat(SPACE(1),employees.name,SPACE(1), employees.last_name separator ' ') as name, assignments.created_at, assignments.completed_at
FROM assignments, employees, assigned_employees
WHERE employees.id = assigned_employees.employee_id
  AND assigned_employees.assignment_id = assignments.id
  AND created_at < completed_at
group by assignments.id;"), MYSQLI_ASSOC);
//Employees array
$employees = mysqli_fetch_all(mysqli_query($database, 'select * from employees'), MYSQLI_ASSOC);
//Assignments array
$assignments = mysqli_fetch_all(mysqli_query($database, "SELECT assignments.id, assignments.title, group_concat(SPACE(1),employees.name,SPACE(1), employees.last_name separator ',') as name, assignments.created_at, assignments.completed_at
FROM assignments, employees, assigned_employees
WHERE employees.id = assigned_employees.employee_id
  AND assigned_employees.assignment_id = assignments.id
group by assignments.id;"), MYSQLI_ASSOC);
//Employee assignments array
$employee_assignments = mysqli_fetch_all(mysqli_query($database, 'SELECT assigned_employees.employee_id as id, assignments.title, employees.name, employees.last_name, assigned_employees.assignment_start, assigned_employees.assignment_finish
FROM assignments, employees, assigned_employees
WHERE employees.id = assigned_employees.employee_id
  AND assigned_employees.assignment_id = assignments.id'), MYSQLI_ASSOC);
//Func to get last assignment
class Functions {
    public function setAssignment($database){
        $lastAssignment = mysqli_fetch_all(mysqli_query($database, 'select assignments.id from assignments'), MYSQLI_ASSOC);
        $lastAssignment = end($lastAssignment);
        $lastAssignment = $lastAssignment['id'];
        return $lastAssignment;
    }
}

$assign = new Functions();

?>
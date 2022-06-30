<section>
<a href="index.php?page=new_employee">New Employee</a>
<a href="index.php?page=new_assignment">New Assignment</a>
</section>
<?php
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$total_records_per_page = 10;

$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

$result_count = mysqli_query(
    $database,
    "SELECT COUNT(*) As total_records FROM `assignments`"
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 1
$result = mysqli_query(
    $database,
    "SELECT assignments.id, assignments.title, group_concat(SPACE(1),employees.name,SPACE(1), employees.last_name separator ',') as name, assignments.created_at, assignments.completed_at
FROM assignments, employees, assigned_employees
WHERE employees.id = assigned_employees.employee_id
  AND assigned_employees.assignment_id = assignments.id
AND assignments.created_at = assignments.completed_at
group by assignments.id LIMIT $offset, $total_records_per_page"
);
?>
<div>
    <table>
    <tr>
        <th>Title</th>
        <th>Employees</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
        <?php while($row = mysqli_fetch_array($result)){
            ?>
    <tr style="display: flex; justify-content: space-around">
        <td><?php echo $row['title']?></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['created_at']?></td>
        <td>
            <a href="index.php?complete=<?php echo $row['id']?>">Complete</a>
            <a href="index.php?delete=<?php echo $row['id']?>">Delete</a>
        </td>
    </tr>
       <?php } ?>
    </table>
</div>
<ul>
<?php
if ($total_no_of_pages <= 10){
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
        if ($counter == $page_no) {
            echo "<li class='active'><a>$counter</a></li>";
        }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
    }
}
?>
</ul>

<?php
//deletion
if (isset($_GET['delete'])){
    mysqli_query($database, 'delete assignments
from assignments
where assignments.id = "' . $_GET['delete'] . '"');
    mysqli_query($database, 'delete assigned_employees
from assigned_employees
where assigned_employees.assignment_id = "' . $_GET['delete'] . '"');
    header('Location: index.php');
}
//completion
if (isset($_GET['complete'])){
    mysqli_query($database, 'update assignments
set assignments.completed_at = CURRENT_TIMESTAMP
where assignments.id = "' . $_GET['complete'] . '"');
    header('Location: index.php');
}
?>


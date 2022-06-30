<b>New Assignment</b>
<br>
<form method="post" action="index.php?page=new_assignment&create=true">
    <input name="assignment" placeholder="Title"><br>
    Assignment start:<input type="datetime-local" name="assignment_start"><br>
    Assignment end:<input type="datetime-local" name="assignment_finish"><br>
    Assign Employees<br>
    <?php
    foreach ($employees as $employee) { ?>
        <input type="checkbox" name="employees[]" value="<?php echo $employee['id'] ?>">
        <label for="<?php echo $employee['id'] ?>"><?php echo $employee['name'] . ' ' . $employee['last_name'];
            if ($employee['is_multitasker']) {
                echo '*';
            } ?></label><br>
    <?php } ?>
    <button type="submit">Create</button>
</form>

<?php
//check errors
if (strlen($_POST['assignment'] ?? null) < 3) {
    $errors['text'] = 'Assignment title must be longer than 3 characters' . '<br><br>';
}

if (empty($_POST['employees'])) {
    $errors['select'] = 'An employee(s) must be selected' . '<br><br>';
}
if (isset($_POST['employees'])) {
    $value = count($_POST['employees']);

    if ($value > 3) {
        $errors['too_much'] = 'You can select 3 employees max';
    }
}
if (!isset($_POST['assignment_start'])) {
    $errors['assignment_start'] = 'Assignment start date must be set' . '<br><br>';
}
if (!isset($_POST['assignment_finish'])) {
    $errors['assignment_finish'] = 'Assignment end date must be set' . '<br><br>';
}

if ($_GET['create'] ?? null == 'true') {
    if (empty($errors)) {
        foreach ($employee_assignments as $employee_assignment) {
            $empl_start = substr($employee_assignment['assignment_start'], 0, 10);

            $select_start = substr($_POST['assignment_start'], 0, 10);

            foreach ($_POST['employees'] as $selected_employee) {
                if ($employee_assignment['id'] == $selected_employee) {
                    if ($select_start == $empl_start) {
                        $sel_finish = substr($_POST['assignment_finish'], 11);
                        $sel_start = substr($_POST['assignment_start'], 11);
                        $emp_start = substr($employee_assignment['assignment_start'], -8, 5);
                        $emp_finish = substr($employee_assignment['assignment_finish'], -8, 5);
                        if ($sel_start <= $emp_finish && $sel_start >= $emp_start || $sel_start <= $emp_start && $sel_finish > $emp_start || $sel_start >= $sel_finish) {
                            $check_for_multitaskers[] = $selected_employee;
                        }
                    }
                }
            }
        }
    }
}
if (isset($check_for_multitaskers)) {
    foreach ($employees as $employee) {
        foreach ($check_for_multitaskers as $is_multitasker) {
            if ($employee['id'] == $is_multitasker && !$employee['is_multitasker']) {
                $errors['same_day'] = $employee['name'] . ' ' . $employee['last_name'] . ' is busy at this time' . '<br><br>';
            }
        }
    }

}

?>
* - Can apply for multiple tasks at the same time.
<hr>
<!--check employee schedule-->
<b>Employee schedules:</b>
<div class="schedules">
    <form method="post" action="index.php?page=new_assignment&schedule=true">
        Employee:<select name="selected_employee">
            <?php
            foreach ($employees as $employee) { ?>
                <option value="<?php echo $employee['id'] ?>"><?php echo $employee['name'] . ' ' . $employee['last_name'] ?></option>
            <?php } ?></select><br>
        Select day:<input type="datetime-local" name="selected_date"><br>
        <button type="submit">Check schedule</button>
    </form>
</div>

<?php
$selected_employee = $_POST['selected_employee'] ?? null;
$selected_date = $_POST['selected_date'] ?? null;

// send to db
if ($_GET['create'] ?? null == 'true') {
    if (empty($errors)) {
        mysqli_query($database, 'insert into assignments (title) values ("' . $_POST['assignment'] . '")');
        $assignment_id = $assign->setAssignment($database);
        foreach ($_POST['employees'] as $employee) {
            mysqli_query($database, 'insert into assigned_employees (assignment_id, employee_id, assignment_start, assignment_finish) values ("' . $assignment_id . '", "' . $employee . '", "' . $_POST['assignment_start'] . '", "' . $_POST['assignment_finish'] . '")');
        }
        echo "New assignment created successfully!";
        $selected_employees = $_POST['employees'];
        $selected_date = $_POST['assignment_start'];
    } else {
        echo $errors['select'] ?? null;
        echo $errors['same_day'] ?? null;
        echo $errors['text'] ?? null;
        echo $errors['too_much'] ?? null;
        echo $errors['assignment_finish'] ?? null;
        echo $errors['assignment_start'] ?? null;
        $selected_employees = $_POST['employees'];
        $selected_date = $_POST['assignment_start'];
    }
}


if (isset($selected_employees)) {

    foreach ($selected_employees as $selected_employee) {
        foreach ($employees as $employee) {
            if ($employee['id'] == $selected_employee) {
                $name = $employee['name'] . ' ' . $employee['last_name'];
            }
        }
        $day = substr($selected_date, 0, 10);
        ?>
        <h2 style="text-align: center"><?php echo $name ?? null ?></h2>
        <h3 style="text-align: center"><?php echo $day ?? null ?></h3>
        <table>
            <tr>
                <th>Task</th>
                <th>Starts at</th>
                <th>Ends at</th>
            </tr>
            <?php
            foreach ($employee_assignments as $employee_assignment) {
                $assignment_start = substr($employee_assignment['assignment_start'], 0, 10);
                if ($employee_assignment['id'] == $selected_employee && $day == $assignment_start) { ?>
                    <tr>
                        <td><?php echo $employee_assignment['title'] ?></td>
                        <td><?php echo substr($employee_assignment['assignment_start'], 11, 8) ?></td>
                        <td><?php echo substr($employee_assignment['assignment_finish'], 11, 8) ?></td>
                    </tr>
                <?php }
            } ?>
        </table>
    <?php }
} else {
    if (isset($selected_employee)) {
        foreach ($employees as $employee) {
            if ($employee['id'] == $selected_employee) {
                $name = $employee['name'] . ' ' . $employee['last_name'];
            }
        }
        $day = substr($selected_date, 0, 10);
        ?>
        <h2 style="text-align: center"><?php echo $name ?? null ?></h2>
        <h3 style="text-align: center"><?php echo $day ?? null ?></h3>
        <table>
            <tr>
                <th>Task</th>
                <th>Starts at</th>
                <th>Ends at</th>
            </tr>
            <?php
            foreach ($employee_assignments as $employee_assignment) {
                $assignment_start = substr($employee_assignment['assignment_start'], 0, 10);
                if ($employee_assignment['id'] == $selected_employee && $day == $assignment_start) { ?>
                    <tr>
                        <td><?php echo $employee_assignment['title'] ?></td>
                        <td><?php echo substr($employee_assignment['assignment_start'], 11, 8) ?></td>
                        <td><?php echo substr($employee_assignment['assignment_finish'], 11, 8) ?></td>
                    </tr>
                <?php }
            } ?>
        </table>
    <?php }
} ?>
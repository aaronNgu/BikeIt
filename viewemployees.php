<?php
require_once("./db.php");
$db = new DB();
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Employees</h2>
    <form action="viewemployees.php" method="post">
        <div>
            <input type="radio" name="radio[0]" value="SIN">
            <label>SIN</label>
        </div>
        <div>
            <input type="radio" name="radio[1]" value="ID">
            <label>ID</label>
        </div>
        <div>
            <input type="radio" name="radio[2]" value="Email">
            <label>Email</label>
        </div>
        <div>
            <input type="radio" name="radio[3]" value="CenterLocation">
            <label>Center Location</label>
        </div>
        <div>
            <input type="radio" name="radio[4]" value="CenterName">
            <label>Center Name</label>
        </div>
        <br>
        <input type="submit" name="submit" value="submit">
        <input type="submit" name="submit-all" value="submit all">
    </form>

    <?php

    if (isset($_POST["submit"]) and isset($_POST['radio'])) {
        $sql = "SELECT ";

        foreach ($_POST['radio'] as $value) {
            $sql = $sql . $value . ",";
        }

        $sql = rtrim($sql, ",");
        $sql = $sql . " FROM EmployEmployeeOne";
    } else {
        $sql = "SELECT * FROM EmployEmployeeOne";
    }


    $result = $db->query($sql);
    if (!$result) {
        echo "Failed to complete query";
    }

    echo "<table>";
    $row = mysqli_fetch_field($result);
    echo "<tr>";
    while ($row) {
        echo "<td>" . $row->name . "</td>";
        $row = mysqli_fetch_field($result);
    }
    echo "</tr>";

    $row = mysqli_fetch_object($result);
    $fields = mysqli_fetch_fields($result);
    
    while ($row) {
        echo "<tr>";
        $numfields = $result->field_count;
        for ($i = 0; $i < $numfields; $i++) {
            echo "<td>";
            echo $row-> {$fields[$i]->name};
            echo "</td>";
        }
        echo "</tr>";
        $row = mysqli_fetch_object($result);
    }
    echo "</table>";
    ?>
</body>

</html>
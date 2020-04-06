<?php
require_once("./db.php");
$db = new DB();
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Count of employees in each location</h2>
    <form action="nested.php" method="post">
        <input type="submit" name="submit" value="execute">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $sql = "SELECT e.CenterName, count(*) as count
                FROM EmployEmployeeOne e
                GROUP BY e.CenterName";
        echo $sql;
        $result = $db->query($sql);
        if (!$result) {
            echo "Failed to maker query";
        }
        echo "<table>";
        echo "<tr>";
        echo "<th>Center Name</th>";
        echo "<th>Count</th>";
        echo "</tr>";
        $row = mysqli_fetch_object($result);
        while ($row) {
            echo "<tr>";;
            echo "<td>".$row->CenterName."</td>";
            echo "<td>".$row->count."</td>";
            echo "</tr>";
            $row = mysqli_fetch_object($result);
        }

        echo "</table>";
    } ?>
</body>

</html>
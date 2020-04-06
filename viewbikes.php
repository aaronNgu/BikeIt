<?php
require_once("./db.php");
$db = new DB();
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Bikes</h2>

    <form action="viewbikes.php" method="post">
        <div>
            <select name="condition">
                <option value="none">Not Selected</option>
                <option value="before">Before</option>
                <option value="on">On</option>
                <option value="after">After</option>
            </select>
            <input type="date" name="date">
        </div>
        <br>
        <div>
            Electric Status :
            <select name="electric">
                <option value="both"> Both</option>
                <option value="nonelectric">Non Electric</option>
                <option value="electric"> Electric </option>
            </select>
        </div>
        <br>
        <input type="submit" name="submit">
    </form>
    <br>
    <?php
    if (isset($_POST['submit'])) {

        echo "<h3>Result : </h3>";
        $sql = "SELECT * FROM BikeTwo ";
        if ($_POST['electric'] == 'electric') {
            $sql = $sql . "WHERE Electric=true ";
        } else if ($_POST['electric'] == 'nonelectric') {
            $sql = $sql . "WHERE Electric=false ";
        }

        if (!empty($_POST['date'])) {
            switch ($_POST['condition']) {
                case "before":
                    $sql = $_POST['electric'] == 'both' ?
                        $sql . "WHERE LastMaintained<\"" . $_POST['date'] . "\"" :
                        $sql . "and LastMaintained<\"" . $_POST['date'] . "\"";
                    break;
                case "on":
                    $sql = $_POST['electric'] == 'both' ?
                        $sql . "WHERE LastMaintained=\"" . $_POST['date'] . "\"" :
                        $sql . "and LastMaintained=\"" . $_POST['date'] . "\"";
                    break;
                case "after":
                    $sql = $_POST['electric'] == 'both' ?
                        $sql . "WHERE LastMaintained>\"" . $_POST['date'] . "\"" :
                        $sql . "and LastMaintained>\"" . $_POST['date'] . "\"";
                    break;
                default:
                    break;
            }
        }

        $result = $db->query($sql);
        if (!isset($result) or !$result) {
            echo "failed to get results";
        }
        echo "<table>";
        echo "<tr>";
        echo "<th> ID </th>";
        echo "<th> </th>";
        echo "<th> Electric </th>";
        echo "<th> Last Maintained </th>";
        echo "</tr>";
        echo "<br>";
        if (isset($result) and $result) {
            $row = mysqli_fetch_object($result);
            while ($row) {
                echo "<tr>";
                echo "<td>";
                echo $row->ID;
                echo "</td>";
                echo "<td></td>";
                echo "<td>";
                echo $row->Electric ? "true" : "false";
                echo "</td>";
                echo "<td>";
                echo $row->LastMaintained;
                echo "</td>";
                echo "</tr>";
                $row = mysqli_fetch_object($result);
            }
        }
        echo "</table>";
    }
    ?>
</body>

</html>
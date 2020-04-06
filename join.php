<!DOCTYPE html>
<html>
    <body>
        <h2>Who repaired your bike?</h2>
        <h3>Select your location:</h3>
        <form action="join.php" method="post">
            <?php
            require_once("./db.php");
            $db = new DB();
            $sql_getUser = "SELECT * from repair_centre";
            $rc_result = $db->query($sql_getUser);
                while ($loc = mysqli_fetch_object($rc_result)) {
                    echo "<input type=radio name=loc value=" . $loc->Name . ">";
                    echo "<label>" . $loc->Name . "</label>";
                    echo "<br>";
                }
            ?>


            <input type=submit value=find name=find>
        </form><br />
        <?php

    if (isset($_POST['find'])) {
    if (isset($_POST['loc'])) {
        $loct = $_POST['loc'];
        echo "You selected " . $loct . ".<br />";
        $sql_output = "SELECT repair_centre.Name, employemployeeone.Email
        FROM repair_centre
        INNER JOIN employemployeeone
        ON repair_centre.Location = employemployeeone.CenterLocation
        WHERE repair_centre.Name = \"" . $loct . "\"";
        $res2 = $db->query($sql_output);
        $res3 = mysqli_fetch_assoc($res2);
        echo "Repair person email: " . $res3['Email'];
    }
    }
?>

    </body>
</html>

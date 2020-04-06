<!DOCTYPE html>
<html>
    <body>
        <h2>Find the number of bikes</h2>
        <form action="aggregate.php" method="post">
            <input type=submit value=find name=find>
        </form><br />
        <?php
        require_once("./db.php");
        $db = new DB();

    if (isset($_POST['find'])) {
        $sql_output = "SELECT COUNT(ID) FROM biketwo";
        $res2 = $db->query($sql_output);
        $res3 = mysqli_fetch_assoc($res2);
        echo "Number of bikes: " . $res3['COUNT(ID)'];
    }
?>

    </body>
</html>

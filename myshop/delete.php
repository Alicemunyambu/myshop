<?php
if(isset($_GET["id"])) {
    $id = $_GET["id"];

    $connection =mysqli_connect("localhost","root","","myshop");

    $sql = "DELETE FROM clients WHERE id=$id";
    $connection->query($sql);
}

header("location: /myshop/index.php");
exit;

?>

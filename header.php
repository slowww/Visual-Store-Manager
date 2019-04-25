<?php

require 'connection.php';


$access=unserialize($_SESSION['access']);
$user = $access->getUsername();
$stmt = $conn->prepare("SELECT citta_cdc FROM cdc WHERE cdc=?");
$stmt->bind_param("s",$user);
$stmt->execute();
$result = $stmt->get_result();

echo "<br>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo "<h3>Pdv: " . $row['citta_cdc'] ." ".$user . "</h3>";

    }
}
mysqli_free_result($result);

echo "<br>";


?>
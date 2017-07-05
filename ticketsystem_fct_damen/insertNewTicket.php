<?php

include "db_newconnection.php";
include "ticketsystem.php";

$sql = "INSERT INTO tickets (SpieltagID , Kategorie, Username) VALUES ('". mysqli_real_escape_string($tunnel,$_POST['SpieltagID']). "','" . mysqli_real_escape_string($tunnel,$_POST['Kategorie']). "', '" . mysqli_real_escape_string($tunnel,$_SESSION['name']). "');";

if ($tunnel->query($sql) === TRUE) {
    echo "Erfolgreich reserviert";
} else {
    echo "Error: " . $sql . "<br>" . $tunnel->error;
}

$tunnel->close();
?>
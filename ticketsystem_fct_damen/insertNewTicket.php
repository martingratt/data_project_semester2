<?php
include "ticketsystem.php";
include "db_newconnection.php";

$row = $sql->fetch_assoc();

$sql = "INSERT INTO tickets (SpieltagID , Kategorie, Username) VALUES ('". mysqli_real_escape_string($tunnel,$_POST['SpieltagID']). "','" . utf8_encode(mysqli_real_escape_string($tunnel,$_POST['Kategorie'])). "', '" . mysqli_real_escape_string($tunnel,$_SESSION['name']). "');";

if ($tunnel->query($sql) === TRUE) {
    echo "Erfolgreich reserviert";
} else {
    echo "Error: " . $sql . "<br>" . $tunnel->error;
}

$tunnel->close();
?>
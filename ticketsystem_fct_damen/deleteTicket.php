<?php
include "ticketsystem.php";
include "db_newconnection.php";

$row = $sql->fetch_assoc();

$sql = "DELETE FROM tickets WHERE TicketID = '".mysqli_real_escape_string($tunnel,$_POST['TicketID'])."'";

if ($tunnel->query($sql) === TRUE) {
    echo "Erfolgreich gelöscht";
    header('location:reservierungen.php');
} else {
    echo "Error: " . $sql . "<br>" . $tunnel->error;
}

$tunnel->close();
?>
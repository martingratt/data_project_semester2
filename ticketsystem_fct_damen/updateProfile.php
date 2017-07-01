<?php

session_start();

require_once ("db_newconnection.php");

$nickname = $_SESSION["name"];

if (isset($_SESSION["name"])) {

    $vorname = mysqli_escape_string($tunnel, $_POST['vorname']);
    $nachname = mysqli_escape_string($tunnel, $_POST['nachname']);
    $geschlecht = mysqli_escape_string($tunnel, $_POST['geschlecht']);
    $plz = mysqli_escape_string($tunnel, $_POST['postleitzahl']);
    $strasse = mysqli_escape_string($tunnel, $_POST['strasse']);

    $checkortquery = "SELECT * FROM ort WHERE PLZ ='$plz'";

    $queryresult = mysqli_query($tunnel, $checkortquery);

    $control1 = 0;

    while ($row1 = mysqli_fetch_object($queryresult)) {
        $control1++;
    }

    if ($control1 !=0) {

        $query = "UPDATE personen SET Nachname = '" . $nachname . "', Vorname = '" . $vorname . "', Geschlecht = '" . $geschlecht . "', PLZ = '" . $plz . "', Strasse = '" . $strasse . "' WHERE Username = '$nickname'";

        $result = mysqli_query($tunnel, $query);

        if ($result==1) {

            echo "<p>Benutzer wurde erfolgreich geändert</p>";
            echo "Zurück zur <a href='ticketsystem.php'>Startseite</a>";


        } else {

            echo "Ein Problem ist aufgetreten, versuchen Sie es später nocheinmal";

        }
    } else {

        echo "<p>Diese Postleitzahl ist uns nicht bekannt! </p>";
        echo "Versuchen Sie es  <a href='profile.php'>nocheinmal</a>";

    }
    mysqli_close($tunnel);
    ?>


    <?php
} else {
    ?>
    Bitte erst einloggen, <a href="index.php">hier</a>.
    <?php
}

?>

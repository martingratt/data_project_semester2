<?php

session_start();

// Wir fanden es sinnvoller, den Usernamen direkt von der Session zu beziehen
// und den User nicht mit z. B. einer ID danach suchen zu lassen, da er sonst auf
// Daten von anderen Usern zugriff hätte. Darum haben wir uns entschieden
// kein eingabefeld für eine suche zur Verfügung zu stellen und diese direkt
// zu beziehen



require_once ("db_newconnection.php");

if (isset($_SESSION["name"])) {
    $nickname = $_SESSION["name"];
    echo "<div class='loggedin'>Logged in as <strong>$nickname</strong></div>";

    ?>

    <html>
    <head>
        <title>Ticketsystem</title>
        <meta charset="UTF-8">
        <link href="css/ticketsystem.css" rel="stylesheet">
    </head>
    <body>
    <div class="profil"><a href="ticketsystem.php" class="nav">Home</a></div>
    <div class="profil"><a href="profile.php" class="nav">Profil</a></div>
    <div class="profil"><a href="reservierungen.php" class="nav">Reservierungen</a></div>
    <div class="logout"><a href="logout.php" class="nav">Logout</a></div>
    <div class="label"><h1>Ticketsystem - FC Tirol (Damen)</h1></div>
    </body>
    </html>

    <?php

$ordiestring = "<p><strong>PHP Info: </strong>Abfrage war nicht möglich.</p>";

$nickname = $_SESSION["name"];

$query = "SELECT * FROM personen WHERE Username = '$nickname'";

$result = mysqli_query($tunnel, $query) or die ($ordiestring);

while($row = mysqli_fetch_array($result)){

    if (utf8_encode($row["Geschlecht"]) == "m") {
        echo "
			<form action='updateProfile.php' type='submit' method='post'>
				<p>Username <input type='text' name='nickname' value='" . utf8_encode($nickname) . "' disabled/></p>
				<p>Vorname <input type='text' name='vorname' value='" . utf8_encode($row["Vorname"]) . "'/></p>
				<p>Nachname <input type='text' name='nachname' value='" . utf8_encode($row["Nachname"]) . "'/></p>
            	<p>Geschlecht<select name='geschlecht'>
                    <option value='m'>Männlich</option>
                    <option value='w'>Weiblich</option>
                </select></p>
                <p>Strasse <input type='text' name='strasse' value='" . utf8_encode($row["Strasse"]) . "'/></p>
				<p>PLZ";
        include "db_newconnection.php";

            $sql = mysqli_query($tunnel, "SELECT * FROM ort");

            echo "<select name='Ort'>";
            while ($row = $sql->fetch_assoc()){

                echo "<option value=". mysqli_real_escape_string($tunnel,$row['PLZ']).">".($row['PLZ'])." | ". utf8_encode($row['Ort'])."</option>";

            }
            echo "</select>
            </p>
				<input type='submit' name='action' value='Speichern'/>
				<input type='submit' name='action' value='Löschen'>
			</form>";
    } else {
        echo "
			<form action='updateProfile.php' type='submit' method='post'>
				<p>Username <input type='text' name='nickname' value='" . utf8_encode($nickname) . "' disabled/></p>
				<p>Vorname <input type='text' name='vorname' value='" . utf8_encode($row["Vorname"]) . "'/></p>
				<p>Nachname <input type='text' name='nachname' value='" . utf8_encode($row["Nachname"]) . "'/></p>
				<p>Geschlecht<select name='geschlecht'>
                    <option value='w'>Weiblich</option>
                    <option value='m'>Männlich</option>
                </select></p>
				<p>PLZ <input type='text' name='postleitzahl' value='" . utf8_encode($row["PLZ"]) . "'/></p>
				<p>Strasse <input type='text' name='strasse' value='" . utf8_encode($row["Strasse"]) . "'/></p>				
				<input type='submit' name='action' value='Speichern'/>
				<input type='submit' name='action' value='Löschen'>
				
			</form>";
    }
}
    mysqli_close($tunnel);

} else {
    ?>
    Bitte erste einloggen, <a href="index.php">hier</a>.
    <?php
}
?>


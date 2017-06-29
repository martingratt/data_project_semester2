<?php

session_start();

require_once ("db_newconnection.php");

if (isset($_SESSION["name"])) {

    ?>

    <html>
    <head>
        <meta charset="utf-16">
        <title></title>
    </head>
    <body>
    <h1>
        Ihr Profil
    </h1>
    </body>

    <p>Hallo</p>
    </html>

    <?php

$ordiestring = "<p><strong>PHP Info: </strong>Abfrage war nicht möglich.</p>";

$nickname = $_SESSION["name"];

$query = "SELECT * FROM personen WHERE Username = '$nickname'";

$result = mysqli_query($tunnel, $query) or die ($ordiestring);

while($row = mysqli_fetch_array($result)){

    echo "
			<form action='' type='submit' method='post'> //hier nocht ändern
				<p>Username <input type='text' name='nickname' value='" . $nickname . "'/></p>
				<p>Vorname <input type='text' name='vorname' value='" . $row["Vorname"] . "'/></p>
				<p>Nachname <input type='text' name='nachname' value='" . $row["Nachname"] . "'/></p>
				<p>Geschlecht <input type='text' name='geschlecht' value='" . $row["Geschlecht"] . "'/></p>
				<p>PLZ <input type='text' name='postleitzahl' value='" . $row["PLZ"] . "'/></p>
				<p>Strasse <input type='text' name='strasse' value='" . $row["Strasse"] . "'/></p>				
				<input type='submit' name='action' value='Update Student'/>
			</form>";
    }

?>









    <?php
} else {
    ?>
    Bitte erste einloggen, <a href="index.php">hier</a>.
    <?php
}
?>


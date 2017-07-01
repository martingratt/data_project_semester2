<?php

session_start();

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
<div class="logout"><a href="logout.php" class="nav">Logout</a></div>
<div class="label"><h1>Ticketsystem</h1></div>
</body>

<?php

    include "db_newconnection.php";
    $sql = "SELECT * FROM Spieltage";

    $db_query = mysqli_query($tunnel, $sql);
    if (!$db_query) {
        die('Ungültige Abfrage: ' . mysqli_error());
    }

    echo '<table>';
echo "<tr>";
echo "<th>Spieltag</th>";
echo "<th>Datum</th>";
echo "<th>Uhrzeit</th>";
echo "<th>Gegner</th>";
echo "<th></th>";
echo "</tr>";
    while ($zeile = mysqli_fetch_array($db_query)) {
        echo "<tr>";
        echo "<th>" . utf8_encode($zeile['SpieltagID']) . "</th>";
        echo "<td>" . utf8_encode($zeile['Datum']) . "</td>";
        echo "<td>" . utf8_encode($zeile['Uhrzeit']) . "</td>";
        echo "<td>" . utf8_encode($zeile['Gegner']) . "</td>";
        echo "<td><a href='kategorie.php'><button>zu den Tickets</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";



?>


</html>

    <?php
} else {
    ?>
    Bitte erst einloggen, <a href="index.php">hier</a>.
    <?php
}
?>

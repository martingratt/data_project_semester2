<?php

session_start();

if (isset($_SESSION["name"])) {
    $nickname = $_SESSION["name"];
    echo "Hallo $nickname";

    ?>
<html>
<head>
    <title>Ticketsystem</title>
    <meta charset="UTF-8">
    <link href="css/ticketsystem.css" rel="stylesheet">
</head>
<body>
<h1>
    Ticketsystem
</h1>
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
echo "<th>SpieltagID</th>";
echo "<th>Datum</th>";
echo "<th>Uhrzeit</th>";
echo "<th>Gegner</th>";
echo "<th></th>";
echo "</tr>";
    while ($zeile = mysqli_fetch_array($db_query)) {
        echo "<tr>";
        echo "<td>" . utf8_encode($zeile['SpieltagID']) . "</td>";
        echo "<td>" . utf8_encode($zeile['Datum']) . "</td>";
        echo "<td>" . utf8_encode($zeile['Uhrzeit']) . "</td>";
        echo "<td>" . utf8_encode($zeile['Gegner']) . "</td>";
        echo "<td><a href='kategorie.php'><button>zu den Tickets</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_free_result($db_query);

?>


<p>Hier gehts zu ihrem  <a href="profile.php"> Profil</a></p>
<p>Da gehts zum  <a href="logout.php"> Logout</a></p>
</html>

    <?php
} else {
    ?>
    Bitte erst einloggen, <a href="index.php">hier</a>.
    <?php
}
?>

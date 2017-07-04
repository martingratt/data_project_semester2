<?php

session_start();

if (isset($_SESSION["name"])) {
    $nickname = $_SESSION["name"];
    echo "<div class='loggedin'>Logged in as <strong>$nickname</strong></div>";

    ?>
<tr>
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
<div class="label"><h1>Ticketsystem</h1></div>
</body>


<form action="insertNewTicket.php" method="post">
<?php
    include "db_newconnection.php";
    $sql = "SELECT * FROM Spieltage";

    $db_query = mysqli_query($tunnel, $sql);
    if (!$db_query) {
        die('Ungültige Abfrage: ' . mysqli_error());
    }


$sql = mysqli_query($tunnel, "SELECT * FROM spieltage");

echo '<table>';
echo "<tr>";
echo "<th>Spiel auswählen</th>";
echo "<th>Kategorie auswählen</th>";
echo "<th></th>";
echo "</tr>";

echo "<tr>";
echo "<td>";


    echo"<select name='SpieltagID' id='ticket'>";
while ($row = $sql->fetch_assoc()){

    echo "<option value=".$row['SpieltagID'].">".$row['SpieltagID']." | ". $row['Datum']." | ". $row['Uhrzeit']." | ". utf8_encode($row['Gegner'])."</option>";

    }

echo "</select>";
echo "</td>";
echo "<td>";

$sql = mysqli_query($tunnel, "SELECT * FROM kategorie");

echo"<select name='Kategorie' id='ticket'>";
while ($row = $sql->fetch_assoc()){

    echo "<option value=". mysqli_real_escape_string($tunnel,$row['Kategorie']).">".utf8_encode($row['Kategorie'])." | € ". $row['Preis']."</option>";

}
echo "</select>";
echo "</td>";
echo "<td>";

echo"<button type=\"submit\" name=\"action\">Reservieren</button>";
?>
</form>
</td>
</tr>
    </table>



</html>

    <?php
} else {
    ?>
    Bitte erst einloggen, <a href="index.php">hier</a>.
    <?php
}
?>

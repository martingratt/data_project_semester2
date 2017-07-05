<?php

session_start();

if (isset($_SESSION["name"])) {
    $nickname = $_SESSION["name"];
    echo "<div class='loggedin'>Logged in as <strong>$nickname</strong></div>";

    ?>

<head>
    <title>Ticketsystem - FC Tirol (Damen)</title>
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

<form action="insertNewTicket.php" method="post">
<?php
    include "db_newconnection.php";
    $sql = "SELECT * FROM Spieltage";

    $db_query = mysqli_query($tunnel, $sql);
    if (!$db_query) {
        die('Ungültige Abfrage: ' . mysqli_error());
    }

$sql = mysqli_query($tunnel, "SELECT * FROM spieltage");

echo "<table>
<tr>
<th>Spiel auswählen</th>
<th>Kategorie auswählen</th>
<th></th>
</tr>
<tr>
<td>";

    echo"<select name='SpieltagID'>";
while ($row = $sql->fetch_assoc()){

    echo "<option value=".$row['SpieltagID'].">".$row['SpieltagID']." | ". $row['Datum']." | ". $row['Uhrzeit']." | ". utf8_encode($row['Gegner'])."</option>";

    }

echo "</select>
</td>
<td>";

$sql = mysqli_query($tunnel, "SELECT * FROM kategorie");

echo"<select name='Kategorie'>";
while ($row = $sql->fetch_assoc()){

    echo "<option value=". mysqli_real_escape_string($tunnel,$row['Kategorie']).">".utf8_encode($row['Kategorie'])." | € ". $row['Preis']."</option>";

}
?>
    </select>
</td>
<td>
<button type=\"submit\" name=\"action\">Reservieren</button>
</form>
</td>
</tr>
    </table>
<br><br>
</html>

    <?php
} else {
    ?>
    Bitte erst einloggen, <a href="index.php">hier</a>.
    <?php
}
?>

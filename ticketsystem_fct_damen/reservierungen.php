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
    <div class="profil"><a href="reservierungen.php" class="nav">Reservierungen</a></div>
    <div class="logout"><a href="logout.php" class="nav">Logout</a></div>
    <div class="label"><h1>Ticketsystem - FC Tirol (Damen)</h1></div>
    </body>

    <?php

    include "db_newconnection.php";
    $sql = "SELECT * FROM Reservierungen WHERE Username = '$nickname' ORDER BY TicketID";

    $db_query = mysqli_query($tunnel, $sql);
    if (!$db_query) {
        die('Ungültige Abfrage: ' . mysqli_error());
    }

    echo "<table>
    <tr>
    <th>TicketID</th>
    <th>Spieltag</th>
    <th>Datum</th>
    <th>Uhrzeit</th>
    <th>Auswärtsmannschaft</th>
    <th>Kategorie</th>
    <th>Preis</th>
    </tr>";

    while ($zeile = mysqli_fetch_array($db_query)) {
        echo "<tr>";
        echo "<th>" . $zeile['TicketID'] . "</th>";
        echo "<td>" . $zeile['Spieltag'] . "</td>";
        echo "<td>" . $zeile['Datum'] . "</td>";
        echo "<td>" . $zeile['Uhrzeit'] . "</td>";
        echo "<td>" . utf8_encode($zeile['Gegner']) . "</td>";
        echo "<td>" . utf8_encode($zeile['Kategorie']) . "</td>";
        echo "<td>€ " . $zeile['Preis'] . "</td>";
        echo "</tr>";

    }
    $gesamtpreis = "SELECT * FROM Gesamtpreis WHERE Username = '$nickname'";

    $db_query = mysqli_query($tunnel, $gesamtpreis);
    if (!$db_query) {
        die('Ungültige Abfrage: ' . mysqli_error());
    }

    echo "<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <th>Gesamtpreis</th>";
    while ($zeile = mysqli_fetch_array($db_query)) {
        echo "<th>€ " . $zeile['Gesamtpreis'] . "</th>";
    }
    echo "</tr>

    </table>";

    ?>
<br><br>

    <form action="deleteTicket.php" method="post">
        <?php
        include "db_newconnection.php";
        $sql = "SELECT * FROM Tickets";

        $db_query = mysqli_query($tunnel, $sql);
        if (!$db_query) {
            die('Ungültige Abfrage: ' . mysqli_error());
        }

        $sql = mysqli_query($tunnel, "SELECT * FROM Tickets WHERE Username = '$nickname' ORDER BY TicketID");

        echo "<table>
        <tr>
        <th>TicketID</th>
        <th></th>
        </tr>
        <tr>
        <td>

        <select name='TicketID'>";
        while ($row = $sql->fetch_assoc()){

            echo "<option value=".$row['TicketID'].">".$row['TicketID']."</option>";

        }
        ?>

        </select>
        </td>
        <td>
    <button type=\"submit\" name=\"action\">Löschen</button>
    </form>
    </html>

    <?php
} else {
    ?>
    Bitte erst einloggen, <a href="index.php">hier</a>.
    <?php
}
?>

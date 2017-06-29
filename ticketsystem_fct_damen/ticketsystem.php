<?php

session_start();

if (isset($_SESSION["name"])) {
    $nickname = $_SESSION["name"];
    echo "Hallo $nickname";

    ?>
<html>
<head>
    <title></title>
</head>
<body>
<h1>
    Ticketsystem
</h1>
</body>
<p>Hier gehts zu ihrem  <a href="profile.php"> Profil</a></p>
<p>Da gehts zum  <a href="logout.php"> Logout</a></p>
</html>

    <?php
} else {
    ?>
    Bitte erste einloggen, <a href="index.php">hier</a>.
    <?php
}
?>

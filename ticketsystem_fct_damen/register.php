<html>
<head>
    <title>
        register
    </title>

    <link href="css/login.css" rel="stylesheet">

</head>
<body>

<div class="hit-the-floor"><h1>Ticketsystem!</h1></div>

<div class="passwortcheck">
    <?php
    $errorUserNameExists = false;

    if (isset($_POST["submit"])){

        //werte prüfen - evtl. einfügen wenn alles passt
        //falls was nicht passt - error setzen
        require_once('insertNewPlayer.php');
    }
    ?>
</div>

<form action="register.php" type="submit" method="post">

    <div class="login-page">

        <div class="form">

            <form class="register-form" action="register.php" type="submit" method="post">
                <p><input type="text" placeholder="Nickname" name="nickname" required/></p>

                <p></p><input type="text" placeholder="Vorname" name="vorname" required/>
            <p></p><input type="text" placeholder="Nachname" name="nachname" required/>
            <p></p><select name="geschlecht">
                    <option value="m">Männlich</option>
                    <option value="w">Weiblich</option>
                </select>
            <p></p><input type="text" placeholder="Strasse und Hausnummer" name="strasse" required/>
            <p></p>
            <?php
            include "db_newconnection.php";

            $sql = mysqli_query($tunnel, "SELECT * FROM ort");

            echo"<select name='Ort'>";
            while ($row = $sql->fetch_assoc()){

                echo "<option value=". mysqli_real_escape_string($tunnel,$row['PLZ']).">".($row['PLZ'])." | ". utf8_encode($row['Ort'])."</option>";

            }
            echo "</select>";
                ?>
            <p></p><input type="password" placeholder="Passwort" name="passwort" required/>
            <p></p><input type="password" placeholder="Passwort wiederhohlen" name="passwortwh" required/>
                <button value="Registrierern" name="submit">Registieren</button>
                <p class="message">Schon registriert? <a href="index.php">Jetzt anmelden</a></p>
            </form>

        </div>
    </div>

</form>

</body>

</html>

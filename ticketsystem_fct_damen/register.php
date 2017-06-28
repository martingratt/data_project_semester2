

<html>
<head>
    <title>
        register
    </title>
    <link href="css/login.css" rel="stylesheet">

</head>
<body>

<div class="hit-the-floor"><h1>Ticketsystem!</h1></div>


<form action="register.php" type="submit" method="post">

    <div class="login-page">

        <div class="form">

            <form class="register-form" action="register.php" type="submit" method="post"">
                <input type="text" placeholder="Nickname" name="nickname" required/>
                <input type="text" placeholder="Vorname" name="vorname" required/>
                <input type="text" placeholder="Nachname" name="nachname" required/>
                <input type="text" placeholder="m/w" name="geschlecht" required/>
                <input type="text" placeholder="Strasse und Hausnummer" name="strasse" required/>
                <input type="password" placeholder="Passwort" name="passwort" required/>
                <input type="password" placeholder="Passwort wiederhohlen" name="passwortwh" required/>
                <button value="Registrierern" name="submit">Registieren</button>
                <p class="message">Schon registriert? <a href="index.php">Jetzt anmelden</a></p>
            </form>

        </div>
    </div>



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

</form>

</body>

</html>

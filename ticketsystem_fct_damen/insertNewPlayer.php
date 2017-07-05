<?php

        include "db_newconnection.php";

        $ordiestring = "<p><strong>PHP Info: </strong>Abfrage war nicht möglich.</p>";

            //alles klein
            $nickname = mysqli_escape_string($tunnel, strtolower($_POST["nickname"]));
            //verschlüsselung
            $passwort = mysqli_escape_string($tunnel, $_POST["passwort"]);
            $passwortwh = mysqli_escape_string($tunnel, $_POST["passwortwh"]);
            $vorname = mysqli_escape_string($tunnel, $_POST["vorname"]);
            $nachname = mysqli_escape_string($tunnel, $_POST["nachname"]);
            $geschlecht = mysqli_escape_string($tunnel, $_POST["geschlecht"]);
            $ort = mysqli_real_escape_string($tunnel,$_POST['Ort']);
            $strasse = mysqli_escape_string($tunnel, $_POST["strasse"]);

            $checkortquery = "SELECT * FROM ort WHERE PLZ ='$ort'";

            $queryresult = mysqli_query($tunnel, $checkortquery);

            $control1 = 0;

            while ($row1 = mysqli_fetch_object($queryresult)) {
                $control1++;
            }

            if ($control1 != 0) {

                if ($passwort == $passwortwh) {

                    $hash = hash('sha256', $passwort);

                    //Vergleich ob alle Datensätze ausgefüllt wurden

                    if ($_POST["passwort"] == NULL) {
                        echo "passwort ist leer";
                    } else {

                        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $_POST['passwort'])) {
                            echo 'Das Passwort entspricht nicht den Sicherheitsbestimmungen!<br>
                              Das Passwor muss aus folgenden Bestandteilen bestehen:<br>
                              - mindestens 8 Buchstaben<br>
                              - Groß und Kleinbuchstaben<br>
                              - Zahlen<br>
                              - Es sollte nach Möglichkeit auch mindestens ein Sonderzeichen enthalten!';
                        } else {

                            $control = 0;

                            $sql = "SELECT Username FROM personen WHERE Username = '$nickname'";

                            $result = mysqli_query($tunnel, $sql) or die($ordiestring);

                            while ($row = mysqli_fetch_object($result)) {
                                $control++;

                            }
                            if ($control != 0) {
                                $errorUserNameExists = true;
                                echo "<p>Username <strong>$nickname</strong> existiert bereits! Versuchen sie einen andern...</p>";

                            } else {

                                $sql = "INSERT INTO personen (Username, Nachname, Vorname, Geschlecht, PLZ, Strasse, Passwort) VALUES
                                      ('" . $nickname . "', '" . $nachname . "', '" . $vorname . "', '" . $geschlecht . "', '" . $ort . "', '" . $strasse . "', '" . $hash . "');";

                                $result = mysqli_query($tunnel, $sql);

                                echo "<p>Ihr Benutzer wurde erfolgreich angelegt, melden Sie sich jetzt an <a href='index.php'>Anmelden</a> </p>";

                            }
                        }
                    }

                } else {

                    echo "Achtung! Passwörter stimmen nicht überein";

                }
            } else {
                echo "Diese Stadt ist uns unbekannt";
            }



            mysqli_close($tunnel);


?>



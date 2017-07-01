<?php
	session_start();
    require_once('db_newconnection.php'); //require lassen und umbauen!


?>

<!DOCTYPE html>
<html>
<head>

<title>Login Page</title>

    <link href="css/login.css" rel="stylesheet">

</head>
<body>



<div class="login-page">
    <div class="hit-the-floor"><h1>Ticketsystem</h1></div>
    <div class="form">
        <form action="index.php" method="post">

            <input type="text" placeholder="Nickname" name="nickname" required/>
            <input type="password" placeholder="Passwort" name="password" required/>
            <button class="btn btn-default" name="login" type="submit">Einloggen</button>
            <p class="message">Noch nicht registriert? <a href="register.php">Werde jetzt Mitglied</a></p>
        </form>
    </div>


<br>
<br><br>

		<?php
			if(isset($_POST['login']))
			{
				$username=mysqli_escape_string($tunnel, $_POST['nickname']); //für andere wiederhohlen
				//$password=$_POST['password'];
				$password = mysqli_escape_string($tunnel, ($_POST['password']));

				$hash = hash('sha256', $password);

				$query = "select * from personen where Username='$username' and Passwort='$hash' ";
				//echo $query;
				$query_run = mysqli_query($tunnel,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['name'] = $username;
					//$_SESSION['password'] = $password; muss ich doch nicht an die session übergeben oder?

					
					header( "Location: ticketsystem.php");

					}
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
				}
			}
			else
			{
			}
			mysqli_close($tunnel);

		?>

		

</body>
</html>
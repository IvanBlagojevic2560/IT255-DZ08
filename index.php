<?php
session_start();
include_once 'konekcija.php';

if(isset($_SESSION['userSession'])!="")
{
	header("Location: main.php");
	exit;
}

if(isset($_POST['btn-login']))
{
	$email = $MySQLi_CON->real_escape_string(trim($_POST['email']));
	$upass = $MySQLi_CON->real_escape_string(trim($_POST['sifra']));
	
	$query = $MySQLi_CON->query("SELECT user_id, email, sifra FROM users WHERE email='$email'");
	$row=$query->fetch_array();
	
	if(password_verify($upass, $row['sifra']))
	{
		$_SESSION['userSession'] = $row['user_id'];
		header("Location: main.php");
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; email or password does not exists !
				</div>";
	}
	
	$MySQLi_CON->close();
	
}
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MET HOTELS</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Prijaviti se</h2><hr />
        
        <?php
		if(isset($msg)){
			echo $msg;
		}
		?>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="sifra" required />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Prijaviti se
			</button> 
            
            <a href="registracija.php" class="btn btn-default" style="float:right;">Registruj se </a>
            
        </div>  
        
        
      
      </form>

    </div>
    
</div>

</body>
</html>
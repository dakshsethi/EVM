<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>Calm breeze login screen</title>
<link rel="stylesheet" href="css/style.css">    
</head>
<?php
session_start();
  if(!empty($_GET['msg']))
{
	echo $_GET['msg'];
}
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if((!empty($_GET['var'])) && ($_GET['var']==hash("sha256",$_SESSION['voter_id'])))
		{
			
			include ('connection.php');
			$password=hash("sha256",$_POST['password']);
			$voter_id=$_SESSION['voter_id'];
			$type=2;
			$q="select * from voter where voter_id='$voter_id' && password='$password'";
			$res=mysqli_query($con,$q) or exit("Error in query");
			$c=mysqli_num_rows($res);
			if($c>0)
			{
				while($row=mysqli_fetch_array($res))
				{
					$uid=$row[0];
					$name=$row[2];
					$pic=$row[7];
				}
				$otp=rand(100000,999999);
				header("location:user_index.php?otp=".$otp."");
			}
			else
			{
				echo "<script>alert ('Kindly Re-check your Password')</script>";
			}

		}
		else
			header("location:user_logout.php");
			//session_destroy();
	}

  ?>
<body>
<div class="wrapper" style="height:763px; margin:-400px 0px 0px 0px;">
<div class="container" style="margin-top:200px;">
<h2>Enter Password</h2><br>
<?php
	echo "<img src='images/".$_SESSION['pic']."' width='100px' height='100px' style='border-radius:50%'>";
	echo "<h3>".ucwords($_SESSION['name'])."</h3>";
 ?>
<form class="form" method="post" action="<?php $_SERVER['PHP_SELF']?>">

<input type="password"placeholder="Enter Password" name="password" required="required">
<button type="submit" id="login-button">Login</button><br>

</form>
</div>
<ul class="bg-bubbles">
<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
</ul>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>

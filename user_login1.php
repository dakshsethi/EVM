<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>Calm breeze login screen</title>
<link rel="stylesheet" href="css/style.css">    
</head>
<?php
  if(!empty($_GET['msg']))
{
	echo $_GET['msg'];
	echo "<script>alert('Please Login First')</script>";
}
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		
		if(!empty($_POST['voter_id']))
		{
			
			include ('connection.php');
			$voter_id=$_POST['voter_id'];
			$type=1;
			$q="select * from voter where voter_id='$voter_id'&& type='$type'";
			$res=mysqli_query($con,$q) or exit("Error in query");
			$c=mysqli_num_rows($res);
			if($c>0)
			{
				$row=mysqli_fetch_row($res);
				{
					/*$uid=$row[0];
					$uname=$row[1];
					$pic=$row[8];
					$voter_idid=$row[2];
					header("location:login_password.php?voter_idid=".$voter_idid."&username=".$uname."&pic=".$pic."");*/
					
					$voter_id=$row[0];
					$name=$row[2];
					$const_id=$row[6];
					$state_id=substr($const_id,0,2);
					$pic=$row[7];
					$var=hash("sha256",$voter_id);
					header("location:user_login2.php?var=".$var."");
					
				}
				
				session_start();
				$_SESSION['voter_id']=$voter_id;
				$_SESSION['name']=$name;
				$_SESSION['pic']=$pic;
				$_SESSION['const_id']=$const_id;
				$_SESSION['state_id']=$state_id;
				
				/*session_start();
				$_SESSION['uid']=$uid;
				$_SESSION['uname']=$uname;
				$_SESSION['voter_id']=$voter_id;
				$_SESSION['profile_pic']=$pic;
				//header('location:home.php?msg='.$uname);*/
			}
			else
			{
				echo "<script>alert ('Kindly Re-check your Voter ID.')</script>";
			}

		}
	}

  ?>
<body>
<div class="wrapper" style="height:763px; margin:-400px 0px 0px 0px;">
<div class="container" style="margin-top:200px;">
<h1>Welcome</h1>
<form  action="<?php $_SERVER['PHP_SELF']?>" method="post">
<input type="text"  placeholder="Enter Voter ID" name="voter_id" required="required">
<input type="submit" id="login-button" value="Next"><br>
<!--<a href="forgot_password.php" style="text-decoration:none; color:white;">Forgot Password ?</a><br><br>
<a href="signup.php"><button type="button" class="color">Sign Up</a></button>
</button>-->
</div>
<ul class="bg-bubbles">
<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
</ul>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>

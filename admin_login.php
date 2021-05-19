<?php
	if(!empty($_GET['msg']))
	{
		echo "<script>alert('Please Login First')</script>";
	}	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if((!empty($_POST['username'])) && (!empty($_POST['password']))) 
		{
			
			include ('connection.php');
			$username=$_POST['username'];
			$password=hash("sha256",$_POST['password']);
			$q="select * from admin where username='$username' AND password='$password'";
			$res=mysqli_query($con,$q) or exit("Error in query");
			$c=mysqli_num_rows($res);
			if($c>0)
			{
				$row=mysqli_fetch_row($res);
				{
					$username=$row[0];
					$name=$row[2];
					header("location:admin_index.php");
				}
				
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['name']=$name;
			}
			else
			{
				echo "<script>alert('Kindly Re-check your username and password!')</script>";
			}

		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">-->

    <title>Signin Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="./Signin Template for Bootstrap_files/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./Signin Template for Bootstrap_files/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <img class="img-responsive" src="images/logo.jpg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="text" name="username" class="form-control" placeholder="Username" required autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2020-2011</p>
    </form>
  

</body></html>
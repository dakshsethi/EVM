<html>
</head>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<style>
.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center;
}
</style>
</head>
<body>
<?php
	include 'connection.php';
	session_start(); 
	if((!empty($_SESSION['voter_id'])))
	{
		;
	}
	else
	{
		header('location:user_login1.php?msg=Login First or Create your account');
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if((!empty($_POST['pid'])))
		{
			echo "<script>alert('Select your choice and hit VOTE')</script>";
			$party_id=$_POST['pid'];
			$voter_id=$_SESSION['voter_id'];
			$const_id=$_SESSION['const_id'];
			
			$state_id=$_SESSION['state_id'];
			$q1="select * from new_election where (state_id='$state_id' OR state_id='all') AND (type!=0)";
			
			$res1=mysqli_query($con,$q1) or exit('Error in query!');
			$row=mysqli_fetch_row($res1);
			$e_name=$row[0];
			
			$q="insert into vote values('$voter_id','$const_id','$e_name','$party_id')";
			$res=mysqli_query($con,$q) or exit('Error in query!');
			header('location:voting.php?msg=Thank You for voting!');
		}
	}
	
?>
<div class="container vertical-center">
<div class='text-center col-md-12' style='vertical-align:middle;'>
<?php
	echo "<h2>List of Candidates</h2>";
	echo "<table class='table table-hover' style='font-size:20px;'>
			<tr>
			<th>Name
			<th>Party
			</tr>";
	$const_id=$_SESSION['const_id'];
	$q="select name,p_name,party_id from candidates JOIN constituency USING(const_id) JOIN party USING(party_id) WHERE const_id='$const_id'";
	$res=mysqli_query($con,$q) or exit("Error in query");
	$c=mysqli_num_rows($res);
?>
<form role="form" id="myform" action="<?php $_SERVER['PHP_SELF']?>" method="post">
	
<?php	
	if($c>0)
	{

		while($row=mysqli_fetch_array($res))
		{
			$name=$row[0];
			$p_name=$row[1];
			$party_id=$row[2];
			echo "<tr>";
			echo "<td><input type='radio' id='party' name='pid' value=".$party_id." style='margin-right:20px;'>".$name;
			echo "<td>".$p_name;
			echo "</tr>";
		}
	}
	echo "</table>";
	echo "<input type='button' class='btn btn-success' onclick='g()' value='VOTE' />";
	echo "</form>";
	//echo "</table>";
	
?>
<script>
function g()
{

	//name=document.getElementById('party').value;
	var chk=confirm("Are you Sure..!Do yuo want to Vote!!");
	if(chk==true)
	{
		document.getElementById('myform').submit();
	}
	else
	{
		return false;
	}
}
</script>
</div>
</div>
</body>
</html>
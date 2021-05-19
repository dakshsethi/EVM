<?php
	include ('connection.php');
	include ('header.php');

  if(!empty($_GET['msg']))
{
	echo "<script>alert('Thank You for Voting!')</script>";
}
	
	$state_id=$_SESSION['state_id'];
	date_default_timezone_set('Asia/Kolkata');
	$date=date('Y-m-d');
	
	$q="select * from new_election where (state_id='$state_id' OR state_id='all') AND (type!=0)";
	$res=mysqli_query($con,$q) or exit('Error in query!');
	$c=mysqli_num_rows($res);
	if($c==0)
	{
		
	}
	else
	{
		$row=mysqli_fetch_row($res);
		$e_name=$row[0];
		$d=$row[2];
		
		$voter_id=$_SESSION['voter_id'];
		$q1="select * from vote where voter_id='$voter_id' AND e_name='$e_name'";
		$res1=mysqli_query($con,$q1) or exit('Error in query!');
		$c=mysqli_num_rows($res1);
		if($c>0)
			$d=0;
		
		if($d>$date)
		{
			$date1 = strtotime($date);
			$date2 = strtotime($d);
			$diff = $date2 - $date1;
			$days = round($diff/86400);
			echo "<div class='text-center col-md-12' style='vertical-align:middle;'>";
			echo "<h2>The ".$e_name." Elections are on ".$d."</h2>";
			echo "<h3>There are ".$days." days left!</h3>";
			echo "</div>";
		}
		else if($d<$date)
		{
			echo "<div class='text-center col-md-12' style='vertical-align:middle;'>";
			echo "<h2>No New Elections!</h2>";
			echo "</div>";
			if(empty($_GET['msg']))
				echo "<script>alert('Go Back!!')</script>";
			//header('location:user_index.php');
		}
		else
		{
			echo "<div class='text-center col-md-12' style='vertical-align:middle;'>";
			echo "<h2>The ".$e_name." Elections are Live now.</h2>";
			echo "<a class='btn btn-success' href='vote.php' style='font-size:16px;'>Vote Now</a>";
			echo "</div>";
		}
	}
?>
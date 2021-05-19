<?php
	include ('connection.php');
	include ('header.php');
	//echo "<a href='user_logout.php'>Logout</a><br><br>";
	$voter_id=$_SESSION['voter_id'];
	/*$q="select * from voter where voter_id='$voter_id'";
	$res=mysqli_query($con,$q) or exit("Error in query");
	$c=mysqli_num_rows($res);
	if($c>0)
	{
		while($row=mysqli_fetch_array($res))
		{
			$name=$row[2];
			$dob=$row[3];
			$age=$row[4];
			$mobile_num=$row[5];
			$const_id=$row[6];
			$q1="select * from constituency where const_id='$const_id'";
			$res1=mysqli_query($con,$q1) or exit("Error in query");
			while($row1=mysqli_fetch_array($res1))
			{
				$cname=$row1[1];
				$q2="select * from states WHERE state_id=substring('$const_id',1,2)";
				echo $q2;
				$res2=mysqli_query($con,$q1) or exit("Error in query");
				$row2=mysqli_fetch_assoc($res2);
				$state=$row2[1];
			}
			$pic=$row[7];
		}
	}*/
	
	
	$q="select name,dob,mobile_num,const_id,constituency,state,age FROM voter JOIN constituency USING(const_id) JOIN states ON(substring(const_id,1,2)=state_id) WHERE voter_id='$voter_id'";
	$res=mysqli_query($con,$q) or exit("Error in query");
	$c=mysqli_num_rows($res);
	if($c>0)
	{
		while($row=mysqli_fetch_array($res))
		{
			$name=$row[0];
			$dob=$row[1];
			$mobile_num=$row[2];
			$const_id=$row[3];
			$constituency=$row[4];
			$state=$row[5];
			$age=$row[6];
			
			
			//session_start();
			//$_SESSION['const_id']=substr($const_id,1,2);
		}
	}
	
	echo "<div class='col-md-12 row'>";
		echo "<div class='col-md-9'>";
			echo "<table class='table table-hover' style='color:white; font-size:20px;'>";
			echo "<thead class='thead-dark'>";
			echo "<tr><th colspan=2>General Information</th></tr>";
			echo "</thead>";
			echo "<tr><td>Name</td><td>".$name."</td></tr>";
			echo "<tr><td>Voter ID<td>".$voter_id."</tr>";
			echo "<tr><td>D.O.B.<td>".$dob."</tr>";
			echo "<tr><td>Age<td>".$age."</tr>";
			echo "<tr><td>Mobile<td>".$mobile_num."</tr>";
			echo "<tr><td>Constituency<td>".$constituency."</tr>";
			echo "<tr><td>State<td>".$state."</tr>";
			echo "</table>";
		echo "</div>";
		//echo "<div class='col-md-3'>";
			#echo "<img src='images/".$pic."' class='img-responsive col-md-3'>";
			echo "<img src='images/".$_SESSION['pic']."' class='img-responsive col-md-3'>";
		//echo "</div>";
	echo "</div>";
	
	/*echo "<h2>List of Candidates</h2>";
	echo "<table>
			<tr>
			<th>Name
			<th>Party
			</tr>";
	$q2="select * from candidates WHERE const_id='$const_id'";
	$res2=mysqli_query($con,$q2) or exit("Error in query");
	$c2=mysqli_num_rows($res2);
	if($c2>0)
	{
		while($row=mysqli_fetch_array($res2))
		{
			$c_name=$row[2];
			$party=$row[3];
			echo "<tr>";
			echo "<td>".$c_name;
			echo "<td>".$party;
			echo "</tr>";
		}
	}
	echo "</table>";*/
	echo "</div>";
?>
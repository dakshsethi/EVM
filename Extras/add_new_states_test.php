<?php
include 'connection.php';
$q="select distinct(substring(const_id,1,2)),state from constituency";
$res=mysqli_query($con,$q) or exit('Error in query');
while($row=mysqli_fetch_array($res))
{
	$state_id=$row[0]; 
	$state=$row[1];
	echo $state." ".$state_id;
	echo"<br>";
	$q1="insert into states(state_id,state) values('$state_id','$state')";
	$res1=mysqli_query($con,$q1);
}
?>
<?php
	include 'connection.php';
	$x=3;
	$q="SELECT constituency.const_id from constituency WHERE constituency.const_id NOT IN (select const_id  from candidates)";
	$res=mysqli_query($con,$q) or exit('Error in Query!');
	while($row=mysqli_fetch_array($res))
	{
		$const_id=$row[0];
		$test='T'.$x;
		$x++;
		$q1="INSERT INTO candidates VALUES('$test','$const_id','TEST01',1)";
		$test='T'.$x;
		$q2="INSERT INTO candidates VALUES('$test','$const_id','TEST02',2)";
		echo $q1." -- ".$q2."<br>";
		$res1=mysqli_query($con,$q1) or exit('Error in Query1!');
		$res2=mysqli_query($con,$q2) or exit('Error in Query2!');
		$x++;
	}
?>
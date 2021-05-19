<?php 
	include 'connection.php';
	include 'header1.php';
	
	if(!empty($_POST['cnt']))
	{
		$cnt=$_POST['cnt'];
		echo "<script>alert($cnt)</script>";
		$q0="SELECT * FROM new_election WHERE type!=0";
		$res0=mysqli_query($con,$q0) or exit('Error in Query0!');
		$x=0;
		while($row0=mysqli_fetch_array($res0))
		{
			if($cnt==$x+1)
			{
				$e_name=$row0[0];
				$state_id=$row0[1];
				$date=$row0[2];
			}
			$x++;
		}	
		if($state_id!='all')
			$q="SELECT voter_id,const_id from voter WHERE SUBSTR(const_id,1,2)='$state_id'";
		else
			$q="SELECT voter_id,const_id from voter";
		$res=mysqli_query($con,$q) or exit('Error in Query!');
		while($row=mysqli_fetch_array($res))
		{
			$voter_id=$row[0];
			$const_id=$row[1];
			$q1="SELECT * from vote WHERE e_name='$e_name' AND voter_id='$voter_id'";
			$res1=mysqli_query($con,$q1) or exit('Error in Query1!');
			$c=mysqli_num_rows($res1);
			if($c==0)
			{
				$q2="SELECT party_id FROM candidates WHERE const_id='$const_id' ORDER BY RAND() LIMIT 1";
				$res2=mysqli_query($con,$q2) or exit('Error in Query2!');
				$row1=mysqli_fetch_row($res2);
				$party_id=$row1[0];
				
				$q3="INSERT INTO vote VALUES('$voter_id','$const_id','$e_name','$party_id')";
				$res3=mysqli_query($con,$q3) or exit('Error in Query3!');
				
				$q4="UPDATE new_election SET type=0 WHERE election_name='$e_name' AND state_id='$state_id' AND date='$date'";
				mysqli_query($con,$q4) or exit('Error in Query4!');
			}
		}
	}
	
	
	
	
	//$q="INSERT INTO vote VALUES('','','','')";
?>
<div class="row">
	<div class="col-md-6">
		<form role="form" id="myform" action="<?php $_SERVER['PHP_SELF']?>" method="post">
			<label for="exampleFormControlSelect1">Select Election</label>
			<select class="form-control" name='cnt' id="exampleFormControlSelect1">
				<?php
					$q="select * from new_election where type!=0";
					$res=mysqli_query($con,$q) or exit('Error in Query!');
					$cnt=1;
					while($row=mysqli_fetch_array($res))
					{
						if($row[1]=='all')
							$row[1]='All India Level';
						echo "<option value='$cnt'>$row[0] --> $row[1]</option>";
						$cnt++;
					}
				?>
			</select>
			<br>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>

<?php

		include ('connection.php');
	include 'header1.php';
	date_default_timezone_set('Asia/Kolkata');

	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if((!empty($_POST['election_name'])) && (!empty($_POST['state_id'])) && (!empty($_POST['date'])))
		{
				$election_name=$_POST['election_name'];
				$state_id=$_POST['state_id'];
				$date=date('Y-m-d', strtotime($_POST['date']));;
				if($state_id=='all')
					//type = 1 - All States
					//type = 2 - All Constituencies of that State
					//type = 0 - Election completed
					$type=1;
				else
					$type=2;
				$q="select * from new_election where date='$date' AND type!=0";
				$flag=0;
				$res=mysqli_query($con,$q) or exit('Error in Query');
				$c=mysqli_num_rows($res);
				if($c>0)
				{
					
					while($row=mysqli_fetch_array($res))
					{
						if($row[1]=='all' OR $row[1]==$state_id)
							$flag=1;
					}
					if($state_id=='all' and $flag==0)
						$flag=1;
					if($flag==0)
					{
						$q1="insert into new_election values('$election_name','$state_id','$date','$type')";
						mysqli_query($con,$q1) or exit('Error in Query');
						echo "<script>alert('New Election Added')</script>";
					}
					else
						echo "<script>alert('There is already an election on the same day!')</script>";
				}
				else
				{
					$q2="insert into new_election values('$election_name','$state_id','$date','$type')";
					mysqli_query($con,$q2) or exit('Error in Query2');
					echo "<script>alert('New Election Added')</script>";
				}
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<form role="form" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="post" id="form">
			<label>Enter Election Name</label> 
			<input type="text" placeholder="Election Name" name="election_name" class="form-control" required>
			<br>
			<label>Select State</label>
			<select class="form-control" name="state_id"required>
				<option value='all'>All India Level</option>
				<?php 
					$q="select * from states";
					$res=mysqli_query($con,$q) or exit('Error in query');
					while ($row=mysqli_fetch_array($res))
					{
						echo "<option value=$row[0]>$row[1]</option>";
					}
				?>
			</select>
			<br>
			<label>Select Election Date</label>
			<input class="form-control" type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
			<br>
			<button type="button" onclick="a()" class="btn btn-primary">Create New Election</button>
		</form>
	</div>
</div>
<script>
function a()
{
	var a=document.getElementById('date').value;
	var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;
	if(a>today)
	{
		document.getElementById('form').submit();
	}
	else
	{
		alert("Please Select Date after "+today);
	}
}
</script>
</body>
</html>
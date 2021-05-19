<?php
	include 'connection.php';
	include 'header1.php';
?>
<div class="row">
	<div class="col-md-3">A</div>
	<div class="col-md-6 text-center">
		<table class="table table-hover table-sm table-responsive-xl">
		  <thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Party</th>
			  <th scope="col">Votes</th>
			</tr>
		  </thead>
		  <tbody>
				<?php
					$x=1;
					$q="select party_id,count(*) from vote group by party_id";
					$res=mysqli_query($con,$q) or exit('Error in Query!');
					while($row=mysqli_fetch_array($res))
					{
						$party_id=$row[0];
						$votes=$row[1];
						$q1="select p_name from party WHERE party_id='$party_id'";
						$res1=mysqli_query($con,$q1) or exit('Error in Query1!');
						$row1=mysqli_fetch_row($res1);
						$party=$row1[0];
						
						echo "<tr>";
						echo "<th scope='row'>$x</th>";
						echo "<td>$party</td>";
						echo "<td>$votes</td>";
						echo "</tr>";
						$x++;
					}
				?>
		  </tbody>
		</table>
	</div>
	
	<div class="col-md-12">
	<table class="table table-hover table-sm table-responsive-xl">
		  <thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">State</th>
			  <th scope="col">Population</th>
			  <th scope="col">Votes</th>
			  <th scope="col">% Turnout</th>
			</tr>
		  </thead>
		  <tbody>
				<?php
					$x=1;
					$q="select substr(const_id,1,2) AS STATE,count(*) from vote group by substr(const_id,1,2)";
					//Define Which Election!!
					$res=mysqli_query($con,$q) or exit('Error in Query!');
					while($row=mysqli_fetch_array($res))
					{
						$state_id=$row[0];
						$votes=$row[1];
						$q1="select count(*) from voter where substr(const_id,1,2)='$state_id'";
						$res1=mysqli_query($con,$q1) or exit('Error in Query1!');
						$row1=mysqli_fetch_row($res1);
						$population=$row1[0];
						
						$q2="select state from states WHERE state_id='$state_id'";
						$res2=mysqli_query($con,$q2) or exit('Error in Query2!');
						$row2=mysqli_fetch_row($res2);
						$state=$row2[0];
						
						$per_turnout=$votes*100/$population;
						
						echo "<tr>";
						echo "<th scope='row'>$x</th>";
						echo "<td>$state</td>";
						echo "<td>$population</td>";
						echo "<td>$votes</td>";
						echo "<td>$per_turnout%</td>";
						echo "</tr>";
						$x++;
					}
				?>
		  </tbody>
		</table>
	</div>
</div>
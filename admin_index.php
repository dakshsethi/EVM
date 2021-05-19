<?php
	include 'header1.php';
?>
         <!-- <canvas class="my-4 chartjs-render-monitor" id="myChart" width="1076" height="454" style="display: block; width: 1076px; height: 454px;"></canvas>
-->



	<div class="row">
		<div class="card text-white bg-primary col-md-4" style="margin:0px 10px; padding:0px;">
		  <div class="card-header"><h4>States & Union Territories</h4></div>
		  <div class="card-body">
		  <?php
			$q="select count(*) from states";
			$res=mysqli_query($con,$q) or exit('Error in query!');
			$row=mysqli_fetch_row($res);
			echo "<h5 class='card-title'>Total Count :</h5>";
			echo "<h2>".$row[0]."</h2>";
		  ?>
		  </div>
		</div>
		
		<div class="card text-white bg-primary col-md-3" style="margin:0px 10px; padding:0px;">
		  <div class="card-header"><h4>Constituencies</h4></div>
		  <div class="card-body">
		  <?php
			$q="select count(*) from constituency";
			$res=mysqli_query($con,$q) or exit('Error in query!');
			$row=mysqli_fetch_row($res);
			echo "<h5 class='card-title'>Total Count :</h5>";
			echo "<h2>".$row[0]."</h2>";
		  ?>
		  </div>
		</div>
		
		<div class="card text-white bg-primary col-md-3" style="margin:0px 10px; padding:0px;">
		  <div class="card-header"><h4>Voters</h4></div>
		  <div class="card-body">
		  <?php
			$q="select count(*) from voter";
			$res=mysqli_query($con,$q) or exit('Error in query!');
			$row=mysqli_fetch_row($res);
			echo "<h5 class='card-title'>Total Count :</h5>";
			echo "<h2>".$row[0]."</h2>";
		  ?>
		  </div>
		</div>
	</div>
        </main>
		
      </div>
	  
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Dashboard Template for Bootstrap_files/jquery-3.2.1.slim.min.js.download" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./Dashboard Template for Bootstrap_files/popper.min.js.download"></script>
    <script src="./Dashboard Template for Bootstrap_files/bootstrap.min.js.download"></script>

    <!-- Icons -->
    <script src="./Dashboard Template for Bootstrap_files/feather.min.js.download"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="./Dashboard Template for Bootstrap_files/Chart.min.js.download"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
  

</body></html>
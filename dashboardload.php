<?php 
	include 'include/dbconnect.php';

	$result="";

	$result="<style>
			  #tbl2 th
			  {
			  	background-color:#e63814;
			  	color:white;
			  	font-size: 14px;
			  	text-transform: uppercase;
			  	text-align: center;
			  	font-weight: bold;
			  }
			  #tbl2 td
			  {
			  	color: black;
			  	font-size: 14px;
			  	font-weight: bold;
			  	text-align: center;
			  }
			  #id1
			  {
			  	box-shadow: 2px 2px 10px #888888;
			  	overflow-y: scroll;
			  	height : 250px; 
			  }
			  ::-webkit-scrollbar
			  {
			    width: 5px;
			  }

			  #id2
			  {
			  	box-shadow: 2px 2px 10px #888888;
			  	overflow-y: scroll;
			  	height : 500px;
			  }
			</style>";

	$query = mysqli_query($connect, "select station_id from fca_stations");
 	$count=0;
 	$station_id = "";
    while($row = mysqli_fetch_array($query))
    {
        if($count==0)
        {
            $row_station_id = $row[0];
            $station_id .= "'".$row_station_id."'";
        }
        else
        {
            $row_station_id = $row[0];
            $station_id .= " , '".$row_station_id."'";
        }
        $count++;
    }

	$query1 = mysqli_query($connect,"select count(charger_id) from fca_charger where station_id IN ($station_id)");
	$fetch1 = mysqli_fetch_array($query1);
	$total_chargepoints = $fetch1[0];

	$query2 = mysqli_query($connect,"select count(charger_id) from fca_charger where station_id IN ($station_id) and status = 1");
	$fetch2 = mysqli_fetch_array($query2);
	$live_chargepoints = $fetch2[0];

	$query3 = mysqli_query($connect,"select count(charger_id) from fca_charger where station_id IN ($station_id) and status = 0");
	$fetch3 = mysqli_fetch_array($query3);
	$inactive_chargepoints = $fetch3[0];

	$dc_con_query = mysqli_query($connect,"select count(con_id) from fca_connectors where con_type IN ('CHAdeMo', 'CCS2', 'GBT') and charger_id IN (select charger_id from fca_charger where station_id IN ($station_id))");
	$dc_con_fetch = mysqli_fetch_array($dc_con_query);
	$dc_connectors = $dc_con_fetch[0];


	$ac_con_query = mysqli_query($connect,"select count(con_id) from fca_connectors where con_type IN ('ACTYPE2', 'IEC60309') and charger_id IN (select charger_id from fca_charger where station_id IN ($station_id))");
	$ac_con_fetch = mysqli_fetch_array($ac_con_query);
	$ac_connectors = $ac_con_fetch[0];


	$transaction_query1 = mysqli_query($connect,"select sum(total_cost), sum(total_unit) from fca_view_transaction");
	while($transaction_row1 = mysqli_fetch_array($transaction_query1))
	{
		$revenue = number_format($transaction_row1[0], 2);
		$kwh = number_format($transaction_row1[1], 2);
	}

	$charging_session_query1 = mysqli_query($connect,"select * from fca_view_history");
	$charging_sessions = mysqli_num_rows($charging_session_query1);

	$charging_session_query2 = mysqli_query($connect, "select count(transaction_id), sum(unit) from fca_view_charge_status where meter_status='1'");
	while($charging_session_row2 = mysqli_fetch_array($charging_session_query2))
	{
		$active_charging_sessions = $charging_session_row2[0];
		$active_kwh = $charging_session_row2[1];
	}

	$user_query1 = mysqli_query($connect, "select count(idtag) from fca_users");
	while($user_row1 = mysqli_fetch_array($user_query1))
	{
		$total_users = $user_row1[0];
	}
	$active_users = $total_users - 10;

	$fault_query1 = mysqli_query($connect, "select count(distinct(`con_id`)) from fca_errors_log where error_status = '0'");
	while($fault_row1 = mysqli_fetch_array($fault_query1))
	{
		$fault = $fault_row1[0];
	}



	$result.="
		<div class='container-fluid'>

		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
            <h5 style='color: black;'> Dashboard </h5>
			<div class='row clearfix progress-box'>
				
				<div class='col-lg-4 col-md-6 col-sm-12 mb-30'>
					<div class='card-box pd-30' id='id1'>
						<div class='row'>
							<div class='col-sm-12'>
								<h5 class='pt-20 h5' style='text-align: center;'> <b> Charging Points </b> </h5><br>
								<table class='table' id='tbl2'>
									<thead>
									  <tr>
										<th style='background-color: #050505;'> Total </th>
										<th style='background-color: green;'> Live </th>
										<th style='background-color: #e63814;'> Inactive </th>
									  </tr>
									</thead>
									<tbody>
									  <tr>
									  	<td style='background-color: lightgray;'> $total_chargepoints </td>
									  	<td style='background-color: lightgray;'> $live_chargepoints </td>
									  	<td style='background-color: lightgray;'> $inactive_chargepoints </td>
									  </tr>
									</tbody>
							  	</table>
							</div>
						</div>
					</div>
				</div>

				<div class='col-lg-4 col-md-6 col-sm-12 mb-30'>
					<div class='card-box pd-30' id='id1'>		
						<h5 class='pt-20 h5' style='text-align: center;'> <b> Total Connectors </b> </h5>
						<div class='row'>
							<div class='col-sm-4'>
								<img src='images/cpicon.svg' style='width:100px;'>
							</div>
							<div class='col-sm-8'><br>
								<h6> AC Connectors &nbsp; &nbsp; - &nbsp; &nbsp; $ac_connectors </h6><br>
								<h6> DC Connectors &nbsp; &nbsp; - &nbsp; &nbsp; $dc_connectors </h6>
							</div>
						</div>
					</div>
				</div>

				<div class='col-lg-4 col-md-6 col-sm-12 mb-30'>
					<div class='card-box pd-30' id='id1'>		
						<div class='row'>
							<div class='col-sm-12'>
								<h5 class='pt-20 h5' style='text-align: center;'> <b> Live Charging Sessions </b> </h5>
								<h2 class='pt-10' style='text-align: center;'> $active_charging_sessions </h2>
								<h5 class='pt-10 h5' style='text-align: center;'> Total </h5>
								<p style='text-align: center;'> $active_kwh Wh Energy Delivered </p>
							</div>
						</div>
					</div>
				</div>

			</div>


        	<h5 style='color: black;'> Overall Statistics </h5>
			<div class='card-box pd-30'>
                <div class='row'>
                   
                    <!-- <div class='col-lg-2 col-md-6 col-sm-12'>
                        <h5 class='pt-20 h5' style='text-align: center;'> Revenue </h5><br>
                        <h4 style='text-align: center;'> &#8377; $revenue </h4>
	                </div> -->

            		<div class='col-lg-3 col-md-6 col-sm-12'>
                        <h5 class='pt-20 h5' style='text-align: center;'> Energy Used (kWh) </h5><br>
                        <h4 style='text-align: center;'> $kwh </h4>
	                </div>

            		<div class='col-lg-3 col-md-6 col-sm-12'>	
                        <h5 class='pt-20 h5' style='text-align: center;'> Charging Sessions </h5><br>
                        <h4 style='text-align: center;'> $charging_sessions </h4>
            		</div>

            		<div class='col-lg-3 col-md-6 col-sm-12'>                
                        <h5 class='pt-20 h5' style='text-align: center;'> Total Users </h5><br>
                        <h4 style='text-align: center;'> $total_users </h4>
            		</div>

            		<!-- <div class='col-lg-3 col-md-6 col-sm-12'>                   
                        <h5 class='pt-20 h5' style='text-align: center;'> New Users </h5><br>
                        <h4 style='text-align: center;'> $active_users </h4>
                    </div> -->

            		<div class='col-lg-3 col-md-6 col-sm-12'>                   
                        <h5 class='pt-20 h5' style='text-align: center;'> Faults </h5><br>
                        <h4 style='text-align: center;'> $fault </h4>
                    </div>
        		</div>
        	</div><br>


        	<h5 style='color: black;'> Live Charger Status </h5>
			<div class='row'>";

			$con_query = mysqli_query($connect, "select * from fca_connectors where charger_id IN (select charger_id from fca_charger where station_id IN ($station_id) and status = 1) ");
			if(mysqli_num_rows($con_query)>0)
			{
				while($con_row = mysqli_fetch_array($con_query))
				{
					$charger_id = $con_row['charger_id'];
					$con_id = $con_row['con_id'];

					$con_query1 = mysqli_query($connect, "select status_notification from fca_connector_status where con_id = '$con_id'");
					while($con_row1 = mysqli_fetch_array($con_query1))
					{
						$status_notification = $con_row1[0];
					}

					$result.="
							<div class='col-lg-6 col-md-6 col-sm-12'>        
								<div class='card-box pd-30'>
									<div class='row'>
										<div class='col-sm-2'>
											<img src='images/charger.svg' style='width:60px; height: 60px;'>
										</div>
										<div class='col-sm-6'>
											<h5 class='h5'> $charger_id </h5>
		    	                    		<h6> Connector id : $con_id </h6>
										</div>
										<div class='col-sm-4'>
											<h5 class='pt-20 h5'> $status_notification &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     	      
												<a href = 'connectorstatus.php?con_id=$con_id'> <i class='fas fa-long-arrow-alt-right' style='font-size:20px'></i> </a>
											</h5>
										</div>
									</div>
			                	</div><br>
							</div>";
				}
			}
			else
			{
				$result.="
						<div class='col-lg-12 col-md-12 col-sm-12'>        
							<div class='card-box pd-30'>
								<div class='row'>
									<div class='col-sm-2'>
										<img src='images/charger.svg' style='width:60px; height: 60px;'>
									</div>
									<div class='col-sm-10'>
										<h5 class='pt-20 h5'> There is no live charging </h5>
									</div>
								</div>
		                	</div><br>
						</div>";
			}

			$result.="</div>


			</div>";

	echo $result;

?>
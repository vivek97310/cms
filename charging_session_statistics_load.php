<?php 
	include 'include/dbconnect.php';

	$result="";


	$result.="
		<div class='container-fluid'>
			<div class='row'>
                <div class='col-sm-12'>
                    <div class='pd-20 card-box mb-30'> 
                        <h4 style='text-align: center; color: #3d56d8;'> Live Charging Sessions </h4><br><br>
                    	<table class='data-table table stripe hover'>
                        	<thead>
                            	<tr>
                                	<th> Charger ID </th>
                                    <th> Connector ID </th>
                                    <th> Transaction ID </th>
                                    <th> Customer Name </th>
                                    <th> Start Time </th>
                                    <th> Duration </th>
	                                <th> Consumed Units (kWh) </th>
    	                            <th> Amount (Rs) </th>
        	                        <th> Status </th>
            	                </tr>
                	        </thead>
                        	<tbody>";

                            

                            
                            // echo date("Y-m-d H:i:s", strtotime("+30 minutes", $t));
                            // echo $newDate = date('Y-m-d H:i:s', strtotime($t.'-330 minutes'));
  
                            $query1 = mysqli_query($connect, "select * from fca_view_charge_status where meter_status = 1 order by transaction_id desc");
                            //$query1 = mysqli_query($connect, "select * from fca_view_charge_status order by transaction_id desc");
                            if(mysqli_num_rows($query1)>0)
                            {
                                while($row1 = mysqli_fetch_array($query1))
                                {
                                    $station_name = $row1['station_name'];
                                    $charger_id = $row1['charger_id'];
                                    $transaction_id = $row1['transaction_id'];
                                    $con_id = $row1['con_id'];
                                    $idtag = $row1['idtag'];
                                    $start_time_utc = $row1['start_time'];
                                    $unit_fare = $row1['unit_fare'];
                                    $base_fare = $row1['base_fare'];
                                    $gst_fare = $row1['gst_fare'];
                                    $start_time = date('Y-m-d H:i:s', strtotime($start_time_utc.'+330 minutes'));
                                    $unit = $row1['unit']/1000;

                                    $query2 = mysqli_query($connect, "select name from fca_users where idtag = '$idtag'");
                                    $fetch2 = mysqli_fetch_array($query2);
                                    $name = $fetch2['name'];

                                    /*$query3 = mysqli_query($connect, "select est_cost from fca_transaction_details where transaction_id = '$transaction_id'");
                                    $fetch3 = mysqli_fetch_array($query3);
                                    $est_cost = number_format($fetch3['est_cost'],2);*/
                                    $fin_cost=($unit_fare*$unit)+$base_fare;
                                    $est_cost=$fin_cost+(($fin_cost*$gst_fare)/100);
                                    $est_cost=number_format($est_cost,2);

                                    $time2 = date('Y-m-d H:i:s');
                                    $diff = abs(strtotime($start_time) - strtotime($time2));
                                    $tmins = $diff/60;
                                    $hours = floor($tmins/60);
                                    $min = $tmins%60;

                                    $result.="
                                        <tr>
                                            <td> $charger_id </td>
                                            <td> $con_id </td>
                                            <td> $transaction_id </td>
                                            <td> $name </td>
                                            <td> $start_time </td>
                                            <td> $hours Hrs : $min Mins </td>
                                            <td> $unit </td>
                                            <td> $est_cost </td>
                                            <td> <span class='badge-success' style='padding: 5px;'> Charging </span> </td>
                                        </tr>";
                                }
                            }
                            else
                            {
                                $result.="
                                    <tr>
                                        <td colspan = '9' style='text-align: center;'> There is no live charging </td>
                                    </tr>";
                            }

                            $result.="
                               
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>";

	echo $result;

?>
<?php

        header('Pragma: public');
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");   
        header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0');
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Content-Transfer-Encoding: none');
        header('Content-Type: application/vnd.ms-excel;');
        header("Content-type: application/x-msexcel");
        header('Content-Disposition: attachment; filename="Charger Report.xls"');
        
        
        include "include/dbconnect.php";
        
        session_start();
        $tbl=$tbl."<style>th,td{border:1px solid black;} </style>";


        $tbl.="<table>
                  <thead>
                    <tr><th colspan='4' align='center'> Charger Report</th></tr>
                    <tr>
                                       <th> S.No </th>
										<th> Connector Name </th>
                                        <th> Charger id </th>
                                        <th> Station id </th>
										<th> cpo id </th>
                                        <th> cms id </th>
										<th> Connector Type </th>
										<th> Connector Rating </th>
                                        <th> Status </th>
                                        <th> Unit Fare </th>         
                    </tr>
                  </thead>
                  <tbody>";
          
                   $s_no=0;
                                        $query1 = mysqli_query($connect,"SELECT * FROM `fca_view_qr_scan` WHERE 1");
                                        while($row = mysqli_fetch_array($query1))
                                        {
                                            $s_no++;
                                            $con_qr_code = $row['con_qr_code'];
                                            $charger_id = $row['charger_id'];
                                            $station_id = $row['station_id'];
											$cpo_id = $row['cpo_id'];
                                            $cms_id = $row['cms_id'];
                                            $con_type = $row['con_type'];
											$power_capacity = $row['power_capacity'];
                                            $status_notification = $row['status_notification'];
                                            $unit_fare = $row['unit_fare'];

                                            $tbl.=" <tr>
                                                <td>  $s_no </td>
                                                <td> $con_qr_code </td>
                                                <td> $charger_id </td>
                                                <td> $station_id </td>
                                                <td> $cpo_id </td>
                                                <td> $cms_id</td>
                                                <td> $con_type </td>
                                                <td> $power_capacity </td>
                                                <td> $status_notification </td>
                                                <td> $unit_fare </td>
                                            </tr>";
                                                $sr++; 
										}
                                    
        $tbl.="</tbody>
        </table>";

      echo $tbl;

?>
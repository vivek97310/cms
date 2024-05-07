<?php include "header.php"; ?>
<?php include "left.php"; ?>
<?php include 'include/dbconnect.php'; ?>


<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 style="color: #3d56d8;"> Chargers List </h4><br>
                        </div>
                    </div><br>
                    

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th><a class="btn btn-primary" href="javascript:void(0)" style="background-color: #3d56d8; color: white;" onclick="report()">Report</a></th>
                                        <th style="text-align: right;" colspan="11"> <a href="addconnector.php" style="color: white;"> <button type="button" name="add" class="btn btn-info"> Add Charger </button> </a></th>
                                    </tr>
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
                                         <th> Actions </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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

                                          
                                            ?>
                                            <tr>
                                                <td> <?php echo $s_no; ?></td>
                                                <td> <?php echo $con_qr_code; ?></td>
                                                <td> <?php echo $charger_id; ?></td>
                                                <td> <?php echo $station_id; ?></td>
                                                <td> <?php echo $cpo_id; ?></td>
                                                <td> <?php echo $cms_id; ?></td>
                                                <td> <?php echo $con_type; ?></td>
                                                <td> <?php echo $power_capacity; ?></td>
                                                <td> <?php echo $status_notification; ?></td>
                                                <td> <?php echo $unit_fare; ?></td>
                                                <td>  
                                                     <a href="editconnector.php?con_id=<?php echo $charger_id;?>"> <i class="dw dw-edit2"></i> </a> &nbsp; &nbsp;
                                                     <!--<a href="#" id="<?php echo $row["chargepoint_name"]; ?>" class="view_data"> <i class="dw dw-eye"></i> </a> &nbsp; &nbsp;-->
                                                    <!-- <a class="remove" style="cursor: pointer;"> <i class="dw dw-trash" style="color: red;"></i> </a> -->
                                                 </td> 
                                               
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                                

                            <div id="dataModal" class="modal fade">  
                                <div class="modal-dialog">  
                                    <div class="modal-content">  
                                        <div class="modal-header">    
                                            <h5 class="modal-title"> Charge Point Details</h5>  
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>  
                                        <div class="modal-body" id="chargepoint_details"></div>  
                                        <div class="modal-footer">  
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>  
                                    </div>  
                                </div>  
                            </div>  

                            


                        </div>
                    </div>

                </div>
                <!-- Bordered table End -->         

                </div>
                
            </div>
        </div>
    </div>

<script>
    function report()
    {
        window.location.href="charger_excel.php?";
    }
</script>    <!-- js -->

    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>

    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>


    <!-- buttons for Export datatable -->
    <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
    <!-- Datatable Setting js -->
    <script src="vendors/scripts/datatable-setting.js"></script>

</body>
</html>
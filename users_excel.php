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
        header('Content-Disposition: attachment; filename="User Report.xls"');
        
        
        include "include/dbconnect.php";
        
        session_start();
        $tbl=$tbl."<style>th,td{border:1px solid black;} </style>";


        $tbl.="<table>
                  <thead>
                    <tr><th colspan='4' align='center'> User Report</th></tr>
                    <tr>
                    <th> S.No </th>
                                        <th> Idtag </th>
                                        <th> Parent Idtag </th>
                                        <th> Name </th>
                                        <th> Mobile </th>
                                        <th> Email </th>
                                        <th> City </th>
                                        <th> Wallet Amount </th>
                                        <th> Amount Credit </th>
                                        <th> Amount Debit </th>

                    </tr>
                  </thead>
                  <tbody>";
          
                  
                                    
                                        $sr = 1;
                                        $querystring="SELECT * FROM fca_users where 1";
                                        $_SESSION["query"]=$querystring;
                                        $query = $querystring;
                                        $result = mysqli_query($connect,$query);
                                        if (mysqli_num_rows($result)>0)
                                        {
                                            while ($row = mysqli_fetch_array($result))
                                            {

                                                $query1 = mysqli_query($connect, "select city from fca_user_details where idtag = '".$row['idtag']."' ");
                                                $row1 = mysqli_fetch_array($query1);
                                                $city = $row1['city'];
                                                $query2 = mysqli_query($connect, "SELECT SUM(`amount`) FROM `fca_wallet_transaction` WHERE `idtag`='".$row['idtag']."' AND `credit/debit`=1");
                                                $row2 = mysqli_fetch_array($query2);
                                                $credit = $row2[0];
                                                $query3 = mysqli_query($connect, "SELECT SUM(`amount`) FROM `fca_wallet_transaction` WHERE `idtag`='".$row['idtag']."' AND `credit/debit`=0");
                                                $row3 = mysqli_fetch_array($query3);
                                                $debit = $row3[0];
                                                $buttonActive = (($row['status'] == 1)?'block':'none');
                                                $buttonInActive = (($row['status'] == 0)?'block':'none');
                                                
                                                 $idtag = $row['idtag'];
                                            $parent_idtag = $row['parent_idtag'];
                                            $name = $row['name'];
                                            $mobile = $row['mobile'];
                                            $email = $row['email'];
                                            $wallet_amount = $row['wallet_amount'];
                                            
                                                $tbl.=" <tr>
                                                <td>  $sr </td>
                                                <td> $idtag </td>
                                                <td> $parent_idtag </td>
                                                <td>  $name </td>
                                                <td> $mobile </td>
                                                <td> $email</td>
                                                <td>  $city </td>
                                                <td>  Rs .$wallet_amount </td>
                                                <td>  Rs .$credit </td>
                                                <td>  Rs .$debit </td>
                                            </tr>";
                                                $sr++;
                                            }
                                        }
                                    
        $tbl.="</tbody>
        </table>";

      echo $tbl;

?>
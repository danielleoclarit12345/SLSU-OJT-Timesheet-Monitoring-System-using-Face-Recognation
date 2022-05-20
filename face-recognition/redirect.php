<?php
    include '../config.php';
    date_default_timezone_set('Asia/Manila');
    session_start();
    global $conn;

 // login fr //
		 $query1 = "Select * from dtr where user_id = '".$_SESSION['user_id']."'";
         $result1 = mysqli_query($conn, $query1);
         $date_today = date('F j, Y');
         $time = date('h:i:s');
         $logTime = date('h:i:sA');
         $month = date('F');
         $totalAM = '';
         $totalPM = '';
         $totalHoursToday=0;

        if(mysqli_num_rows($result1) > 0){
           global $totalAM, $totalPM, $totalHoursToday;
           $row1 = mysqli_fetch_array($result1);
           if($row1['date'] == $date_today){
            if($row1['am_out'] == ''){
                $updateAmOut = "Update dtr set am_out = '".$time."' where user_id = '".$_SESSION['user_id']."'";
                $result = mysqli_query($conn, $updateAmOut);
                  // echo '
                      // <span>Student Name : '.$_SESSION['user_name'].'</span>
                      // <span>Date : '.$date_today.'</span>
                      // <span>Time-Out : '.$logTime.'</span>
                      // <i class="fa fa-clock-o"></i>
                  // ';

                  $getTotalTimeAM = "Select SEC_TO_TIME(TIME_TO_SEC(am_out) - TIME_TO_SEC(am_in)) AS TotalAM from dtr where user_id = '".$_SESSION['user_id']."'";
                  $resultTimeAM = mysqli_query($conn, $getTotalTimeAM);

                  $row1 = mysqli_fetch_array($resultTimeAM);
                  $totalAM = $row1['TotalAM'];

                  $updateTotalHrs = "Update dtr set total_hrs_today = '".$totalAM."' where user_id = '".$_SESSION['user_id']."'";
                  $resultTotalHours = mysqli_query($conn, $updateTotalHrs);

                  session_destroy();
            }else{
                if($row1['pm_in'] == ''){
                  $updatePmIn = "Update dtr set pm_in = '".$time."' where user_id = '".$_SESSION['user_id']."'";
                  $result = mysqli_query($conn, $updatePmIn);
                  // echo '
                      // <span>Student Name : '.$_SESSION['user_name'].'</span>
                      // <span>Date : '.$date_today.'</span>
                      // <span>Time-In : '.$logTime.'</span>
                      // <i class="fa fa-clock-o"></i>
                  // ';
                  // session_destroy();
                }else{
                    if($row1['pm_out'] == ''){
                      $updatePmOut = "Update dtr set pm_out = '".$time."' where user_id = '".$_SESSION['user_id']."'";
                      $result = mysqli_query($conn, $updatePmOut);
                      // echo '
                          // <span>Student Name : '.$_SESSION['user_name'].'</span>
                          // <span>Date : '.$date_today.'</span>
                          // <span>Time-Out : '.$logTime.'</span>
                          // <i class="fa fa-clock-o"></i>
                      // ';
                      $getTotalTimePM = "Select SEC_TO_TIME(TIME_TO_SEC(pm_out) - TIME_TO_SEC(pm_in)) AS TotalPM from dtr where user_id = '".$_SESSION['user_id']."'";
                      $resultTimePM = mysqli_query($conn, $getTotalTimePM);
    
                      $row = mysqli_fetch_array($resultTimePM);
                      $totalPM = $row['TotalPM'];
                      $totalHoursToday = strtotime($totalAM) +  strtotime($totalPM);

                      $updateFinalTotalHoursToday = "Update dtr set total_hrs_today = '".date("H:i:s", $totalHoursToday)."' where user_id = '".$_SESSION['user_id']."'";
                      $resultFinalTotalHoursToday = mysqli_query($conn, $updateFinalTotalHoursToday);

                      // session_destroy();
                    }else{
                        // echo 'You have reach the maximum number of time-in/time-out for today.';
                        // session_destroy();
                    }
                }
            }
         }
   
        }else{
            global $time, $date_today, $month;
            $insertTime = "Insert into dtr values ('', '".$_SESSION['user_id']."', '".$date_today."', '".$time."', '','','','".$month."','','','')";
            $result = mysqli_query($conn, $insertTime);
            
            // echo '
                // <span>Student Name : '.$_SESSION['user_name'].'</span>
                // <span>Date : '.$date_today.'</span>
                // <span>Time-In : '.$logTime.'</span>
                // <i class="fa fa-clock-o"></i>
            // ';
            // session_destroy();
        }
		
		
		// end //
		header("location:../index.php");
<?php
    require_once('references.php');
    include 'config.php';
    session_start();

    global $upperLinks;
    global $scriptLinks;

    $usertype = $_SESSION['usertype'];

    $getDepartment = "Select * from personnel where user_id = '".$_SESSION['user_id']."'";
    $result = mysqli_query($conn, $getDepartment);

    

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
             echo '<input class="hidden" type="text" value="'.$row['department'].'" id="department_type">';
        };        

    }

    $getStudentCompany = "Select * from student where user_id = '".$_SESSION['user_id']."'";
    $result = mysqli_query($conn, $getStudentCompany);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
             echo '<input class="hidden" type="text" value="'.$row['assigned_company'].'" id="student_company">';
        };        

    }

    if(empty($usertype)){
        header('Location:auth.php');
    }


?>
<?php
    echo $upperLinks;
?>
<title>SLSU OJT Timesheet Monitoring and Journal System using Face Recognition</title>
<div class="main_container">
    <input type="text" class="hidden" id="user_id" value="<?php echo $_SESSION['user_id'];?>">
    <div class="header">
        <img src="images/logo.png">
        <h3>slsu ojt timesheet monitoring and journal system using face recognition</h3>
        <div class="logout">
            <a href="logout.php"><i class="fa fa-refresh" id="icon_logout"></i>Logout</a>
        </div>
    </div>
    <div class="child_container">
        <img src="images/loading.gif" id="loader">
        <div class="messageBox">
            <span id="message"></span>
        </div>
        <div class="right_sideBar">
            <?php
               global $usertype;
               $output= '';
               if($usertype == '1'){
                  $output.='
                    <ul class="right_sideMenu">
                        <li class="active" id="btn_Personnel"><i class="fa fa-user-o"></i>Personnel</li>
                        <li id="btn_Masterlist"><i class="fa fa-file"></i>Masterlist</li>
                        <li id="btn_AdminAccount"><i class="fa fa-user-md"></i>Profile</li>
                        <input type="text" class="hidden" value="'.$usertype.'" id="usertype">
                    </ul>
                  ';
               }else if($usertype == '2'){
                $output.='
                  <ul class="right_sideMenu">
                      <li class="active" id="btn_OJT_Supervisor"><i class="fa fa-user-o"></i>OJT Supervisors</li>
                      <li id="btn_OJT_Assignment"><i class="fa fa-address-book"></i>OJT Students</li>
                      <li id="btn_OJT_Journals"><i class="fa fa-book"></i>OJT Journals</li>
                      <li id="btn_OJT_Announcement"><i class="fa fa-bullhorn"></i>Announcement</li>
                      <li id="btn_OJT_Coordinator_manageAccount"><i class="fa fa-user-md"></i>Profile</li>
                      <li id="btn_OJT_Coordinator_Chat"><i class="fa fa-comments"></i>Chat</li>
                      <input type="text" class="hidden" value="'.$usertype.'" id="usertype">
                  </ul>
                ';
              }
              else if($usertype == '3'){
                $output.='
                  <ul class="right_sideMenu">
                      <li class="active" id="btn_OJT_Status"><i class="fa fa-clock-o"></i>OJT Logs</li>
                      <li id="btn_OJT_Evaluation"><i class="fa fa-file-o"></i>Evaluation</li>
                      <li id="btn_SupervisorAccount"><i class="fa fa-user-md"></i>Profile</li>
                      <input type="text" class="hidden" value="'.$usertype.'" id="usertype">
                  </ul>
                ';
              }
              else if($usertype == '4'){
                $output.='
                  <ul class="right_sideMenu">
                      <li class="active" id="btn_studentStatus"><i class="fa fa-graduation-cap"></i>OJT TimeSheet</li>
                      <li id="btn_studentJournal"><i class="fa fa-address-book"></i>My Journal</li>
                      <li id="btn_studentAnnouncement"><i class="fa fa-bullhorn"></i>Announcement</li>
                      <li id="btn_studentProfile"><i class="fa fa-user-md"></i>Profile</li>
                      <li id="btn_studentChat"><i class="fa fa-comments"></i>Chat</li>
                      <input type="text" class="hidden" value="'.$usertype.'" id="usertype">
                  </ul>
                ';
              }

               echo $output;
            ?>
        </div>
        <div class="data">
           
        </div>
    </div>
</div>
<?php
    echo $scriptLinks;
?>


<?php
    include '../config.php';
    date_default_timezone_set('Asia/Manila');
    session_start();
    global $conn;

  //Authentication API Call
    if($_POST['api'] == 'login'){
        $output = '';
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $query = "Select * from accounts where username = '".$username."' and password = '".sha1($password)."'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                 $_SESSION['usertype'] = $row['usertype'];
                 $_SESSION['user_id'] = $row['Id'];
                 $_SESSION['user_name'] = $row['name'];
                if($row['usertype'] == '4'){
                    echo '2';
                }else{
                    echo '1';
                }
            };        
            
        }else{
            echo '0';
        }
    }
	if($_POST['api'] == 'login-fr'){
        $output = '';
        $username = htmlspecialchars($_POST['str']);
        $query = "Select * from accounts where name = '".$username."'";
        $result = mysqli_query($conn, $query);
		
		
		
		
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                 $_SESSION['usertype'] = $row['usertype'];
                 $_SESSION['user_id'] = $row['Id'];
                 $_SESSION['user_name'] = $row['name'];
				
                if($row['usertype'] == '4'){
                    echo '2';
                }else{
                    echo '1';
                }
            };        
            
        }else{
            echo '0';
        }
    }
    if($_POST['api'] == 'addjournal'){
		
		$img_name = $_FILES['profile']['name'];
        $img_tmp_name = $_FILES['profile']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_loc = strtolower($img_ex);
        $filepath = 'journal/'.$img_name;
		move_uploaded_file($img_tmp_name, $filepath);

        $query = "Insert into journal values('','".$_POST['user_id']."','".$img_name."','".$_POST['content']."',NOW())";
        $result = mysqli_query($conn, $query);
    }
	
	 if($_POST['api'] == 'send_chat'){
        $query = "Insert into chat values('','".$_POST['company_chat']."','".$_POST['user_name']."','".$_POST['message']."',NOW(),'".$_POST['chat_type']."')";
        $result = mysqli_query($conn, $query);
    }
	 if($_POST['api'] == 'get_chat'){
        $output = '';
		$company = $_POST['company'];
        $query  = "Select * from chat where company_chat='$company'";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.='  <div class="chat_contents">
							<li style="padding:8px 10px; background-color:#116BCA; border-radius:5px; width:30%; color:#FFFFFF;margin-bottom:5px;">Good morning everyone.</li>
							<small >Geraldine Mangmang, Send on</small>
						</div>';

        }
        echo $output;
    }

    //Register Student
    if($_POST['api'] == 'registerStudent'){
        $query = "Insert into accounts values('', '".$_POST['stud_name']."','".$_POST['stud_email']."', '".sha1($_POST['stud_pass'])."','Active','4')";
        $result = mysqli_query($conn, $query);

        if($result){
            echo '1';
        }else{
            echo '0';
        }
        $getUserId2 = "Select Id from accounts ORDER BY Id DESC LIMIT 1";
        $getResultId2 = mysqli_query($conn, $getUserId2);

        while($row = mysqli_fetch_array($getResultId2)){
            $user_id = $row['Id'];   
        }
        $query2 = "Insert into student values('', '".$_POST['stud_id']."', '".$_POST['stud_dprtmnt']."', '".$_POST['stud_section']."', 'Unassigned', '', '".$user_id."', '','','')";
        $result2 = mysqli_query($conn, $query2);
    }

  //Admin API Call
    if($_POST['api'] == 'fetchPersonnel'){
        $output = "";
        $query  = "Select accounts.*, personnel.department, personnel.user_id from personnel INNER JOIN accounts ON personnel.user_id = accounts.Id where accounts.usertype = 2";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td>$fetch[0]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[6]</td>
                    <td>$fetch[2]</td>
                    <td>$fetch[4]</td>
                    <td>
                        <i class='fa fa-edit text-primary' data_id='$fetch[0]' data_name='$fetch[1]' data_department='$fetch[6]' data_status ='$fetch[4]' id='btn_ShowUpdtPersonnel_Modal' style='cursor:pointer;'></i>
                        <i class='fa fa-trash text-danger' data_id='$fetch[0]' id='btn_ShowDeletePersonnel_Modal' style='cursor:pointer;'></i>
                    </td>
                </tr>";

        }
        echo $output;
    } 
    if($_POST['api'] == 'savePersonnel'){
        $fullname = $_POST['fullname'];
        $department = $_POST['department'];
        $personnel_uname = $_POST['personnel_username'];
        $personnel_pass = sha1($_POST['personnel_pass']);

        $query = "Insert into accounts values('', '".$fullname."', '".$personnel_uname."', '".$personnel_pass."', 'Active', '2')";
        $result = mysqli_query($conn, $query);
        if($result){
            echo '1';
              
          }else{
              echo '0';
        }

        $getUserId = "Select Id from accounts ORDER BY Id DESC LIMIT 1";
        $getResultId = mysqli_query($conn, $getUserId);

        while($row = mysqli_fetch_array($getResultId)){
            $user_id = $row['Id'];   
        }
        $query1 = "Insert into personnel values('', '".$department."', '".$user_id."','',0,'','')";
        $result1 = mysqli_query($conn, $query1);

    }
    if($_POST['api'] == 'updatePersonnel'){
        $query = "Update accounts set status = '".$_POST['updt_status']."' where Id = '".$_POST['updt_id']."'";
        $result = mysqli_query($conn, $query);

        if($result){
            $query = "Update personnel set department = '".$_POST['updt_department']."' where user_id = '".$_POST['updt_id']."'";
            $result = mysqli_query($conn, $query);
            echo '1';
        }else{
            echo '0';
        }
    }              
    if($_POST['api'] == 'deletePersonnel'){
        $query = "Delete from accounts where Id = '".$_POST['delete_id']."'";
        $result = mysqli_query($conn, $query);

        if($result){
            $query = "Delete from personnel where user_id = '".$_POST['delete_id']."'";
            $result = mysqli_query($conn, $query);
            echo '1';
        }else{
            echo '0';
        }
    }
    if($_POST['api'] == 'fetchPersonnelByDepartment'){
        $output = "";
        $query  = "Select accounts.*, personnel.department, personnel.user_id from personnel INNER JOIN accounts ON personnel.user_id = accounts.Id where accounts.usertype = 2 and personnel.department = '".$_POST['selected_item']."'";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td>$fetch[0]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[6]</td>
                    <td>$fetch[2]</td>
                    <td>$fetch[4]</td>
                    <td>
                        <i class='fa fa-edit text-primary' data_id='$fetch[0]' data_name='$fetch[1]' data_department='$fetch[6]' data_status ='$fetch[4]' id='btn_ShowUpdtPersonnel_Modal' style='cursor:pointer;'></i>
                    </td>
                </tr>";

        }
        echo $output;
    }
    if($_POST['api'] == 'fetchStudents'){
        $output = '';
        $query  = "Select student.department, student.section,student.student_id,student.user_id, accounts.name, accounts.username,accounts.status from accounts INNER JOIN student ON accounts.Id = student.user_id";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td>$fetch[3]</td>
                    <td>$fetch[2]</td>
                    <td>$fetch[4]</td>
                    <td>$fetch[0]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[5]</td>
                    <td>$fetch[6]</td>
                    <td class='text-center'>
                        <i class='fa fa-edit text-primary' data_id='$fetch[3]' data_name='$fetch[4]' data_status='$fetch[6]' id='btn_ShowUpdtStudent_Modal' style='cursor:pointer;'></i>
                    </td>     
                </tr>";

        }
        echo $output;
    }

    if($_POST['api'] == 'fetchStudentByDepartment'){
        $output = "";
        $query  = "Select student.department, student.section,student.student_id,student.user_id, accounts.name, accounts.username,accounts.status from accounts INNER JOIN student ON accounts.Id = student.user_id where student.department = '".$_POST['selected_item']."'";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td>$fetch[3]</td>
                    <td>$fetch[2]</td>
                    <td>$fetch[4]</td>
                    <td>$fetch[0]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[5]</td>
                    <td>$fetch[6]</td>
                    <td>
                        <i class='fa fa-edit text-primary' data_id='$fetch[0]' data_name='$fetch[1]' data_department='$fetch[6]' data_status ='$fetch[4]' id='btn_ShowUpdtPersonnel_Modal' style='cursor:pointer;'></i>
                        <i class='fa fa-trash text-danger' data_id='$fetch[0]' id='btn_ShowDeletePersonnel_Modal' style='cursor:pointer;'></i>
                    </td>     
                </tr>";

        }
        echo $output;
    }
    if($_POST['api'] == 'updateStudent'){
        $query = "Update accounts set status = '".$_POST['updt_status']."' where Id = '".$_POST['updt_id']."'";
        $result = mysqli_query($conn, $query);

        if($result){
            echo '1';
        }else{
            echo '0';
        }
    }
    if($_POST['api'] == 'updateAdmin'){
        $img_name = $_FILES['profile']['name'];
        $img_tmp_name = $_FILES['profile']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_loc = strtolower($img_ex);
        $filepath = 'profiles/'.$new_img_name;

       $query = "Update accounts set name = '".$_POST['admin_name']."', username = '".$_POST['uname']."', password = '".sha1($_POST['pass'])."' where Id = '".$_POST['id']."'";
       $result = mysqli_query($conn, $query);

       if($result){
            $query1 = "Update admin set address = '".$_POST['address']."', age = '".$_POST['admin_age']."', job_position = '".$_POST['job']."', profile = '".$img_name."' where user_id = '".$_POST['id']."'";
            $result1 = mysqli_query($conn, $query1);
            move_uploaded_file($img_tmp_name, $filepath);
           echo '1';
       }else{
           echo '0';
       }
    }
     
     //OJT Personnel API Call

    if($_POST['api'] == 'saveSupervisor'){
        $department_type = $_POST['department_type'];
        $supervisor = $_POST['supervisor'];
        $company = $_POST['company'];
        $locations = $_POST['locations'];
        $supervisor_uname = $_POST['supervisor_uname'];
        $supervisor_pass = sha1($_POST['supervisor_pass']);
        $year = date('Y');

        $query = "Insert into accounts values('', '".$supervisor."', '".$supervisor_uname."', '".$supervisor_pass."', 'Active', '3')";
        $result = mysqli_query($conn, $query);

        if($result){      
            echo '1';
        }else{
            echo '0';
        }
        $getUserId1 = "Select Id from accounts ORDER BY Id DESC LIMIT 1";
        $getResultId1 = mysqli_query($conn, $getUserId1);

        while($row1 = mysqli_fetch_array($getResultId1)){
            $user_id1 = $row1['Id'];
        }
        $query1 = "Insert into supervisor values('', '".$company."', '".$locations."', '".$department_type."', '".$user_id1."','',0,'','', '".$_POST['id']."', '".$year."')";
        $result1 = mysqli_query($conn, $query1);   
        
    }
	 if($_POST['api'] == 'fetchSupervisor'){
        $output = "";
        $query  = "Select accounts.*, supervisor.company, supervisor.location,supervisor.department,supervisor.personnel from supervisor INNER JOIN accounts ON supervisor.user_id = accounts.Id where accounts.usertype = 3 and supervisor.department = '".$_POST['department_type']."' and supervisor.personnel = '".$_POST['id']."'";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td>$fetch[0]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[6]</td>
                    <td>$fetch[7]</td>
                    <td>$fetch[2]</td>
                    <td class='text-center'>
                        <i class='fa fa-trash text-danger' data_id='$fetch[0]' id='btn_ShowDeleteSupervisor_Modal' style='cursor:pointer;'></i>
                    </td>
                </tr>";

        }
        echo $output;
    }
    if($_POST['api'] == 'fetchStudentJOurnal'){
        $output = "";
		$id = $_SESSION['user_id'];
        $query  = "select a.Id ,a.image , a.content , a.date_added from journal a left join accounts b on a.student_id = b.Id  where a.student_id = '$id'";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td><img src ='api/journal/". $fetch[1]."' width='200'></td>
                    <td>$fetch[2]</td>
                    <td>$fetch[3]</td>
                    <td class='text-center'>
                        <i class='fa fa-trash text-danger' data_id='$fetch[0]' id='btn_ShowDeleteJournal_Modal' style='cursor:pointer;'></i>
                    </td>
                </tr>";

        }
        echo $output;
    } 
	
	if($_POST['api'] == 'fetchStudentJOurnal1'){
        $output = "";
		$id = $_POST['id'];
        $query  = "select a.Id ,a.image , a.content , a.date_added from journal a left join accounts b on a.student_id = b.Id  where a.student_id = '$id'";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td><img src ='api/journal/". $fetch[1]."' width='200'></td>
                    <td>$fetch[2]</td>
                    <td>$fetch[3]</td>
                </tr>";

        }
        echo $output;
    }
    if($_POST['api'] == 'deleteSupervisor'){
        $query = "Delete from accounts where Id = '".$_POST['delete_id']."'";
        $result = mysqli_query($conn, $query);

        if($result){
            $query = "Delete from supervisor where user_id = '".$_POST['delete_id']."'";
            $result = mysqli_query($conn, $query);
            echo '1';
        }else{
            echo '0';
        }
    }
	
	if($_POST['api'] == 'deleteJournal'){
        $query = "Delete from journal where id = '".$_POST['delete_id']."'";
        $result = mysqli_query($conn, $query);
		if($result){
            echo '1';
        }else{
            echo '0';
        }
    }
	
    if($_POST['api'] == 'fetchStudentDetails'){
        $output = "";
        $query  = "Select student.section,student.student_id,student.user_id,student.assigned_company,student.location, accounts.name from accounts INNER JOIN student ON accounts.Id = student.user_id";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){                        
            $output.="
                <tr>
                    <td>$fetch[2]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[5]</td>
                    <td>$fetch[0]</td>
                    <td>$fetch[3]</td>
                    <td>$fetch[4]</td>
                    <td>
                        <i class='fa fa-book text-primary' data_id='$fetch[2]' data_name='$fetch[5]' data_location='$fetch[4]' data_company='$fetch[3]' data-sid='$fetch[2]' id='btn_show_journal' style='cursor:pointer;'></i>
                        <i class='fa fa-edit text-primary' data_id='$fetch[2]' data_name='$fetch[5]' data_location='$fetch[4]' data_company='$fetch[3]' id='btn_ShowUpdtOJTStudent_Modal' style='cursor:pointer;'></i>
                        <i class='fa fa-trash text-danger' data_id='$fetch[2]' id='btn_ShowDeleteStudent_Modal' style='cursor:pointer;'></i>
                    </td>
                </tr>";

        }
        echo $output;
    }
    if($_POST['api'] == 'fetchStudentByCompany'){
        $output = "";
        $query  = "Select student.section,student.student_id,student.user_id,student.assigned_company,student.location, accounts.name from accounts INNER JOIN student ON accounts.Id = student.user_id where student.assigned_company = '".$_POST['selected_item']."'";
        $result = mysqli_query($conn, $query);

        if($_POST['selected_item'] == 'Unassigned'){
            while($fetch = mysqli_fetch_array($result)){                        
                $output.="
                    <tr>
                        <td>$fetch[2]</td>
                        <td>$fetch[1]</td>
                        <td>$fetch[5]</td>
                        <td>$fetch[0]</td>
                        <td>$fetch[3]</td>
                        <td>$fetch[4]</td>
                        <td>
                            <i class='fa fa-edit text-primary' data_id='$fetch[2]' data_name='$fetch[5]' data_location='$fetch[4]' data_company='$fetch[3]' id='btn_ShowUpdtOJTStudent_Modal' style='cursor:pointer;'></i>
                            <i class='fa fa-trash text-danger' data_id='$fetch[2]' id='btn_ShowDeleteStudent_Modal' style='cursor:pointer;'></i>
                        </td>
                    </tr>";
            }
        }
        else if($_POST['selected_item'] == 'Assigned'){
            $query  = "Select student.section,student.student_id,student.user_id,student.assigned_company,student.location, accounts.name from accounts INNER JOIN student ON accounts.Id = student.user_id where student.assigned_company != 'Unassigned'";
            $result = mysqli_query($conn, $query);

            while($fetch = mysqli_fetch_array($result)){                        
                $output.="
                    <tr>
                        <td>$fetch[2]</td>
                        <td>$fetch[1]</td>
                        <td>$fetch[5]</td>
                        <td>$fetch[0]</td>
                        <td>$fetch[3]</td>
                        <td>$fetch[4]</td>
                        <td>
                            <i class='fa fa-edit text-primary' data_id='$fetch[2]' data_name='$fetch[5]' data_location='$fetch[4]' data_company='$fetch[3]' id='btn_ShowUpdtOJTStudent_Modal' style='cursor:pointer;'></i>
                            <i class='fa fa-trash text-danger' data_id='$fetch[2]' id='btn_ShowDeleteStudent_Modal' style='cursor:pointer;'></i>
                        </td>
                    </tr>";
            }
        }
        echo $output;
    }
    if($_POST['api'] == 'getCompany'){
        $output = '';
        $query = "Select company from supervisor where location = '".$_POST['selected_location']."'";
        $result = mysqli_query($conn, $query);

        while($company = mysqli_fetch_array($result)){
             $output.='
                <option value="'.$company[0].'">'.$company[0].'</option>
                ';
        }
        echo $output;
    }
    if($_POST['api'] == 'updateOjtStudent'){
        $query = "Update student set location = '".$_POST['updt_location']."', assigned_company = '".$_POST['updt_company']."' where user_id = '".$_POST['updt_id']."'";
        $result = mysqli_query($conn, $query);

        if($result){
            echo '1';
        }else{
            echo '0';
        }
    }
    if($_POST['api'] == 'saveAnnouncement'){
        $date_created = date('F j, Y');
        $query = "Insert into announcement values ('', '".$_POST['title']."', '".$_POST['description']."', '".$_POST['company']."', '".$date_created."', '".$_POST['id']."')";
        $result = mysqli_query($conn, $query);

        if($result){
            echo '1';
        }else{
            echo '0';
        }
    }
    if($_POST['api'] == 'fetchAnnouncement'){
            $output='';
            $query = "Select * from announcement ORDER BY date_created ASC";
            $result = mysqli_query($conn, $query);
            
            while($announcement = mysqli_fetch_array($result)){
                $output.='
                    <div class="card">
                        <h4 class="text-primary">'.$announcement['title'].'</h4>
                        <p style="text-align:justify;">'.$announcement['description'].'</p>
                        <small class="text-danger">'.$announcement['company'].'</small>
                        <small class="text-danger" style="display:block; margin-top:5px;">'.$announcement['date_created'].'</small>
                        <i class="fa fa-pencil" data_id='.$announcement['Id'].' data_title='.$announcement['title'].' data_desc='.$announcement['description'].' data_company='.$announcement['company'].' id="updt_announcement"></i>
                        <i class="fa fa-trash" data_id='.$announcement['Id'].' id="delete_announcement"></i>
                    </div>
                ';
            }
            echo $output;
    }
    if($_POST['api'] == 'updateAnnouncement'){
       $query = "Update announcement set title = '".$_POST['updt_title']."', description = '".$_POST['updt_description']."', company = '".$_POST['updt_company']."' where Id = '".$_POST['updt_announcementId']."'";
       $result = mysqli_query($conn, $query);

       if($result){
           echo 1;
       }else{
           echo 0;
       }
    }
    if($_POST['api'] == 'deleteAnnouncement'){
        $query = "Delete from announcement where Id = '".$_POST['id']."'";
        $result = mysqli_query($conn, $query);

        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    if($_POST['api'] == 'updateAccountPersonnel'){
        $img_name = $_FILES['personnel_profile']['name'];
        $img_tmp_name = $_FILES['personnel_profile']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_loc = strtolower($img_ex);
        $filepath = 'profiles/'.$img_name;

       $query = "Update accounts set name = '".$_POST['personnel_name']."', username = '".$_POST['personnel_uname']."', password = '".sha1($_POST['personnel_pass'])."' where Id = '".$_POST['id']."'";
       $result = mysqli_query($conn, $query);

       if($result){
            $query1 = "Update personnel set address = '".$_POST['personnel_address']."', age = '".$_POST['personnel_age']."', job_position = '".$_POST['personnel_job']."', profile = '".$img_name."' where user_id = '".$_POST['id']."'";
            $result1 = mysqli_query($conn, $query1);
            move_uploaded_file($img_tmp_name, $filepath);
           echo '1';
       }else{
           echo '0';
       }
    }

    //Supervisor API Call

    if($_POST['api'] == 'updateSupervisor'){
        $query = "Update accounts set name = '".$_POST['supervisor_name']."', username = '".$_POST['supervisor_uname']."', password = '".sha1($_POST['supervisor_pass'])."' where Id = '".$_POST['id']."'";
        $result = mysqli_query($conn, $query);
 
        if($result){
             $query1 = "Update supervisor set address = '".$_POST['supervisor_address']."', age = '".$_POST['supervisor_age']."', job_position = '".$_POST['supervisor_job']."' where user_id = '".$_POST['id']."'";
             $result1 = mysqli_query($conn, $query1);
            echo '1';
        }else{
            echo '0';
        }
     }
     
     if($_POST['api'] == 'getAnnouncementByStudentCompany'){
         $output = '';
         $query = "Select * from announcement where company = 'All' or company = '".$_POST['studentCompany']."' ORDER BY date_created ASC";
         $result = mysqli_query($conn, $query);

         while($fetch = mysqli_fetch_array($result)){
            $output.='
                <div class="card_announcement">
                    <h4 class="text-primary">'.$fetch['title'].'</h4>
                    <p style="letter-spacing:1px;">'.$fetch['description'].'</p>
                    <small class="text-danger">'.$fetch['company'].'</small>
                    <small class="text-danger" style="display:block; margin-top:5px;">'.$fetch['date_created'].'</small>
                </div>
            ';
         }
         echo $output;
     }

     //Student API Call

     if($_POST['api'] == 'studentLog'){
         $query = "Select * from dtr where user_id = '".$_SESSION['user_id']."'";
         $result = mysqli_query($conn, $query);
         $date_today = date('F j, Y');
         $time = date('h:i:s');
         $logTime = date('h:i:sA');
         $month = date('F');
         $totalAM = '';
         $totalPM = '';
         $totalHoursToday=0;

        if(mysqli_num_rows($result) > 0){
           global $totalAM, $totalPM, $totalHoursToday;
           $row = mysqli_fetch_array($result);
           if($row['date'] == $date_today){
            if($row['am_out'] == ''){
                $updateAmOut = "Update dtr set am_out = '".$time."' where user_id = '".$_SESSION['user_id']."'";
                $result = mysqli_query($conn, $updateAmOut);
                  echo '
                      <span>Student Name : '.$_SESSION['user_name'].'</span>
                      <span>Date : '.$date_today.'</span>
                      <span>Time-Out : '.$logTime.'</span>
                      <i class="fa fa-clock-o"></i>
                  ';

                  $getTotalTimeAM = "Select SEC_TO_TIME(TIME_TO_SEC(am_out) - TIME_TO_SEC(am_in)) AS TotalAM from dtr where user_id = '".$_SESSION['user_id']."'";
                  $resultTimeAM = mysqli_query($conn, $getTotalTimeAM);

                  $row = mysqli_fetch_array($resultTimeAM);
                  $totalAM = $row['TotalAM'];

                  $updateTotalHrs = "Update dtr set total_hrs_today = '".$totalAM."' where user_id = '".$_SESSION['user_id']."'";
                  $resultTotalHours = mysqli_query($conn, $updateTotalHrs);

                  session_destroy();
            }else{
                if($row['pm_in'] == ''){
                  $updatePmIn = "Update dtr set pm_in = '".$time."' where user_id = '".$_SESSION['user_id']."'";
                  $result = mysqli_query($conn, $updatePmIn);
                  echo '
                      <span>Student Name : '.$_SESSION['user_name'].'</span>
                      <span>Date : '.$date_today.'</span>
                      <span>Time-In : '.$logTime.'</span>
                      <i class="fa fa-clock-o"></i>
                  ';
                  session_destroy();
                }else{
                    if($row['pm_out'] == ''){
                      $updatePmOut = "Update dtr set pm_out = '".$time."' where user_id = '".$_SESSION['user_id']."'";
                      $result = mysqli_query($conn, $updatePmOut);
                      echo '
                          <span>Student Name : '.$_SESSION['user_name'].'</span>
                          <span>Date : '.$date_today.'</span>
                          <span>Time-Out : '.$logTime.'</span>
                          <i class="fa fa-clock-o"></i>
                      ';
                      $getTotalTimePM = "Select SEC_TO_TIME(TIME_TO_SEC(pm_out) - TIME_TO_SEC(pm_in)) AS TotalPM from dtr where user_id = '".$_SESSION['user_id']."'";
                      $resultTimePM = mysqli_query($conn, $getTotalTimePM);
    
                      $row = mysqli_fetch_array($resultTimePM);
                      $totalPM = $row['TotalPM'];
                      $totalHoursToday = strtotime($totalAM) +  strtotime($totalPM);

                      $updateFinalTotalHoursToday = "Update dtr set total_hrs_today = '".date("H:i:s", $totalHoursToday)."' where user_id = '".$_SESSION['user_id']."'";
                      $resultFinalTotalHoursToday = mysqli_query($conn, $updateFinalTotalHoursToday);

                      session_destroy();
                    }else{
                        echo 'You have reach the maximum number of time-in/time-out for today.';
                        session_destroy();
                    }
                }
            }
         }
   
        }else{
            global $time, $date_today, $month;
            $insertTime = "Insert into dtr values ('', '".$_SESSION['user_id']."', '".$date_today."', '".$time."', '','','','".$month."','','','')";
            $result = mysqli_query($conn, $insertTime);
            
            echo '
                <span>Student Name : '.$_SESSION['user_name'].'</span>
                <span>Date : '.$date_today.'</span>
                <span>Time-In : '.$logTime.'</span>
                <i class="fa fa-clock-o"></i>
            ';
            session_destroy();
        }
     }

     if($_POST['api'] == 'studentStatus'){
         $output = '';
         $query = "Select dtr.*, accounts.Id from accounts INNER JOIN dtr ON accounts.Id = dtr.user_id where accounts.Id = '".$_POST['id']."'";
         $result = mysqli_query($conn, $query);

         while($fetch = mysqli_fetch_array($result)){
            $output.="
            <tr>
                <td>$fetch[2]</td>
                <td>$fetch[3]</td>
                <td>$fetch[4]</td>
                <td>$fetch[5]</td>
                <td>$fetch[6]</td>
                <td>$fetch[8]</td>
                <td>$fetch[9]</td>
            </tr>";
         }
         echo $output;
     }

     if($_POST['api'] == 'getStudentStatusByMonth'){
        $output = '';
        $query = "Select dtr.*, accounts.Id from accounts INNER JOIN dtr ON accounts.Id = dtr.user_id where accounts.Id = '".$_POST['id']."' and dtr.month = '".$_POST['month']."'";
        $result = mysqli_query($conn, $query);

        while($fetch = mysqli_fetch_array($result)){
           $output.="
           <tr>
               <td>$fetch[2]</td>
               <td>$fetch[3]</td>
               <td>$fetch[4]</td>
               <td>$fetch[5]</td>
               <td>$fetch[6]</td>
               <td>$fetch[8]</td>
               <td>$fetch[9]</td>
           </tr>";
        }
        echo $output;
     }

?>
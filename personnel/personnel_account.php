<?php
   include '../config.php';
   session_start();
   global $conn;
   global $username, $name, $address, $age, $job, $profile, $rowImg;

   $query = "Select personnel.*, accounts.* from accounts INNER JOIN personnel ON accounts.Id = personnel.user_id where accounts.Id = '".$_SESSION['user_id']."'";
   $result = mysqli_query($conn, $query);
   
   while($personnel = mysqli_fetch_array($result)){
       $personnel_uname = $personnel['username'];
       $personnel_name = $personnel['name'];
       $personnel_address = $personnel['address'];
       $personnel_age = $personnel['age'];
       $personnel_job = $personnel['job_position'];
       $personnel_profile = $personnel['profile']; 
   }
?>
<div class="admin_profile">
   <div class="profile">
        <div>
            <img src="api/profiles/<?php  echo $personnel_profile; ?>" id="imgProfile">
            <input type="file" id="my_profile">
        </div>
        <div>
            <div class="form-input">
                <label for="username">Username :</label>
                <input type="text" value="<?php echo $personnel_uname; ?>" id="admin_uname">
            </div>
            <div class="form-input">
                <label for="password">New Password :</label>
                <input type="text" id="admin_pass">
            </div>
        </div>
   </div>
   <div class="form-group">
        <div class="form-input">
            <label for="password">Name :</label>
            <input type="text" value="<?php echo $personnel_name; ?>" id="admin_name">
        </div>
        <div class="form-input">
            <label for="password">Address :</label>
            <input type="text" value="<?php echo $personnel_address; ?>" id="admin_address">
        </div>
        <div class="form-input">
            <label for="password">Age :</label>
            <input type="number" value="<?php echo $personnel_age; ?>" id="admin_age">
        </div>
        <div class="form-input">
            <label for="password">Job Position :</label>
            <input value="<?php echo $personnel_job; ?>" id="admin_job">
            <button id="btn_saveChangesPersonnel">Save Changes</button>
        </div>
   </div>
</div>
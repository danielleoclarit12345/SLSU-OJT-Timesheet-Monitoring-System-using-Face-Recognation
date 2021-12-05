<?php
    include '../config.php';
    session_start();
    global $conn;
    global $username, $name, $address, $age, $job, $profile, $rowImg;

    $query = "Select admin.*, accounts.* from accounts INNER JOIN admin ON accounts.Id = admin.user_id";
    $result = mysqli_query($conn, $query);
    
    while($admin = mysqli_fetch_array($result)){
        $username = $admin['username'];
        $name = $admin['name'];
        $address = $admin['address'];
        $age = $admin['age'];
        $job = $admin['job_position'];
        $profile = $admin['profile'];
        $rowImg = $admin['profile'];
    }
?>
<div class="admin_profile">
   <div class="profile">
        <div>
            <img src="api/profiles/<?php  echo $rowImg; ?>" id="imgProfile">
            <input type="file" id="my_profile" name="my_profile">
        </div>
        <div>
            <div class="form-input">
                <label for="username">Username :</label>
                <input type="text" value="<?php echo $username; ?>" id="admin_uname">
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
            <input type="text" value="<?php echo $name; ?>" id="admin_name">
        </div>
        <div class="form-input">
            <label for="password">Address :</label>
            <input type="text" value="<?php echo $address; ?>" id="admin_address">
        </div>
        <div class="form-input">
            <label for="password">Age :</label>
            <input type="number" value="<?php echo $age; ?>" id="admin_age">
        </div>
        <div class="form-input">
            <label for="password">Job Position :</label>
            <input value="<?php echo $job; ?>" id="admin_job">
            <button id="btn_saveChangesAdmin">Save Changes</button>
        </div>
   </div>
</div>
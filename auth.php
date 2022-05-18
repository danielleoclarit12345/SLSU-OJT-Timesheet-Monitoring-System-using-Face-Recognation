<?php
    require_once('references.php');
    date_default_timezone_set('Asia/Manila');
    session_start();
    global $upperLinks;
    global $scriptLinks;

    //$usertype = $_SESSION['usertype'];

    // if(isset($usertype)){
    //     header('Location:index.php');
    // }else if(empty($usertype)){
    //     header('Location:auth.php');
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        echo $upperLinks;
    ?>
<head>
    <title>SLSU OJT Timesheet Monitoring and Journal System using Face Recognition</title>
</head>
<body>
    <main>
	  
        <input type="text" value="<?php echo $_SESSION['user_id']; ?>" class="hidden" id="user_id">
        <div class="overlay">
          <img src="images/logo.png" id="logo">
          <h3 class="title">slsu ojt timesheet monitoring and journal system using face recognition
		  
		    <?php if(isset($_GET['success'])){?>
			<br>
			<br>
				<small>
					<center><strong>Success!</strong> Your Account is now Activated!</center>
				</small>
					<?php } ?>
		  </h3>
		  
	
          <div class="card">
		
           <i class="fa fa-user" id="user"></i>
           <div class="menu">
		   
                <h4 class="selected" id="sign_in">Sign-in</h4>
                <h4 id="register">Register<small class="text-primary" style="margin-left:5px;">(For Students Only.)</small></h4>
           </div>
            <div class="login_form">
			
                    <div class="form-input">
                        <div class="bg-danger text-danger text-center" id="error"></div>
                        <label for="username">Email address<span>*</span></label>
                        <input type="text" id="username">
                        <small id="error_username"></small>
                    </div>
                    <div class="form-input">
                        <label for="password">Password<span>*</span></label>
                        <input type="password" id="password">
                        <small id="error_password"></small>
                        <button id="btn_Login">Sign-in</button>
                        <button id="btn_Student"><a href="face-recognition/check-face-recognition.php"><i class="fa fa-graduation-cap"></i>Sign-in as Student</a></button>
                    </div>
                    <span>Forgot Password?<a href="#">Click Here</a></span>
            </div>
            <div class="register_form">
                   <!-- <button id="btn_Capture"><i class="fa fa-camera"></i>Capture</button>-->
                    <div class="form-input">
                        <label for="stud_id">Student Id<span>*</span></label>
                        <input type="text" id="stud_id">
                        <small id="error_studID"></small>
                    </div>
                    <div class="form-input">
                        <label for="stud_id">Name<span>*</span></label>
                        <input type="text" id="stud_name" required>
                        <small id="error_studName"></small>
                    </div>
                    <div class="form-input">
                        <label for="department">Department<span>*</span></label>
                        <select id="stud_department" required>
                            <option value="">--</option>
                            <option value="CCSIT">CCSIT</option>
                            <option value="CHTM">CHTM</option>
                            <option value="CCJ">CCJ</option>
                            <option value="COE">COE</option>
                            <option value="CTE">CTE</option>
                        </select>
                        <small id="error_studDepartment"></small>
                    </div>
                    <div class="form-input">
                        <label for="department">Section<span>*</span></label>
                        <select id="stud_section" required>
                            <option value="">--</option>
                            <option value="A">A</option>
                        </select>
                        <small id="error_studSection"></small>
                    </div>
                    <div class="form-input">
                        <label for="stud_id">Email<span>*</span></label>
                        <input type="email" id="stud_email" required>
                        <small id="error_studEmail"></small>
                    </div>
                    <div class="form-input">
                        <label for="stud_id">Password<span>*</span></label>
                        <input type="text" id="stud_pass" required>
                        <small id="error_studPass"></small>
                        <button id="btn_Register">Register</button>
                    </div>
              </div>
			  
            <div class="student_sign_in">
                <img src="images/face.png" id="face_recog">
                <button id="btn_LoginStudent">Login</button>
               <span class="face">
                   Place up properly your face to the camera.
               </span>
            </div>
          </div>
        </div>
     
    </main>

    <!-- Modal Student Login -->
    <div class="modal fade bd-example-modal-sm" id="modal_Login"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <span class="text-primary" style="font-weight:600;font-size:14px;">Your accessing the SLSU OJT website as student. Please select operation below to continue.</span>
                        <div style="display:flex; flex-direction:column; gap:8px; justify-content:center; margin-top:20px;">
                            <button class="btn btn-info btn-sm" id="btn_studentLog">Login for Attendance Only</button>
                            <button class="btn btn-primary btn-sm" id="btnLoginAsStudent">Continue to Login SLSU OJT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Capture Student Image -->
    <div class="modal fade bd-example-modal-sm" id="modal_studentCapture"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid" style="position:relative; width:auto; height:auto;">
                      <video style="border:1px solid #2a78ec;" id="video" width="100%" height="100%" autoplay></video>
                      <button class="btn btn-primary btn-sm" id="btn_CaptureStudentImg" style="border:none;outline:none;padding:7px 12px; border-radius:3px;margin-top:5px;font-size:13px;"><i class="fa fa-camera" style="margin-right:5px;"></i>Take Photo</button>
                      <button class="btn btn-danger btn-sm" id="btn_closeCapture" style="border:none;outline:none;padding:7px 12px; border-radius:3px;margin-top:5px;font-size:13px;">Cancel</button>

                      <div class="canvas" style="margin-top:10px;display:grid;grid-gap:10px;grid-template-columns: repeat(2, 1fr);">

                      </div>
                      <button class="btn btn-info btn-sm btn-block hidden" id="btn_OKCapture" style="border:none;outline:none;padding:7px 12px; border-radius:3px;margin-top:10px;font-size:13px;">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    echo $scriptLinks;
?>
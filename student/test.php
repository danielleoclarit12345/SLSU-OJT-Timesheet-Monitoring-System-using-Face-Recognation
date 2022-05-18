<?php
	include '../config.php';
    date_default_timezone_set('Asia/Manila');
    session_start();
    global $conn;
  if(isset($_POST['submit_journal'])){
		
		$image1 = addslashes(file_get_contents($_FILES['image1']['tmp_name']));
		$image_name = addslashes($_FILES['image1']['name']);
		$image_size = getimagesize($_FILES['image1']['tmp_name']);
		move_uploaded_file($_FILES["image1"]["tmp_name"], "../images/journal/" . $_FILES["image1"]["name"]);
		$location1   =  $_FILES["image1"]["name"];
		
        $query = "Insert into journal values('','".$_POST['user_id']."','".$location1."','".$_POST['content']."',NOW())";
        $result = mysqli_query($conn, $query);
    }
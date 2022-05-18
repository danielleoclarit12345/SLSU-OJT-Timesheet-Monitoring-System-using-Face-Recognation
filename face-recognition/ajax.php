<?php

    include '../config.php';

	$path = $_POST['path'];
	$img = $_POST['image'];
	$id = $_POST['id'];
	$stud_dprtmnt = $_POST['stud_dprtmnt'];
	$stud_section = $_POST['stud_section'];
	$stud_email = $_POST['stud_email'];
	$stud_pass = $_POST['stud_pass'];
	
	
	$query = "Insert into accounts values('', '".$_POST['path']."','".$_POST['stud_email']."', '".sha1($_POST['stud_pass'])."','Active','4')";
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
     $query2 = "Insert into student values('', '".$_POST['id']."', '".$_POST['stud_dprtmnt']."', '".$_POST['stud_section']."', 'Unassigned', '', '".$user_id."', '','','')";
     $result2 = mysqli_query($conn, $query2);
	
	mkdir('data/' . $path, 0777, true);

	define('orig_dir', 'data/' . $path . '/');
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	// Save image to data/original directory
	$fi = new FilesystemIterator(orig_dir, FilesystemIterator::SKIP_DOTS);
	$file = orig_dir . 'image' . iterator_count($fi). '.png';
	$success = file_put_contents($file, $data);
	print $success ? $file : 'Unable to save the file in image directory.';
?>
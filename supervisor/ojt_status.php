<?php
   include '../config.php';
   session_start();
   global $conn, $output, $company;

   $query = "Select company from supervisor where user_id = '".$_SESSION['user_id']."'";
   $result = mysqli_query($conn, $query);

   while ($row = mysqli_fetch_array($result)){
       $company = $row['company'];
   }
?>

     <div>
        <span id="filter">Filter By : 
             <select id="filterBy_OJT">
                <option value="" selected disabled>OJT Names</option>
                <?php
                    $query = "Select accounts.name, student.assigned_company from accounts INNER JOIN student ON accounts.Id = student.user_id where student.assigned_company = '".$company."'";
                    $result = mysqli_query($conn, $query);
                    while ($getName = mysqli_fetch_array($result)){
                        $output.='
                            <option>'.$getName[0].'</option>
                        ';
                    }
                    echo $output;
                ?>
             </select>
         </span>
     </div>
        <table class="table table-striped" id="tbl_Personnel">
            <thead class="bg-info text-primary">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>AM (in)</th>
                <th>AM (out)</th>
                <th>PM (in)</th>
                <th>Pm (out)</th>
                <th>Total Hrs. (today)</th>
                <th>Remaining Hrs.</th>
                <th>Target Hrs.</th>          
            </tr>
            </thead>
            <tbody class="tbl_StudentDTR">
               
            </tbody>
        </table>
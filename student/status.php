<?php
   include '../config.php';
   global $conn;
?>

      <div>
         <span id="filter">Filter By : 
             <select id="filterBy_month">
                <option value="" selected disabled>Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
             </select>
         </span>
     </div>
        <table class="table table-striped" id="tbl_myStatus">
            <thead class="bg-info text-primary">
            <tr>
                <th>Date</th>
                <th>AM (in)</th>
                <th>AM (out)</th>
                <th>PM (in)</th>
                <th>Pm (out)</th>
                <th>Total Hrs. (today)</th>
                <th>Remaining Hrs.</th>    
            </tr>
            </thead>
            <tbody class="tbl_StudentDTR">
               
            </tbody>
        </table>

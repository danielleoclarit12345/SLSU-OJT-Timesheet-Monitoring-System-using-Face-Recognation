<?php
    include '../config.php';
    global $conn;
    global $output;
?>
     <span class="text-primary">Filter By :</span>
       <select class="filterByAssignment">
         <option value="Assigned">Assigned</option>
         <option value="Unassigned">Unassigned</option>
       </select>
        <table class="table table-striped">
            <thead class="bg-info text-primary">
            <tr>
                <th>#</th>
                <th>Student Id</th>
                <th>Students</th>
                <th>Section</th>
                <th>Company</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="tbl_Students_Details">

            </tbody>
        </table>

      <!-- Update Student Modal   -->
     <div class="modal fade" id="modal_updtOJTStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil"></i>Update Student</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_Personnel">
                        <div class="form-group">
                            <div class="form-input">
                                <input class="form-control hidden" id="updt_id1" style="margin-bottom:5px;">
                                <label style="margin-top:15px;">Name of Student<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="updt_OjtstudentName" style="margin-bottom:5px;" readonly>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:20px;">Location<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="updt_OjtstudentLocation" style="margin-bottom:5px;">
                                   <?php 
                                      $query = "Select location from supervisor";
                                      $result = mysqli_query($conn, $query);

                                      while($location = mysqli_fetch_array($result)){
                                          $output.='
                                            <option value="'.$location[0].'">'.$location[0].'</option>
                                          ';
                                      }
                                      echo $output;
                                   ?>
                                </select>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Company<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="updt_OjtstudentCompany" style="margin-bottom:5px;">
                                  <option value="">--</option>
                                </select>
                                <strong id="updt_Ojterror" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCloseUpdtPersonnnelModal">Cancel</button>
                <button class="btn btn-primary" id="btn_UpdtOJTStudent">Update Student</button>
            </div>
            </div>
        </div>
     </div>
<?php
    session_start();
    include '../config.php';
    global $conn;
?>
     <span class="text-primary">Filter By :</span>
       <select class="filter">
         <option value="" selected disabled>Department</option>
         <option value="CCSIT">CCSIT</option>
         <option value="CHTM">CHTM</option>
         <option value="CCJ">CCJ</option>
         <option value="COE">COE</option>
         <option value="CTE">CTE</option>
       </select>
        <table class="table table-striped">
            <thead class="bg-info text-primary">
            <tr>
                <th>#</th>
                <th>Student Id</th>
                <th>Students</th>
                <th>Department</th>
                <th>Section</th>         
                <th>Username</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="tbl_StudentsData">   
              
            </tbody>
        </table>

    <!-- Update Student Modal   -->
     <div class="modal fade" id="modal_updtStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input class="form-control hidden" id="updt_studId" style="margin-bottom:5px;">
                                <label style="margin-top:15px;">Name of Student<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="updt_studName" style="margin-bottom:5px;" readonly>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Status<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="updt_studStatus" style="margin-bottom:5px;">
                                    <option value="">--</option>
                                    <option value="Active">Active</option>
                                    <option value="Deactivate">Deactivate</option>
                                </select>
                                <strong id="updt_stud_error" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCloseUpdtStudentModal">Cancel</button>
                <button class="btn btn-primary" id="btn_UpdtStudent">Update Student</button>
            </div>
            </div>
        </div>
     </div>

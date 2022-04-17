<?php
    include '../config.php';
    global $conn;
?>
     
     <div>
         <button id="btn_newPersonnel"><i class="fa fa-plus"></i>Add New Personnel</button>
         <span id="filter">Filter By : 
             <select id="filterBy_department">
                 <option value="" selected disabled>Department</option>
                <option value="CCSIT">CCSIT</option>
                <option value="CHTM">CHTM</option>
                <option value="COE">COE</option>
                <option value="CCJ">CCJ</option>
                <option value="CTE">CTE</option>
             </select>
         </span>
     </div>
        <table class="table table-striped" id="tbl_Personnel">
            <thead class="bg-info text-primary">
            <tr>
                <th>#</th>
                <th>Personnels</th>
                <th>Department</th>
                <th>Username</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="tbl_PersonnelData">
               
            </tbody>
        </table>

        <!-- Add Personnel Modal   -->
        <div class="modal fade" id="modal_addPersonel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-o"></i>New Personnel</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_Personnel">
                        <div class="form-group">
                            <div class="form-input">
                                <label style="margin-top:15px;">Name<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="fullname" style="margin-bottom:5px;">
                                <strong id="error1" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:20px;">Department<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="department" style="margin-bottom:5px;">
                                    <option value="">--</option>
                                    <option value="CCSIT">College of Computer Science in Information Technology</option>
                                    <option value="CHTM">College of Hotel,Restuarant,Tourism Management</option>
                                    <option value="CCJ">College of Criminal and Justice</option>
                                    <option value="COE">College of Engineering</option>
                                    <option value="CTE">College of Teacher Education</option>
                                </select>
                                <strong id="error2" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Email<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="personnel_username" style="margin-bottom:5px;">
                                <strong id="error3" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Password<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control"  id="personnel_pass" style="margin-bottom:5px;">
                                <strong id="error4" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnClosePersonnnelModal">Cancel</button>
                <button class="btn btn-primary" id="btn_savePersonnel">Save Personnel</button>
            </div>
            </div>
        </div>
     </div>

     <!-- Update Personnel Modal   -->
     <div class="modal fade" id="modal_updtPersonel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil"></i>Update Personnel</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_Personnel">
                        <div class="form-group">
                            <div class="form-input">
                                <input class="form-control hidden" id="updt_id" style="margin-bottom:5px;">
                                <label style="margin-top:15px;">Name of Personnel<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="updt_fullname" style="margin-bottom:5px;" readonly>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:20px;">Department<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="updt_department" style="margin-bottom:5px;">
                                    <option value="">--</option>
                                    <option value="CCSIT">College of Computer Science in Information Technology</option>
                                    <option value="CHTM">College of Hotel,Restuarant,Tourism Management</option>
                                    <option value="CCJ">College of Criminal and Justice</option>
                                    <option value="COE">College of Engineering</option>
                                    <option value="CTE">College of Teacher Education</option>
                                </select>
                                <strong id="updt_error1" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Status<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="updt_status" style="margin-bottom:5px;">
                                    <option value="">--</option>
                                    <option value="Active">Active</option>
                                    <option value="Deactivate">Deactivate</option>
                                </select>
                                <strong id="updt_error2" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCloseUpdtPersonnnelModal">Cancel</button>
                <button class="btn btn-primary" id="btn_UpdtPersonnel">Update Personnel</button>
            </div>
            </div>
        </div>
     </div>
     <!-- Delete Personnel Modal   -->
     <div class="modal fade bd-example-modal-sm" id="modal_deletePersonel"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>Remove Personnel</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="hidden" id="delete_id">
                    <h5 class="text-danger" style="font-size:15px; font-weight:600;">
                        <i class="fa fa-question-circle" style="padding:4px;"></i>Are you sure you want to remove this Personnel?
                    </h5>
                </div>
                <div class="modal-footer">
                     <button class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseDeletePersonnnelModal">Cancel</button>
                     <button class="btn btn-danger btn-sm" id="btn_DeletePersonnel">Delete Personnel</button>
                </div>
            </div>
        </div>
     </div>
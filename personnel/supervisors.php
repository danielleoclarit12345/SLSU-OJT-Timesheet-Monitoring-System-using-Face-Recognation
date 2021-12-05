<?php
    session_start();
    include '../config.php';
    global $conn;
?>
     <button id="btn_newSupervisor"><i class="fa fa-plus"></i>Add New Supervisor</button>
        <table class="table table-striped" id="tbl_Personnel">
            <thead class="bg-info text-primary">
            <tr>
                <th>#</th>
                <th>Supervisors</th>
                <th>Companies</th>
                <th>Location</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="tbl_SupervisorData">   
            </tbody>
        </table>

        <!-- Add Personnel Modal   -->
        <div class="modal fade" id="modal_addSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-o"></i>New Supervisor</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_Personnel">
                        <div class="form-group">
                            <div class="form-input">
                                <label style="margin-top:15px;">Name of Supervisor<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="supervisor" style="margin-bottom:5px;">
                                <strong id="error1_s" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:20px;">Company<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="company" style="margin-bottom:5px;">
                                <strong id="error2_s" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Location<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="location" style="margin-bottom:5px;">
                                <strong id="error3_s" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Email<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control"  id="supervisor_uname" style="margin-bottom:5px;">
                                <strong id="error4_s" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Password<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="supervisor_pass" style="margin-bottom:5px;">
                                <strong id="error5_s" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCloseSupervisorModal">Cancel</button>
                <button class="btn btn-primary" id="btn_saveSupervisor">Save Supervisor</button>
            </div>
            </div>
        </div>
     </div>
     <!-- Delete Personnel Modal   -->
     <div class="modal fade bd-example-modal-sm" id="modal_deleteSupervisor"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>Remove Supervisor</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="hidden" id="delete_supervisor_id">
                    <h5 class="text-danger" style="font-size:15px; font-weight:600;">
                        <i class="fa fa-question-circle" style="padding:4px;"></i>Are you sure you want to remove this Supervisor?
                    </h5>
                </div>
                <div class="modal-footer">
                     <button class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseDeleteSupervisorModal">Cancel</button>
                     <button class="btn btn-danger btn-sm" id="btn_DeleteSupervisor">Delete Supervisor</button>
                </div>
            </div>
        </div>
     </div>
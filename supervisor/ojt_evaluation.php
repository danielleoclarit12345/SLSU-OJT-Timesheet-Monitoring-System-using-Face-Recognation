<?php
   include '../config.php';
   global $conn;
?>
<span class="reminder">
    Reminder: OJT Supervisor's allows only to create an evaluation at the end OJT period.
    All evaluation created will be seen by the OJT Coordinator.
</span>
<span class="create_evaluation">
    <i class="fa fa-plus"></i>Create Evaluation
</span>

        <!-- Add Personnel Modal   -->
        <div class="modal fade" id="Evaluation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-file"></i>Evaluation Form</h4>
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
                    <button class="btn btn-primary" id="btn_savePersonnel">Add Evaluation</button>
                </div>
                </div>
            </div>
        </div>
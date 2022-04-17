<?php
     include '../config.php';
     session_start();
     global $conn;
?>
<div class="announcement">
    <span class="add_announcement">
        <i class="fa fa-plus"></i>Create Announcement
    </span>
    <div class="content">
    </div>
</div>

<!-- Create Announcement Modal   -->
<div class="modal fade" id="modal_addAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-bullhorn"></i>Add Announcement</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_Personnel">
                        <div class="form-group">
                            <div class="form-input">
                                <label style="margin-top:15px;">Title<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="title" style="margin-bottom:5px;">
                                <strong id="error_title" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Description<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <textarea id="description" class="form-control" rows="6" style="resize:none;"></textarea>
                                <strong id="error_desc" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Company<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="company_detail" style="margin-bottom:5px;">
                                   <option value="">--</option>
                                   <option value="All">All</option>
                                   <?php
                                        $output = '';
                                        $query = "Select company from supervisor";
                                        $result = mysqli_query($conn, $query);

                                        while ($company = mysqli_fetch_array($result)){
                                            $output.='
                                                <option value="'.$company[0].'">'.$company[0].'</option>
                                            ';
                                        }
                                        echo $output;
                                   ?>
                                </select>
                                <strong id="error_company" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCloseAnnouncementModal">Cancel</button>
                <button class="btn btn-primary" id="btn_saveAnnouncement">Save Announcement</button>
            </div>
            </div>
        </div>
</div>
<!-- Update Announcement Modal   -->
<div class="modal fade" id="modal_updtAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil"></i>Update Announcement</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_Personnel">
                        <div class="form-group">
                            <div class="form-input">
                                <input class="form-control hidden" id="updt_announcementId" style="margin-bottom:5px;">
                                <label style="margin-top:15px;">Title<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input class="form-control" id="updt_title" style="margin-bottom:5px;">
                                <strong id="updt_error_title" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Description<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <textarea id="updt_description" class="form-control" rows="6" style="resize:none;"></textarea>
                                <strong id="updt_error_desc" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Company<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <select class="form-control" id="updt_company_detail" style="margin-bottom:5px;">
                                   <option value="">--</option>
                                   <option value="All">All</option>
                                   <?php
                                        $output = '';
                                        $query = "Select company from supervisor";
                                        $result = mysqli_query($conn, $query);

                                        while ($company = mysqli_fetch_array($result)){
                                            $output.='
                                                <option value="'.$company[0].'">'.$company[0].'</option>
                                            ';
                                        }
                                        echo $output;
                                   ?>
                                </select>
                                <strong id="updt_error_company" class="text-danger" style="margin-left:5px;"></strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCloseUpdtAnnouncementModal">Cancel</button>
                <button class="btn btn-primary" id="btn_updtAnnouncement">Save Changes</button>
            </div>
            </div>
        </div>
</div>
  <!-- Delete Announcement Modal   -->
  <div class="modal fade bd-example-modal-sm" id="modal_deleteAnnouncement"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>Remove Announcement</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="hidden" id="delete_announcementId">
                    <h5 class="text-danger" style="font-size:15px; font-weight:600;">
                        <i class="fa fa-question-circle" style="padding:4px;"></i>Are you sure you want to remove this Announcement?
                    </h5>
                </div>
                <div class="modal-footer">
                     <button class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseDeleteAnnouncementModal">Cancel</button>
                     <button class="btn btn-danger btn-sm" id="btn_DeleteAnnouncement">Delete Announcement</button>
                </div>
            </div>
        </div>
     </div>
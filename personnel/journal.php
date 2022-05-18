<?php
    session_start();
    include '../config.php';
    global $conn;
?>
    
        <table class="table table-striped" id="tbl_Personnel">
            <thead class="bg-info text-primary">
            <tr>
                <th>Image</th>
                <th>Content</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody class="tbl_StudentJournal">   
            </tbody>
        </table>

        <!-- Add Personnel Modal   -->
        <div class="modal fade" id="modal_new_journal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-o"></i>New Journal</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                        <div class="form-group">
                            <div class="form-input">
                                <label style="margin-top:15px;">Photo<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <input type="file" class="form-control" id="my_profile" style="margin-bottom:5px;">
                                <input type="hidden" class="form-control" id="user_id" value="<?php echo $_SESSION['user_id'];?>" style="margin-bottom:5px;">
                            </div>
                            <div class="form-input">
                                <label style="margin-top:15px;">Content<span class="text-danger" style="margin-left:5px;">*</span></label>
                                <textarea class="form-control"  id="content" style="margin-bottom:5px;height:400px;"></textarea>
                            </div>
                           
                        </div>
                   
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" id="btnCloseSupervisorModal">Cancel</button>
                <button class="btn btn-primary" id="submit_journal">Save Journal</button>
            </div>
            </div>
        </div>
     </div>
     <!-- Delete Personnel Modal   -->
     <div class="modal fade bd-example-modal-sm" id="modal_deletejournal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>Remove Journal</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="text" id="delete_journal_id">
                    <h5 class="text-danger" style="font-size:15px; font-weight:600;">
                        <i class="fa fa-question-circle" style="padding:4px;"></i>Are you sure you want to remove this Journal?
                    </h5>
                </div>
                <div class="modal-footer">
                     <button class="btn btn-secondary btn-sm" data-dismiss="modal" id="btnCloseDeleteSupervisorModal">Cancel</button>
                     <button class="btn btn-danger btn-sm" id="btn_DeleteJournal">Delete Journal</button>
                </div>
            </div>
        </div>
     </div>
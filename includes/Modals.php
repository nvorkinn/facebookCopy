<!-- Modal -->
<div class="modal fade" id="photoUploadModal" tabindex="-1" role="dialog" aria-labelledby="photoUploadModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Change cover photo</h4>
         </div>
         <div class="modal-body">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
               <i class="glyphicon glyphicon-plus"></i>
               <span>Add files...</span>
               <!-- The file input field used as target for the file upload widget -->
               <input id="fileupload" type="file" name="files[]" multiple>
            </span>
            <br>
            <br>
            <!-- The global progress bar -->
            <div id="progress" class="progress progress-striped">
               <div class="progress-bar progress-bar-info"></div>
            </div>
            <!-- The container for the uploaded files -->
            <div id="files" class="files"></div>
            <br>
         </div>
         <div class="modal-footer" style="margin-top:-45px;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
         </div>
      </div>
   </div>
</div>
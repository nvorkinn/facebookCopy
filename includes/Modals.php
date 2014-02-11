<!-- Modal -->
<div class="modal fade" id="photoUploadModal" tabindex="-1" role="dialog" aria-labelledby="photoUploadModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Change cover photo</h4>
         </div>
         <div class="modal-body" id="modalbody">
			<span class="btn btn-success fileinput-button" id="addFiles">
               <i class="glyphicon glyphicon-plus"></i>
               <span>Add files...</span>
               <input id="fileupload" type="file" name="files[]" multiple>
            </span>
            <br>
            <br>
            <div id="progress" class="progress progress-striped">
               <div class="progress-bar progress-bar-info"></div>
            </div>
            <div id="files" class="files"></div>
            <br>
         </div>
         <div class="modal-footer" style="margin-top:-45px;">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveButton">Save changes</button>
         </div>
      </div>
   </div>
</div>
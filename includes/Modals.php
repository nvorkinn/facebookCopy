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

<!-- Friend Request Response Modal -->
<div class="modal fade bs-modal-sm" id="friend-request-response-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="friendRequestResponseModalHeader">Friend Request Response</h4>
            </div>
            <div class="modal-body">
                <div class="btn-group btn-group-vertical btn-block">
                    <button type="button" class="btn btn-primary btn-lg" id="friend-request-accept" data-dismiss="modal" data-width="auto">
                        Accept
                    </button>
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">
                        Ignore
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add to Circle Modal -->
<div class="modal fade" id="friend-circle-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="friendCircleModalHeader">Add Friend to Circle?</h4>
            </div>
            <div class="modal-body">
                <div class="btn-group btn-group-vertical btn-block">
                    <div class="input-group">
                        <input id="new-circle-name" type="text" class="form-control" placeholder="Create new circle">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="new-circle-button" data-dismiss="modal" type="button" onclick="newCircle();">Create!</button>
                        </span>
                    </div><!-- /input-group -->
                    <a class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" href="#">
                        or add to existing
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" id="existing_circles" data-dismiss="modal">
                        <!-- Here goes all existing circles -->	
						<?PHP
						$user_id = $_SESSION["user_id"];
						$circle_query = "SELECT id, name FROM circle WHERE owner_user_id = $user_id";
						if ($circle_result = $mysqli->query($circle_query)) {
							while ($row = $circle_result->fetch_assoc()) {
								echo "<li>";
								echo "<a tabindex='-1' href='#' onclick='addToCircle(".$row["id"].");'>";
								echo $row["name"];
								echo "</a>";
								echo "</li>";
							}
						}
						?>				
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
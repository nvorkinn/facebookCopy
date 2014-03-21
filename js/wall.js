function postStatusUpdate() {
    $.ajax({
        type: "POST",
        url: "tools/post.php",
        data: {content: $("#status_update").val(), privacy: $("#privacy-select").val()},
        success: function(id) {
			alert(id);
            addPost(id);
            $("#status_update").val("");
        }
    });
}

function deletePost(element) {
    $.ajax({
        type: "POST",
        url: "tools/delete_post.php",
        data: {id: $(element).parent().parent().attr("data-id")},
        success: function() {
            $(element).parent().parent().remove();
        }
    });
}

function addPost(id) {
    var content = $("#status_update").val();
	var profile_photo_url = '<%= session.getAttribute("profile_photo_url") %>';
	var user_name = session.getAttribute("user_name");
	var user_surname = session.getAttribute("user_surname");
	
	
    $("#posts_container").prepend("<div class='row'>\
                                       <div data-id=" + id + " class='box box-primary' style='width:600px'>\
									   <div class='box-header' style='margin-left:10px'><img src='"+profile_photo_url+"' class='img-circle' alt='User Image' style='height:55px;width:55px;border: 2px solid #3c8dbc;margin-top:4px;margin-right:5px'/>\
												<a href='#' style='color:#3D8DBC;font-weight:bold'>"+user_name +" " + user_surname+"</a>\
											  </div><div class='box-body'>\
                                               <p>" + content + "</p>\
                                           <div class='add-comment-box'>\
                                                    <input class='add-comment' type='text' placeholder='Type your comment here'><button class='btn btn-success comment_button' onclick='addComment(this);'>Comment</button>\
                                           </div>\
                                           </div><!-- /.box-body -->\
                                           <div class='box-footer'>\
                                               <button class='btn btn-danger delete_button' onclick='deletePost(this);'>Delete</button>\
                                           </div><!-- /.box-footer-->\
                                       </div><!-- /.box -->\
                                   </div>");
}

function addComment(element)
{
    $.ajax({
        type: "POST",
        url: "tools/comment.php",
        data: {content: $(element).parent().find(".add-comment").val(), post:$(element).parent().parent().parent().attr("data-id")},
        success: function(id) {
            $(element).parent().parent().append("<div data-id=" + id + " class='box box-primary comment-box'>\
                                                      <div class='box-body'>\
                                                          <b>Me</b> " + $(element).parent().find(".add-comment").val() + "\
                                                      </div>\
                                                      <div class='box-footer'>\
                                                          <button class='btn btn-danger delete_comment_button' onclick='deleteComment(this);'>Delete</button>\
                                                      </div><!-- /.box-footer-->\
                                                  </div>");
                                                  
            $(element).parent().find(".add-comment").val("");
        }
    });
}

function deleteComment(element) {
    $.ajax({
        type: "POST",
        url: "tools/delete_comment.php",
        data: {id: $(element).parent().parent().attr("data-id")},
        success: function() {
            $(element).parent().parent().remove();
        }
    });
}

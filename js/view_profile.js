$(document).ready(function ()
{
    $("#add-friend-btn").click(function() 
    {
        $.ajax({
            type: "post",
            data: {"action" : "newFriendRequest", "to_user_id" : currentUserId},
            url: "tools/protected/friend_utils.php",
            success: function (response) {
				
                if(response !=-1)
                {
                    $("#add-friend-btn").html("Friend request sent!");
                    $("#add-friend-btn").attr("disabled", "true");
				
					var json = $.parseJSON(response);
					if(json.to_hash){
						registerNotification(conn,json.to_hash, "newFriendRequest");
                    }
                }
                else
                {
                    $("#add-friend-btn").html("Retry :(");
                }
            }
        });
    });
});

function deleteBlog(element) {
    $.ajax({
        type: "POST",
        url: "tools/delete_blog.php",
        data: {id: $(element).parent().parent().attr("data-id")},
        success: function() {
            $(element).parent().parent().remove();
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

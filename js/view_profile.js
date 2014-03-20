$(document).ready(function ()
{
    $("#add-friend-btn").click(function() 
    {
        $.ajax({
            type: "post",
            data: {"action" : "newFriendRequest", "to_user_id" : currentUserId},
            url: "tools/protected/friend_utils.php",
            success: function (response) {
				console.log(response);
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

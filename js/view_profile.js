$(document).ready(function ()
{
    $("#add-friend-btn").click(function() 
    {
        $.ajax({
            type: "post",
            data: {"action" : "newFriendRequest", "to_user_id" : currentUserId},
            url: "../../tools/protected/friend_utils.php",
            success: function (response) {
				
                if(response !=-1)
                {
					alert(response);
					
					var json = $.parseJSON(response);
					if(json.to_hash){
						registerNotification(conn,json.to_hash, "newFriendRequest");
                    }
					
                    $("#add-friend-btn").html("Friend request sent!");
                    $("#add-friend-btn").attr("disabled", "true");
                }
                else
                {
                    $("#add-friend-btn").html("Retry :(");
                }
            }
        });
    });
});

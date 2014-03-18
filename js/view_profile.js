$(document).ready(function ()
{
    $("#add-friend-btn").click(function() 
    {
        $.ajax({
            type: "post",
            data: {"action" : "newFriendRequest", "to_user_id" : currentUserId},
            url: "tools/protected/friend_utils.php",
            success: function (response) {
                if(response == 1)
                {
                    registerNotification(conn, "f04b1d726c615672552fa5116aa5b958d8d41676", "newFriendRequest");
                    
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

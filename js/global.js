function signOut(){
     $.ajax({
        type: "POST",
        url: "tools/signout.php",
        success: function () {
            location.reload();
        }
    });
}

function addToCircle(circle_id){
    var friend = $("#friend-circle-modal").attr('data-activity-hash');
    
    $.ajax({
        type: "post",
        data: {"circle_id": circle_id, "member_to_add": friend},
        url: "tools/protected/add_to_circle.php",
        success: function (response) {
        }
    });
}

function newCircle(){	
    var circle_name = $("#new-circle-name").val();
    $.ajax({
            type: "post",
            data: {"circle_name":circle_name},
            url: "tools/protected/create_circle.php",
            success: function (id) {
                if(id != -1) {
                    addToCircle(id);
                }
            }
    });
}
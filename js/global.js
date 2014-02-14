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

function findPeople(term){
    $.ajax({
        type: "POST",
        data: {"term": term},
        url: "tools/find_people.php",
        success: function (people_json) {
            console.log(people_json);
            people = JSON.parse(people_json);
            
            var position = $("#search_box").offset();
            
            $("#search_results").empty();
            $("#search_results").css({top: (position.top + 27) + "px", left: (position.left - 220) + "px"});
            $("#search_results").show("fast");
            
            // people[id].photo_code for correct avatar
            for (id in people) {
                $("#search_results").append("<a class='search_result' href='view_profile.php?id=" + id + "'>\
                <img src='img/avatar3.png' class='img-circle' alt='User Image'>\
                <span>" + people[id].name + "</span>\
                </a>");
            }
        }
    });
}

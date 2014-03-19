function signOut(){
     $.ajax({
        type: "POST",
        url: "tools/signout.php",
        success: function () {
            location.reload();
        }
    });
}

function addToCircle(circleId){
    var friend = $("#friend-circle-modal").attr('data-activity-hash');
	$.ajax({
		type: "post",
		url: "tools/protected/circle_utils.php",
		data: {"action":"add_to_circle", "circle_id": circleId, "member_to_add": friend},

    });
}

function newCircle(){	
    var circleName = $("#new-circle-name").val();
	$.ajax({
		type: "post",
		url: "tools/protected/circle_utils.php",
		data: {"action":"create_circle", "circle_name":circleName},
            success: function (id) {
				console.log("got somewhere");
                if (id == -1) {
					$("#alert-placeholder").replaceWith("<div class='alert alert-danger alert-dismissable' style='margin-left: 0px'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><span>Could not create circle!</span></div>");
                }
				else {
					addToCircle(id);
					$("#friend-circle-modal").modal("toggle");
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
				var pic = people[id].photo_url!=null?people[id].photo_url : "img/avatar3.png";
				console.log(people[id].photo_url);
                $("#search_results").append("<a class='search_result' href='view_profile.php?id=" + id + "'>\
                <img src='"+pic+"' class='img-circle' alt='User Image'>\
                <span>" + people[id].name + "</span>\
                </a>");
            }
        }
    });
}

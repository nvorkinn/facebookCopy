$(function() {
	
	$(".friend").draggable({
		helper: "clone",
		stack: ".friend",
		revert: function(droppable) {
			// Revert if not dropped in droppable area
			if (!droppable) {
				return true;
			}
			// Revert if friend is already in circle
			else if (droppable.find("li#" + $(this).attr("id")).length > 0) {
				return true;
			}
			else {
				return false;
			}
		}
	});
	
	$(".outer-circle").droppable();
	
	$("body").on("drop", ".outer-circle", function(event, ui) {
		var circle = $(this);
		$.ajax({
			type: "post",
			url: "tools/protected/circle_utils.php",
			data: {"action":"add_to_circle", "circle_id":circle.attr("id"), "member_to_add":$(ui.draggable).attr("id")},
			success: function (response) {
				if (response == 1) {
					var list = circle.find("ul.list-group");
					var userHash = $(ui.draggable).attr("id");
					var userName = $(ui.draggable).text();
					circle.find(".member-no").fadeOut(200, function() {
						$(this).text(parseInt(circle.find(".member-no").text()) + 1);
						$(this).fadeIn(200);
					});
					list.append("<li class='list-group-item friend' id='"+userHash+"'>"+userName+"<button type='button' class='close delete-user' aria-hidden='true'>&times;</button></li>");
				}
				else {
					alert("Could not add member to circle!");
					alert(response);
				}
					
			}
		});
	});
	
	$("#circles").popover({
		html: true,
		placement: "top",
		selector: ".outer-circle",
		content: function() {
			return $(this).children(".hidden").html();
		}
	});	

	$("#new-circle").click(function(e){
		e.preventDefault();
		var circleName = $("#new-circle-name").val();
		$.ajax({
			type: "post",
			url: "tools/protected/circle_utils.php",
			data: {"action":"create_circle", "circle_name":circleName},
			success: function (response) {
				if (response == -1) {
					alert("Could not create new circle!");
				}
				else {
					$("<li style='display: none;' class='outer-circle' id="+response+" data-placement='above' title='Circle Members'><div class='hidden' style='display:none;'><div class='hidden-content' id="+response+"><ul class='list-group'></ul><div class='btn-group btn-group-justified'><div class='btn-group'><button class='btn btn-primary rename-circle' type='button'>Rename</button></div><div class='btn-group'><button class='btn btn-danger delete-circle' type='button'>Delete</button></div></div><div class='input-group' style='display:none'><input type='text' class='form-control rename-name' placeholder='New circle name...'><span class='input-group-btn'><button class='btn btn-default rename-button' type='button'>Rename</button></span></div></div></div><div class='circle'><div class='circle-label'><div class='member-no'>0</div><br>"+circleName+"</div></div></li>").appendTo($("#circles")).show("slide", {direction: "left"}, 600);
					$(".outer-circle").droppable();
				}
			}
		});
	});

	$("body").on("click", ".delete-circle", function() {
		$(this).closest(".popover").toggle().remove();
		var circleId = $(this).closest("div.hidden-content").attr("id");
		$.ajax({
			type: "post",
			url: "tools/protected/circle_utils.php",
			data: {"action":"delete_circle", "circle_id":circleId}
		});
		var circle = $("body").find("li.outer-circle#"+circleId);
		circle.find(".circle-label").addClass("circle-label-rotate");
		circle.animate({"bottom":"50px"},200).animate({"bottom":"0px"}, 150, function(){
			circle.animate({"opacity":"0","left":"510px"}, 1000, "easeInQuad", function() {
				circle.animate({width: "0px"}, 600, function() {
					circle.remove();
				});
			});
		});
	});
	
	$("body").on("click", ".rename-circle", function() {
		$(this).closest("div.hidden-content").children("div.input-group").show("slide", {direction: "up"}, 600);
	});
	
	$("body").on("click", ".rename-button", function() {
		var circleId = $(this).closest("div.hidden-content").attr("id");
		var newCircleName = $(this).closest(".input-group").find(".rename-name").val();
		$.ajax({
			type: "post",
			url: "tools/protected/circle_utils.php",
			data: {"action": "rename_circle", "circle_id": circleId, "new_circle_name": newCircleName}
		});
		$("#circles").find("li.outer-circle#" + circleId).find(".circle-name").fadeOut(200, function() {
			$(this).text(newCircleName);
			$(this).fadeIn(200);
		});
		$(this).closest("div.input-group").hide("slide", {direction: "up"}, 600);
	});
	
	$("body").on("click", ".delete-user", function() {
		var circleId = $(this).closest("div.hidden-content").attr("id");
		var friend = $(this).closest(".friend");
		var userHash = friend.attr("id");
		$.ajax({
			type: "post",
			url: "tools/protected/circle_utils.php",
			data: {"action":"delete_user_from_circle", "circle_id": circleId, "member_to_delete": userHash},
			success: function(response) {
				if (response == 1) {
					friend.hide("slide", {direction: "left"}, 500, function() {
						$(this).remove();
					});
					var circle = $("body").find(".outer-circle#" + circleId);
					circle.find(".friend#" + userHash).remove();
					circle.find(".member-no").fadeOut(200, function() {
						$(this).text(parseInt($(this).text()) - 1);
						$(this).fadeIn(200);
					});
				}
			}
		});
	});
	
	$("#search").on("input", function(ev) {
		var filter = $(this).val();
		if (filter) {
			var regex = new RegExp(filter, "i");
			$("#friends").children("li").each(function() {
				if (regex.test($(this).text())) {
					$(this).fadeIn(200);
				}
				else {
					$(this).fadeOut(200);
				}
			});
		}
		else {
			$("#friends li").fadeIn(200);
		}
	});

});
function postStatusUpdate() {
    $.ajax({
        type: "POST",
        url: "tools/post.php",
        data: {content: $("#status_update").val()},
        success: function() {
            addPost();
            $("#status_update").val("");
        }
    });
}

function like(element) {
    $(element).html("Unlike");
    $(element).attr("onclick", "unlike(this);");
    $(element).parent().parent().removeClass("box-primary");
    $(element).parent().parent().addClass("box-success");
}

function unlike(element) {
    $(element).html("Like");
    $(element).attr("onclick", "like(this);");
    $(element).parent().parent().removeClass("box-success");
    $(element).parent().parent().addClass("box-primary");
}

function addPost() {
    var content = $("#status_update").val();
    $("#posts_container").prepend("<div class='row'>\
                                       <div class='box box-primary'>\
                                           <div class='box-body'>\
                                               <p>" + content + "</p>\
                                           </div><!-- /.box-body -->\
                                           <div class='box-footer'>\
                                               <button class='btn btn-success' class='like_button' onclick='like(this);'>Like</button>\
                                           </div><!-- /.box-footer-->\
                                       </div><!-- /.box -->\
                                   </div>");
}

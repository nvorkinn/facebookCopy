function postStatusUpdate() {
    $.ajax({
        type: "POST",
        url: "tools/post.php",
        data: {content: $("#status_update").val(), privacy: $("#privacy-select").val()},
        success: function(id) {
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

function addPost(id) {
    var content = $("#status_update").val();
    $("#posts_container").prepend("<div class='row'>\
                                       <div data-id=" + id + " class='box box-primary'>\
                                           <div class='box-body'>\
                                               <p>" + content + "</p>\
                                           </div><!-- /.box-body -->\
                                           <div class='box-footer'>\
                                               <button class='btn btn-danger delete_button' onclick='deletePost(this);'>Delete</button>\
                                               <button class='btn btn-success like_button' onclick='like(this);'>Like</button>\
                                           </div><!-- /.box-footer-->\
                                       </div><!-- /.box -->\
                                   </div>");
}

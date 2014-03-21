function postStatusUpdate() {
    $.ajax({
        type: "POST",
        url: "tools/post.php",
        data: {content: $("#status_update").val(), privacy: $("#privacy-select").val()},
        success: function(id) {
			alert(id);
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

function addPost(id) {
    var content = $("#status_update").val();
    $("#posts_container").prepend("<div class='row'>\
                                       <div data-id=" + id + " class='box box-primary'>\
                                           <div class='box-body'>\
                                               <p>" + content + "</p>\
                                           <div class='add-comment-box'>\
                                                    <input class='add-comment' type='text' placeholder='Type your comment here'><button class='btn btn-success comment_button' onclick='addComment(this);'>Comment</button>\
                                           </div>\
                                           </div><!-- /.box-body -->\
                                           <div class='box-footer'>\
                                               <button class='btn btn-danger delete_button' onclick='deletePost(this);'>Delete</button>\
                                           </div><!-- /.box-footer-->\
                                       </div><!-- /.box -->\
                                   </div>");
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

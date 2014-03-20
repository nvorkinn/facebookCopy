function deletePost(element) {
    $.ajax({
        type: "POST",
        url: "tools/delete_post.php",
        data: {id: $(element).parent().parent().attr("data-id")},
        success: function() {
            window.location = "wall.php";
        }
    });
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

function saveBlog(element)
{
    $.ajax({
        type: "POST",
        url: "tools/save_blog_entry.php",
        data: {content: $("#blog-editor").val(), title: $("#blog-entry-title").val(), privacy: $("#privacy-select").val()},
        success: function(id) {
            location.reload();
        }
    });
}

function deleteBlog(element) {
    $.ajax({
        type: "POST",
        url: "tools/delete_blog.php",
        data: {id: $(element).parent().parent().attr("data-id")},
        success: function() {
            $(element).parent().parent().remove();
        }
    });
}
